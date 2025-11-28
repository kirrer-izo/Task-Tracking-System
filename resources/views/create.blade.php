@extends('layouts.app')

@section('content')
@auth

<div class="flex items-center justify-center min-h-[calc(100vh-theme(spacing.32))]">
    <div class="w-full max-w-md">
        <div class="card">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-white">Create Task</h2>
                <p class="text-gray-400 text-sm mt-1">Add a new task to your tracking system.</p>
            </div>

            @include('partials.validation-errors')
            
            <form action="{{ route('tasks.store') }}" method="post">
                @csrf
                <div class="mb-5">
                    <label for="task" class="label">Task Description</label>
                    <input type="text" name="task" id="task" placeholder="e.g. Fix navigation bug" class="input" value="{{ old('task') }}">
                </div>
            
                <div class="mb-5">
                    <label for="created_by" class="label">Created by</label>
                    <input type="text" name="created_by" id="created_by" value="{{Auth::user()->name}}" class="input bg-gray-700 cursor-not-allowed" readonly>
                </div>
            
                <div class="mb-6"> 
                    <label for="assigned_to" class="label">Assigned to</label>
                    <div class="relative">
                        <select name="assigned_to" id="assigned_to" class="input appearance-none">
                            <option value="" disabled selected>Select a technician</option>
                            @foreach ($technicians as $technician)
                                <option value="{{$technician->id}}" {{ old('assigned_to') == $technician->id ? 'selected' : '' }}>{{$technician->name}}</option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit" class="btn w-full">Create Task</button>
                    <a href="{{ route('tasks.index') }}" class="btn-secondary w-full text-center">Cancel</a>
                </div>        
            </form>
        </div>
    </div>
</div>

@endsection
@endauth
