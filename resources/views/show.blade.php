@auth
@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-white">Task Details</h1>
        <a href="{{ route('tasks.index') }}" class="btn-secondary">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Dashboard
        </a>
    </div>

    <div class="card overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-700">
            <h3 class="text-lg font-medium leading-6 text-white">
                {{ $task->task }}
            </h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-400">
                Task information and status.
            </p>
        </div>
        <div class="px-6 py-5">
            <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-400">Created by</dt>
                    <dd class="mt-1 text-sm text-white">{{ $task->assigner->name ?? 'Unknown' }}</dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-400">Assigned to</dt>
                    <dd class="mt-1 text-sm text-white">{{ $task->itTechnician->name ?? 'Unassigned' }}</dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-400">Status</dt>
                    <dd class="mt-1 text-sm">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-900/50 text-purple-200">
                            {{ $task->status }}
                        </span>
                    </dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-400">Created at</dt>
                    <dd class="mt-1 text-sm text-white">{{ $task->created_at->format('M d, Y H:i') }}</dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-400">Last Updated</dt>
                    <dd class="mt-1 text-sm text-white">{{ $task->updated_at->format('M d, Y H:i') }}</dd>
                </div>
                @if($task->review)
                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-400">Technician Review</dt>
                    <dd class="mt-1 text-sm text-white bg-gray-900/50 p-3 rounded-lg border border-gray-700">
                        {{ $task->review }}
                    </dd>
                </div>
                @endif
            </dl>
        </div>
        <div class="px-6 py-4 bg-gray-800/50 border-t border-gray-700 flex justify-end gap-3">
            @if (Auth::id() == $task->created_by)
                <form action="{{ route('tasks.destroy', ['task' => $task->id]) }}" method="POST" class="inline-block">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn-danger" onclick="return confirm('Are you sure you want to delete this task?')">Delete Task</button>
                </form>
                <a href="{{ route('tasks.edit', ['task' => $task->id]) }}" class="btn">Edit Task</a>
            @elseif (Auth::id() == $task->assigned_to)
                <a href="{{ route('tasks.edit', ['task' => $task->id]) }}" class="btn">Update Status</a>
            @endif
        </div>
    </div>
</div>
@endsection
@endauth

