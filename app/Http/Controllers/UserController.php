<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $title = 'Users';
        $users = User::all();
        return view('users.index', compact('title', 'users'));
    }

    public function show(user $user)
    {

        return view('users.show', compact('user'));
    }

    public function create()
    {
        return view('users.create');
    }

    // STORE
    public function store(UserStoreRequest $request)
    {
        $user = User::create([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'prefix' => $request->input('prefix'),
            'role' => $request->input('role'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'phone_number' => $request->input('phone_number'),
            'streetname' => $request->input('streetname'),
            'house_number' => $request->input('house_number'),
            'zipcode' => $request->input('zipcode'),
            'city' => $request->input('city'),
            'country' => $request->input('country'),
        ]);

        return redirect()->route('users.index')
            ->with('success', 'User succesvol aangemaakt.');
    }

    // UPDATE
    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'prefix' => $request->input('prefix'),
            'role' => $request->input('role'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'phone_number' => $request->input('phone_number'),
            'streetname' => $request->input('streetname'),
            'house_number' => $request->input('house_number'),
            'zipcode' => $request->input('zipcode'),
            'city' => $request->input('city'),
            'country' => $request->input('country'),
        ]);


        return redirect()->route('users.show', $user)
            ->with('success', 'User succesvol bijgewerkt.');
    }

    public function edit(User $user)
    {

        return view('users.edit')->with('status', 'User succesvol bijgewerkt.')->with('user', $user);
    }

    public function destroy($id)
    {
        $users = User::findOrFail($id);

        $users->delete();

        return redirect()->route('users.index');
    }
}
