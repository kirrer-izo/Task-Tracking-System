<?php

namespace App\Http\Controllers;

use App\Mail\TaskCompleted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use \App\Mail\AssignedTask;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Task;
use App\Models\User;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        if ($user->role == 'Assigner') {
            $tasks = Task::where('created_by', $user->id)->with(['itTechnician'])->get();
            $todos = collect();
        } else {
            $tasks = collect();
            $todos = Task::where('assigned_to', $user->id)->with(['assigner'])->get();
        }
        return view('index', ['tasks' => $tasks, 'todos' => $todos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $technicians = User::where('role', 'IT technician')->get();
        return view('create', ['technicians' => $technicians]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'task' => 'required|string|max:225',
            'assigned_to' => 'required|exists:users,id'
        ]);

        $task = new Task([
            'task' => $request->input('task'),
            'created_by' => Auth::id(),
            'assigned_to' => $request->input('assigned_to')
        ]);

        $task->save();

        $assigned_user = User::find($request->input('assigned_to'));

        if ($assigned_user) {
            Mail::to($assigned_user->email)->send(new AssignedTask(['name' => Auth::user()->name]));
        }

        return redirect()->route('tasks.index')->with('success', 'Task created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('show', ['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task = Task::findOrFail($id);
        $technicians = User::where('role', 'IT technician')->get();

        return view('edit', compact('task', 'technicians'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $task = Task::findOrFail($id);

        if (Auth::user()->role == 'Assigner') {
            $request->validate([
                'task' => 'required|string|max:225',
                'assigned_to' => 'required|exists:users,id',
            ]);
            $task->task = $request->input('task');
            $task->assigned_to = $request->input('assigned_to');
        } elseif (Auth::user()->role == 'IT technician') {
            $request->validate([
                'status' => 'required',
                'review' => 'nullable'
            ]);
            $task->status = $request->input('status');
            $task->review = $request->input('review');
        }

        $task->save();

        if ($task->status == 'Completed') {
            $creator = User::find($task->created_by);
            if ($creator) {
                Mail::to($creator->email)->send(new TaskCompleted(['task' => $task->task]));
            }
        }

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Task::where('id', $id)->firstOrFail()->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted');
    }
}
