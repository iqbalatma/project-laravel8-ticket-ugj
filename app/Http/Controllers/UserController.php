<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function index(): Response
    {
        $data = [
            'title' => 'User',
            'users' => User::where('role_id', 4)->get()
        ];

        return response()->view('users.index', $data);
    }

    public function store(Request $request)
    {
        $validated =   $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
        ]);
        $validated['role_id'] = 4;
        $validated['password'] = bcrypt($validated['password']);
        User::create($validated);
        return redirect()->route('user.index')->with('success', 'Add new user successfuly');
    }

    public function update(Request $request)
    {
        $validated =   $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'id' => 'required'
        ]);
        $validated['password'] = bcrypt($validated['password']);
        User::where('id', $validated['id'])
            ->update($validated);
        return redirect()->route('user.index')->with('success', 'Update ' . $validated['name'] . ' successfuly');
    }
}
