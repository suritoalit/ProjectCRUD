<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\User;

class UserController extends Controller
{
    public function index() {
        $users = User::latest()->paginate(10);
        return view('users.index',compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }    

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);


        User::create([
            'name'     => $request->name,
            'email'     => $request->email,
            'role'     => 'GUEST',
            'password' => Hash::make($request['password'])
        ]);
    
        return to_route('users.index')->with('success','User created successfully');
    }    

    public function edit($id)
    {
       $users = User::find($id);
       return view('users.edit', compact('users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);


        $users  = User::find($id);

        $users->name = $request->name;
        $users->role = $request->role;
        $users->save();

        return redirect()->route('users.index')->with('success', 'User Successfully Updated');   
    }
    
    public function destroy($id)
    {
        $users = User::find($id);
        $users->delete();

        return redirect()->back()->with('success', 'User Succesfully Deleted');
    }    

    public function trash()
    {
        $users = User::onlyTrashed()->paginate(10);
    
        return view('users.index',compact('users'));
    }
    
    public function restore($id)
    {
        $users = User::onlyTrashed()->findOrFail($id);
        $users->restore();
        
        return to_route('users.trash')->with('success','User restored successfully');
    }

    public function delete($id)
    {
        $users = User::onlyTrashed()->findOrFail($id);
        
        $users->forceDelete();
    
        return to_route('users.trash')->with('success','User deleted permanently');
    }
}
