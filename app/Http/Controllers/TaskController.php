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
        $tasks = Task::where('created_by',$user->name)->get();
        $todos = Task::where('assigned_to',$user->name)->get();
       return view('index',['tasks'=>$tasks,'todos'=>$todos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $tasks = Task::all(); 
        $technicians = User::where('role','IT technician')->get();
        
        
        return view('create',['tasks'=>$tasks,'technicians'=>$technicians]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,User $user)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'task' => 'required|string|max:225',
            'created_by' => 'required',
            'assigned_to' => 'required'
        ]);
        $task = new Task([
            'task' => $request->input('task'),
            'created_by' => $request->input('created_by'),
            'assigned_to' => $request->input('assigned_to')

        ]);

        $task->save();

        $assigned_user = DB::table('tasks')->join('users','tasks.assigned_to','=','users.name')->value('users.email');

        // if($assigned_user && $assigned_user->email){
            Mail::to($assigned_user)->send(new AssignedTask(['name' => $task->created_by]));

        // }else{
        //     throw new \LogicException('Assigned user does not exist or does not have valid email address');
        // }

        return redirect()->route('tasks.index')->with('success','Task created succesfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
    
        return view('show',['task'=> $task]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tasks = Task::all();
        $users = Task::all();
        $task = Task::findOrFail($id);
        $technicians = User::where('role','IT technician')->get();

        return view('edit',compact('task','tasks','technicians'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {   
        $user = User::all();
        $task = Task::all();
        $technicians = User::where('role','IT technician')->get();
        // if(Auth::user()->name != $task->created_by){
        //     abort(404);
        // }
         $validatedData = $request->validate([
            'task' => 'required|string|max:225',
            'created_by' => 'required',
            'assigned_to' => 'required',
            'status' => 'required',
            'review' => 'nullable'
            
        ]);

        // if($request->input('status')=='Completed'){
        //     $request->validate([
        //         'review' => 'required'
        //     ]);
        // }

        $task = Task::findOrFail($id);
        $task->task = $request->input('task');
        $task->created_by = $request->input('created_by');
        $task->assigned_to = $request->input('assigned_to');
        $task->status = $request->input('status');
        $task->review = $request->input('review');
        $task->save();

        $created_by = DB::table('tasks')->join('users','tasks.created_by','=','users.name')->value('users.email');
        if($task->status == 'Completed'){
            
            Mail::to($created_by)->send(new TaskCompleted(['task' => $task->task]));
        }

        return redirect()->route('tasks.index',compact('technicians'))->with('success','Task updated successfuly');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Task::where('id',$id)->firstOrFail()->delete();
        
        return redirect()->route('tasks.index')->with('success','Task deleted');
    }
}
