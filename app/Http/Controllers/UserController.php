<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userRole = Auth::user()->rules;
        if ($userRole === 'Admin') {
            $model = User::query()->paginate(10);
        } else {
            $model = User::query()->where('rules', 'user')->paginate(10);
        }
        return Inertia::render('User/index', ['user' => $model]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'user' => 'required',
            'password' => 'required',
            'nik' => 'required',
        ]);

        User::create([
            'full_name' => $request->name,
            'user' => $request->user,
            'password' => $request->password,
            'nik' => $request->nik,
            'rules' => 'user'
        ]);
        return redirect('/user')->with('success', 'User has been created...');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = User::query()->where('user', $id);
        if ($model->first() === null) {
            return redirect('/user')->with('error', 'Data not found');
        }
        $model->update([
            'is_active' => 'Deactive'
        ]);
        return redirect('/settings/user')->with('destroy', 'User has been deleted');
    }
}
