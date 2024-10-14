@extends('layouts.app')

@section('content')
@auth

<div class="flex items-center justify-center min-h-screen bg-gray-900">
    <div class="w-96 backdrop-blur-lg bg-opacity-8- rounded-lg shadow-lg p-5 bg-gray-900 text-white">
        <h2 class="text-2xl font-bold pb-5">Create Task</h2>
        @if($errors->any())
        <div style="background-color: red;padding:3px">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                    
                @endforeach
            </ul>
        </div>
        @endif
        
        <form action="{{ route('tasks.store') }}" method="post">
            @csrf
            <div class="mb-4">
                <label for="task" class="label">Task:</label>
                <input type="text" name="task" id="task" placeholder="Input the task" class="input">
            </div>
        
            <div class="mb-4">
                <label for="created_by" class="label">Created by:</label>
                <input type="text" name="created_by" id="created_by" value="{{Auth::user()->name}}" class="input">
            </div>
        
            <div class="mb-4"> 
                <label for="assigned_to" class="label">Assigned to</label>
                <select name="assigned_to" id="assigned_to" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-full py-2.5 px-4">
                    
                    @foreach ($technicians as $technician )
                    
                    <option value="{{$technician->name}}" name="assigned_to" id="assigned_to">{{$technician->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-center text-sm">
                <button type="submit" class="btn">Add Task</button>
            </div>        
        </form>
    </div>
</div>

@endsection
@endauth
