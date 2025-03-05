<?php

namespace App\Http\Controllers;

use App\Models\Armada;
use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $model = Record::query()->with('user', 'armada')->when($request->q, function ($query, $q) {
            $query->where('code', 'like', '%' . $q . '%');
        })->latest()->paginate(10);
        $armada = Armada::query()->where('is_status', 0)->get();
        return Inertia::render('Record/index', [
            'record' => $model,
            'armada' => $armada,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $model = Record::query()->where('plat_id', $request->plat)->latest()->first();

        if ($model === null) {
            $first = 0;
        } else {
            $first = $model->last_mile;
        }
        // dd($first);
        $request->validate([
            'plat' => 'required',
            'driver' => 'required',
            'cost' => 'required',
            'last' => ['required', function ($attribute, $value, $fail) use ($first) {
                if ($value <= $first) {
                    $fail('last mile must be greater than first mile');
                }
            }],
            'description' => 'required',
            'picture' => 'required|mimes:jpeg,jpg,png'
        ], []);

        $query = Record::query();

        if ($query->first('id') === null) {
            $n = 1;
        } else {
            $n =  $query->count('id') + 1;
        }

        $code = "DTB-" . str_pad($n, 5, '0', STR_PAD_LEFT);

        $model = $query->where('id', $request->plat)->first();
        $foto = $request->file('picture');
        $path = $foto->store('image', 'public');
        $url = Storage::url($path);
        $user = Auth::user();
        Record::create([
            'code' => $code,
            'plat_id' => $request->plat,
            'driver' => $request->driver,
            'cost' => $request->cost,
            'first_mile' => $first,
            'last_mile' => $request->km,
            'description' => $request->description,
            'picture' => $foto->getClientOriginalName(),
            'path_picture' => $url,
            'user_id' => $user->id,
        ]);
        return redirect('/fuel')->with('success', 'fuel has been created..');
    }

    /**
     * Display the specified resource.
     */
    public function show($fuel)
    {
        $model = Record::query()->with('armada', 'user')->where('code', $fuel);
        if ($model->first() === null) {
            return redirect('/fuel')->with('error', 'Data not found');
        }
        return Inertia::render('Record/details', ['fuel' => $model->get()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Record $record)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Record $record)
    {
        //
    }
}
