<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Armada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArmadaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $model = Armada::query()->with('user')->when($request->q, function ($query, $q) {
            $query->where('plat_number', 'like', '%' . $q . '%');
        })->latest()->paginate(10);
        return Inertia::render('Armada/index', ['armada' => $model]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Armada/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required',
            'owner' => 'required',
            'address' => 'required',
            'plat' => 'required|unique:tb_armada,plat_number',
            'vehicle' => 'required',
            'fuel' => 'required',
            'contract' => 'required',
            'contract_file' => 'required|mimes:pdf'
        ]);
        $foto = $request->file('contract_file');
        $path = $foto->store('pdf', 'public');
        $url = Storage::url($path);
        $user = Auth::user()->id;
        Armada::create([
            'nik' => $request->nik,
            'owner' => $request->owner,
            'address' => $request->address,
            'plat_number' => $request->plat,
            'vehicle' => $request->vehicle,
            'contract_date' => $request->contract,
            'contract' => $foto->getClientOriginalName(),
            'contract_path' => $url,
            'fuel' => $request->fuel,
            'user_id' => $user,
        ]);
        return redirect('/armada')->with('success', 'Armada has been created...');
    }

    /**
     * Display the specified resource.
     */
    public function show($armada)
    {
        $model = Armada::query()->where('id', $armada);
        if ($model->first() === null) {
            return redirect('/armada')->with('error', 'Data not found');
        }

        return Inertia::render('Armada/details', ['armada' => $model->get()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Armada $armada)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($armada)
    {
        $model = Armada::query()->where('id', $armada);
        if ($model->first() === null) {
            return redirect('/armada')->with('error', 'Data not found');
        }
        $model->update([
            'is_status' => true
        ]);
        return redirect('/armada')->with('destroy', 'Data has been deleted...');
    }
}
