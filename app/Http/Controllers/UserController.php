<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;
use \App\Models\Task;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Attributes\WithoutErrorHandler;
use Illuminate\Support\MessageBag;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request,User $user)
    {
      $users = User::all();

      if(Auth::attempt($request->only(['email','password']))){
        request()->session()->regenerate();

        $user = Auth::user();
        return redirect()->route('tasks.index',['user'=> $user->id]);
      }else{
          return view('auth.login',['users'=>$users])->with('errors',new MessageBag(['login' => 'Invalid login credentians']));

      }
      


    // return redirect()->route('users.index',['users' =>$users])->withErrors(['login' => 'Invalid login credentians']);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.registration');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validationData = $request->validate([
            'name' => 'required|string|max:20',
            'email' => 'required|string|email|max:225|unique:users',
            'phone_number' => 'required|string|max:9',
            'role' => 'required|string|max:50',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone_number'),
            'role' => $request->input('role'),
            'password' => Hash::make($request->input('password')) 
        ]);

        $user->save();

        return redirect()->route('users.index')->with('success','User created successfully');
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
    public function update(Request $request,User $user)
    {
        $users = User::all();
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerate();
        return redirect()->route('welcome',['users'=> $users ])->with('success','You have been Loged Out');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
