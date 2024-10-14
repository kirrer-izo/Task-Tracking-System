@extends('layouts.app')

@section('content')
@include('success-message')
<div class="top-0 py-1 lg:py-2 w-full bg-transparent lg:relative z-50 dark:bg-gray-900">
    <nav class="z-10 sticky top-0 left-0 right-0 max-w-4xl xl:max-w-5xl mx-auto px-5 py-2.5 lg:border-none lg:py-4">
        <div class="flex items-center justify-between">
            <button>
                <div class="flex items-center space-x-2">
                    <h2 class="text-black dark:text-white font-bold text-2xl">Task Tracker</h2>
                </div>
            </button>
            <div class="hidden lg:block">
                <ul class="flex space-x-10 text-base font-bold text-black/60 dark:text-white">
                    <li
                        class="hover:underline hover:underline-offset-4 hover:w-fit transition-all duration-100 ease-linear">
                        <a href="{{url('/')}}">Home</a>
                    </li>
                    <li
                        class="hover:underline hover:underline-offset-4 hover:w-fit transition-all duration-100 ease-linear">
                        <a href="#">Our services</a>
                    </li>
                    <li
                        class="hover:underline hover:underline-offset-4 hover:w-fit transition-all duration-100 ease-linear">
                        <a href="#">About</a>
                    </li>
                    <li
                        class="hover:underline hover:underline-offset-4 hover:w-fit transition-all duration-100 ease-linear">
                        <a href="#">Contact</a>
                    </li>
                </ul>
            </div>
            <div class="flex items-center justify-center lg:hidden">
                <button class="focus:outline-none text-slate-200 dark:text-white"><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 20 20" aria-hidden="true" class="text-2xl text-slate-800 dark:text-white focus:outline-none active:scale-110 active:text-red-500" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg></button>
            </div>
        </div>
    </nav>
</div>
<div class="flex items-center justify-center min-h-screen bg-gray-900">

    <div class="w-96 backdrop-blur-lg bg-opacity-8- rounded-lg shadow-lg p-5 bg-gray-900 text-white">
        <h2 class="text-2xl font-bold pb-5">SignUp</h2>
        <form action="{{route('users.store')}}" method="POST">
            @csrf
            <div class="mb-4">
    
                <label for="name" class="label">Username:</label>
                <input type="text" name="name" id="name" class="input">
                @error('name')
                <span style="background-color: red;padding:3px">{{$message}}</span>        
                @enderror
            </div>
     
            <div class="mb-4">
    
                <label for="email" class="label">Email:</label>
                <input type="email" name="email" id="email" class="input">
                @error('email')
                <span style="background-color: red;padding:3px">{{$message}}</span>        
                @enderror
            </div>
    
            <div class="mb-4">
    
                <label for="phone_number" class="label">Phone number:</label>
                <input type="number" name="phone_number" id="number" class="input">
                @error('phone_number')
                <span style="background-color: red;padding:3px">{{$message}}</span>        
                @enderror
            </div>
           
            
            <div class="mb-4">
    
                <label for="role" class="label">Your Role:</label>
                <select name="role" id="role" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-full py-2.5 px-4">
                    <option value="">Select your role:</option>
                    <option value="Assigner" >Assigner</option>
                    <option value="IT technician" >IT technician</option>
                </select>
                @error('role')
                <span style="background-color: red;padding:3px">{{$message}}</span>        
                @enderror
            </div>
            
             
            <div class="mb-4">
    
                <label for="password" class="label">Password</label>
                <input type="password" name="password" id="password" class="input">
                @error('password')
                <span style="background-color: red;padding:3px">{{$message}}</span>        
                @enderror
            </div>
            
            
            <div class="mb-4">
    
                <label for="password_confirmation" class="label">Confirm password:</label>
                <input type="password" name="password_confirmation" id="" class="input">
                @error('password_confirmation')
                <span style="background-color: red;padding:3px">{{$message}}</span>        
                @enderror
             
            </div>
        
            <div class="flex items-center justify-between mb-4">
                <button type="submit" class="btn">Register</button>
           
            <div class="flex items-center text-sm">
                <p>Already have an account</p>
                <a href="{{ route('users.index') }}" class="underline cursor-pointer ml-1">Login</a>
            </div>
            </div>
        
        </form>
    </div>
</div>


@endsection
