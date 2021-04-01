<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use App\User;
use App\Role;

class UsersController extends Controller
{
    public function __construct() {$this->middleware('auth');}

    // Renders a list of Users
    public function index() {return view('users.index', [
        'users' => User::orderBy('id', 'ASC')->get(),
        'rName' => Auth::user()->role->title,
    ]);}
        
    // Shows a specific user
    public function show(User $user) {return view('users.show', [
        'user' => $user,
        'rName' => Auth::user()->role->title,
    ]);}

    // Shows a view to create a user
    public function create() {
        return view('users.create',['roles' => Role::orderBy('id', 'ASC')->get()]);
    }

    // Persists created user
    public function store() {
        User::create(request()->validate(['name'=>'required',
                             'email'=>'required',
                             'role_id'=>'required',
                             'password'=>'required'
                             ]));

        return redirect('/users');
    }

    // Shows a view to edit an existing user
    public function edit(User $user) {return view('users.edit', [
        'user' => $user,
        'roles' => Role::orderBy('id','ASC')->get(),
        'rName' => Auth::user()->role->title,
    ]);}

    // Persists the edited user
    public function update(User $user) {  

        $user->update(request()->validate([
            'name'=>'required',
            'email'=>'required',
            'role_id' => 'required'])
        );

        return redirect('/users/' . $user->id);
    }
    
    // Deletes a specific user
    public function destroy(User $user) {
        $user->delete();
        return redirect('/users');
    }
}
