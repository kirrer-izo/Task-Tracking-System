@auth
@extends('layouts.app')

@section('content')

<div class="flex items-center justify-center min-h-screen bg-gray-900">
    <div class="w-96 backdrop-blur-lg bg-opacity-8- rounded-lg shadow-lg p-5 bg-gray-900 text-white">
        <h2 class="text-2xl font-bold pb-5">Edit Task</h2>

        @if($errors->any())
        <div style="background-color: red;padding:3px">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                    
                @endforeach
            </ul>
        </div>
        @endif
        
        <form action="{{ route('tasks.update',['task'=>$task->id]) }}" method="post">
            @csrf
            @method('PUT')  
            @if (Auth::user()->role == 'Assigner')
                
            <div class="mb-4">
                <label for="task" class="label">Task:</label>
                <input type="text" name="task" id="task" placeholder="Input the task" value="{{old('task',$task->task)}}" class="input">
            </div>
        
            <div class="mb-4">
                <label for="created_by" class="label">Created by:</label>
                <input type="text" name="created_by" id="created_by" value="{{old('created_by',$task->created_by)}}" class="input">
            </div>

            <div class="mb-4">
                <label for="assigned_to" class="label">Assigned to</label>
                <select name="assigned_to" id="assigned_to" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-full py-2.5 px-4">
                @foreach ($technicians as $technician )
                <option value="{{$technician->name}}" {{ old('assigned_to', $task->assigned_to) == $technician->name ? 'selected' : '' }} name="assigned_to" id="assigned_to">{{$technician->name}}</option>
                @endforeach
                </select>
            </div>
            <input type="hidden" name="status" value="{{old('status',$task->status)}}">
            @endif
            
            @if (Auth::user()->role == 'IT technician' && Auth::user()->name==$task->assigned_to)
            <div class="mb-4">
                
                <input type="hidden" name="task" id="task" placeholder="Input the task" value="{{old('task',$task->task)}}" class="input">
            </div>
        
            <div class="mb-4">
                
                <input type="hidden" name="created_by" id="created_by" value="{{old('created_by',$task->created_by)}}" class="input">
            </div>

            <input type="hidden" name="assigned_to" value="{{ old('assigned_to', $task->assigned_to) }}">
            <div class="mb-4">
                <label for="status" class="label">Status:</label>
                <select name="status" id="status" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-full py-2.5 px-4">
                    <<option value="Pending" {{ old('status', $task->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Completed" name="Completed" id="status">Completed</option>
                </select>   
            </div>
            
            <div id="reviewfield" class="mb-4">
        
                <label for="review" class="label">Technician Review:</label>
                <textarea name="review" id="review" cols="30" rows="10" placeholder="Add review only when task is completed" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-full py-2.5 px-4"></textarea>
                
            </div>
                
            @endif
        
            <button type="submit" class="btn">Update Task</button>
        </form>
         
    </div>

</div>
@endsection
@endauth
