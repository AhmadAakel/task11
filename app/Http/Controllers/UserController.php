<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $users = User::all();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'image'=>'image|Mimes:jpeg,png,jpg,gif|max:2048'
            
        ]);
        
        $user = new User();
        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        if($request->hasFile('image')){
            $image = $request->file('image');
            $image_name = time() .'.'. $image->getClientOriginalExtension();
            $image->move(public_path('images'), $image_name);
            $user->image = $image_name;

        }
        if($request->has('is_admin')){
            $user->is_admin = true;
        }
        $user->save();
        return redirect('/user'); 

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
    public function trash(){
        $trashedUsers = User::onlyTrashed()->get();
        return view('users.blocked',compact('trashedUsers'));
    }
    public function restore($id){
        $user = User::withTrashed()->find($id);
        if($user){
            $user->restore();
            return redirect()->route('users.trash')->with('success','User unblocked successfully');
        }
        return redirect()->route('users.trash')->with('error','User not found');  
      }

    public function forceDelete($id){
        $user = User::withTrashed()->find($id);
        if($user){
            $user->forceDelete();
            return redirect()->route('users.trash')->with('success','User Deleted successfully');
        }
        return redirect()->route('users.trash')->with('error','User not found');  
      }
      public function Delete(User $user)
    {
       
        $user->forceDelete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
