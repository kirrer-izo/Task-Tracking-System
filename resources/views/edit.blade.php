@auth
@extends('layouts.app')

@section('content')

<div class="flex items-center justify-center min-h-[calc(100vh-theme(spacing.32))]">
    <div class="w-full max-w-md">
        <div class="card">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-white">Edit Task</h2>
                <p class="text-gray-400 text-sm mt-1">Update task details and status.</p>
            </div>

            @include('partials.validation-errors')
            
            <form action="{{ route('tasks.update',['task'=>$task->id]) }}" method="post">
                @csrf
                @method('PUT')  
                
                @if (Auth::user()->role == 'Assigner')
                    <div class="mb-5">
                        <label for="task" class="label">Task Description</label>
                        <input type="text" name="task" id="task" placeholder="e.g. Fix navigation bug" value="{{old('task',$task->task)}}" class="input">
                    </div>
                
                    <div class="mb-5">
                        <label for="created_by" class="label">Created by</label>
                        <input type="text" name="created_by" id="created_by" value="{{old('created_by',$task->created_by)}}" class="input bg-gray-700 cursor-not-allowed" readonly>
                    </div>

                    <div class="mb-6">
                        <label for="assigned_to" class="label">Assigned to</label>
                        <div class="relative">
                            <select name="assigned_to" id="assigned_to" class="input appearance-none">
                                @foreach ($technicians as $technician)
                                    <option value="{{$technician->id}}" {{ old('assigned_to', $task->assigned_to) == $technician->id ? 'selected' : '' }}>{{$technician->name}}</option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-400">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="status" value="{{old('status',$task->status)}}">
                @endif
                
                @if (Auth::user()->role == 'IT technician' && Auth::user()->name==$task->assigned_to)
                    <input type="hidden" name="task" value="{{old('task',$task->task)}}">
                    <input type="hidden" name="created_by" value="{{old('created_by',$task->created_by)}}">
                    <input type="hidden" name="assigned_to" value="{{ old('assigned_to', $task->assigned_to) }}">
                    
                    <div class="mb-5">
                        <label for="status" class="label">Status</label>
                        <div class="relative">
                            <select name="status" id="status" class="input appearance-none">
                                <option value="Pending" {{ old('status', $task->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Completed" {{ old('status', $task->status) == 'Completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-400">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div id="reviewfield" class="mb-6">
                        <label for="review" class="label">Technician Review</label>
                        <textarea name="review" id="review" rows="4" placeholder="Add review only when task is completed" class="input">{{ old('review', $task->review) }}</textarea>
                    </div>
                @endif
            
                <div class="flex items-center gap-4">
                    <button type="submit" class="btn w-full">Update Task</button>
                    <a href="{{ route('tasks.index') }}" class="btn-secondary w-full text-center">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@endauth
