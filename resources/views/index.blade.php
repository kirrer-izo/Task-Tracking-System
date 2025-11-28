@extends('layouts.app')

@section('content')
@auth

<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold text-white">Dashboard</h1>
        @if(Auth::user()->role == 'Assigner')
            <a href="{{ route('tasks.create') }}" class="btn">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Create Task
            </a>
        @endif
    </div>

    @if(Auth::user()->role == 'Assigner')
        <div class="card overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-700">
                    <thead class="bg-gray-800">
                        <tr>
                            <th scope="col" class="table-th">Date Created</th>
                            <th scope="col" class="table-th">Task</th>
                            <th scope="col" class="table-th">Assigned to</th>
                            <th scope="col" class="table-th text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700 bg-gray-800">
                        @foreach ($tasks as $task)
                        <tr class="hover:bg-gray-700/50 transition-colors">
                            <td class="table-td">{{ $task->created_at->format('Y-m-d') }}</td>
                            <td class="table-td font-medium text-white">{{ $task->task }}</td>
                            <td class="table-td">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-900/50 text-purple-200">
                                    {{ $task->itTechnician->name ?? 'Unassigned' }}
                                </span>
                            </td>
                            <td class="table-td text-right space-x-2">
                                <a href="{{ route('tasks.edit', ['task' => $task->id]) }}" class="text-purple-400 hover:text-purple-300 font-medium">Edit</a>
                                <form action="{{ route('tasks.destroy', ['task' => $task->id]) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="text-red-400 hover:text-red-300 font-medium ml-2" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr> 
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @elseif (Auth::user()->role == 'IT technician')
        <div class="card overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-700">
                    <thead class="bg-gray-800">
                        <tr>
                            <th scope="col" class="table-th">Date Created</th>
                            <th scope="col" class="table-th">Task</th>
                            <th scope="col" class="table-th">Created by</th>
                            <th scope="col" class="table-th text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700 bg-gray-800">
                        @forelse ($todos as $todo)
                        <tr class="hover:bg-gray-700/50 transition-colors">
                            <td class="table-td">{{ $todo->created_at->format('Y-m-d') }}</td>
                            <td class="table-td font-medium text-white">{{ $todo->task }}</td>
                            <td class="table-td">{{ $todo->assigner->name ?? 'Unknown' }}</td>
                            <td class="table-td text-right">
                                <a href="{{ route('tasks.edit', ['task' => $todo->id]) }}" class="btn text-xs py-1.5 px-3">Update Status</a>
                            </td>
                        </tr> 
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-400">
                                <svg class="mx-auto h-12 w-12 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                </svg>
                                <p class="mt-2 text-sm font-medium">No tasks assigned to you yet.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>

@endauth
@endsection