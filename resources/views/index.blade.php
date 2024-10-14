@extends('layouts.app')

@section('content')
@auth

<div class="flex h-screen bg-gray-100">


    <div class="hidden md:flex flex-col w-64 bg-gray-800">
        <div class="flex items-center justify-center h-16 bg-grey-900">
            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" style="margin-right: 8px">
                <path fill="none" stroke="white" stroke-width="2" d="M16 7h3v4h-3zm-7 8h11M9 11h4M9 7h4M6 18.5a2.5 2.5 0 1 1-5 0V7h5.025M6 18.5V3h17v15.5a2.5 2.5 0 0 1-2.5 2.5h-17" />
            </svg>
            
              
            
        </div>
        <div class="flex flex-col flex-1 overflow-y-auto">
            <nav class="flex-1 px-2 py-4 bg-gray-800">
                <a href="{{route('welcome')}}" class="flex items-center px-4 py-2 mt-2 text-gray-100 hover:bg-gray-400 hover:bg-opacity-25 rounded-2xl">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="margin-right: 80 px">
                        <path fill="currentColor" fill-rule="evenodd" d="M11.293 3.293a1 1 0 0 1 1.414 0l6 6l2 2a1 1 0 0 1-1.414 1.414L19 12.414V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2v-6.586l-.293.293a1 1 0 0 1-1.414-1.414l2-2z" clip-rule="evenodd" />
                    </svg>
                    Home
                </a>
                <a href="#" class="flex items-center px-4 py-2 mt-2 text-gray-100 hover:bg-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="margin-right: 8px">
                        <path fill="none" stroke="currentColor" stroke-width="2" d="M16 7h3v4h-3zm-7 8h11M9 11h4M9 7h4M6 18.5a2.5 2.5 0 1 1-5 0V7h5.025M6 18.5V3h17v15.5a2.5 2.5 0 0 1-2.5 2.5h-17" />
                    </svg>
                    Services
                </a>
                <a href="#" class="flex items-center px-4 py-2 mt-2 text-gray-100 hover:bg-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="margin-right: 8px">
                        <path fill="currentColor" d="M12 2A10 10 0 0 0 2 12a9.89 9.89 0 0 0 2.26 6.33l-2 2a1 1 0 0 0-.21 1.09A1 1 0 0 0 3 22h9a10 10 0 0 0 0-20m0 18H5.41l.93-.93a1 1 0 0 0 0-1.41A8 8 0 1 1 12 20m5-9H7a1 1 0 0 0 0 2h10a1 1 0 0 0 0-2m-2 4H9a1 1 0 0 0 0 2h6a1 1 0 0 0 0-2M9 9h6a1 1 0 0 0 0-2H9a1 1 0 0 0 0 2" />
                    </svg>
                    About
                </a>
            </nav>
        </div>
    </div>

    
   
    @if(Auth::user()->role== 'Assigner')
    <div class="shadow-lg rounded-lg overflow-hidden ">
        
        <div
        class="flex justify-end mb-4 mt-4">
        
        <div class="text-center space-y-2 sm:text-left">
            
            <div class="space-y-0.5 text-center">
                <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="">
                    @csrf
                    <select name="userOptions" id="userOptions" class="py-2 px-4 flex justify-center items-center bg-white text-gray-900 transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg" onchange="handleSelectChange()">
                        <option value="">{{ Auth::user()->name }}</option>
                        <option value="logout" class="py-2 px-4 flex justify-center items-center bg-red-600 hover:bg-red-700 focus:ring-red-500 focus:ring-offset-red-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg">Logout</option>
                    </select>
                </form>

                
            </div>
            
        </div>
    </div>
        
    <div class="shadow-lg rounded-lg overflow-hidden mx-4 md:mx-10">
        <table class="w-full table-fixed">
            <thead>
                <tr class="bg-gray-100">
                    <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">Date Created</th>
                    <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">Task</th>
                    <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">Assigned to</th>
                    <th><a href="{{route('tasks.create')}}" class=" py-2 px-4 flex justify-center items-center bg-purple-600 hover:bg-purple-700 focus:ring-red-500 focus:ring-offset-red-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg">Create Task</a></th>
                    
                </tr>
            </thead>
            <tbody class="bg-white">
            @foreach ($tasks as $task )
            <tr>
                <td class="py-4 px-6 border-b border-gray-200">{{$task->created_at->format('Y-m-d')}}</td>
                <td class="py-4 px-6 border-b border-gray-200">{{$task->task}}</td>
                <td class="py-4 px-6 border-b border-gray-200">{{$task->assigned_to}}</td>
                <td class="py-4 px-6 text-center border-b border-gray-200">
                    <div class="flex space-x-4">
                        <a href="{{route('tasks.edit',['task' => $task->id])}}" class="max-w-[140px] py-2 px-4 flex justify-center items-center  bg-purple-600 hover:bg-purple-700 focus:ring-red-500 focus:ring-offset-red-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg">Edit Task</a>                <form action="{{route('tasks.destroy',['task'=>$task->id])}}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="text-white bg-red-600 hover:bg-red-700 focus:ring-2 focus:ring-blue-300 font-medium rounded-lg text-sm py-2.5 px-5 w-full sm:w-auto">Delete Task</button>
                    </form></td>

                    </div>
            </tr> 
            @endforeach
            </tbody>
        </table>
    </div>
    </div>
       
                

           
            
        
      
    
    @elseif (Auth::user()->role == 'IT technician')
    <div class="shadow-lg rounded-lg overflow-hidden ">
        
        <div
        class="flex justify-end mb-4 mt-4">
        
        <div class="text-center space-y-2 sm:text-left">
            
            <div class="space-y-0.5 text-center ml-6">
                <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="ml-6">
                    @csrf
                    <select name="userOptions" id="userOptions" class="ml-6 py-2 px-4 flex justify-center items-center bg-white text-gray-900 transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg" onchange="handleSelectChange()">
                        <option value="">{{ Auth::user()->name }}</option>
                        <option value="logout" class="py-2 px-4 flex justify-center items-center bg-red-600 hover:bg-red-700 focus:ring-red-500 focus:ring-offset-red-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg">Logout</option>
                    </select>
                </form>

                
            </div>
            
        </div>
    </div>
        
    <div class="shadow-lg rounded-lg overflow-hidden mx-4 md:mx-10">
        <table class="w-full table-fixed">
            <thead>
                <tr class="bg-gray-100">
                    <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">Date Created</th>
                    <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">Task</th>
                    <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">Created by</th>
                    <th></th>
                    
                </tr>
            </thead>
            <tbody class="bg-white">
            @foreach ($todos as $todo )
            <tr>
                <td class="py-4 px-6 border-b border-gray-200">{{$todo->created_at->format('Y-m-d')}}</td>
                <td class="py-4 px-6 border-b border-gray-200">{{$todo->task}}</td>
                <td class="py-4 px-6 border-b border-gray-200">{{$todo->created_by}}</td>
                <td class="py-4 px-6 text-center border-b border-gray-200">
                    <div class="flex space-x-4">
                        <a href="{{route('tasks.edit',['task' => $todo->id])}}" class="max-w-[140px] py-2 px-4 flex justify-center items-center  bg-purple-600 hover:bg-purple-700 focus:ring-red-500 focus:ring-offset-red-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg">Edit Task</a>   
                </td>

                    </div>
            </tr> 
            @endforeach
            </tbody>
        </table>
    </div>
    </div>
       
                

           
            
        {{-- <div class="flex flex-col mb-8 md:mb-auto gap-3 5 flex-1 p-4 mt-0">
            <h2 class="flex gap-3 items-center m-auto text-lg font-bold md:flex-col md:gap-2">Tasks Assigned To</h2>
            <h3 class="flex gap-3 items-center m-auto text-lg  md:flex-col md:gap-2">{{Auth::user()->name}} - {{Auth::user()->role}}  </h3>
            <div class="flex gap-3 items-center m-auto text-lg font-bold  md:gap-2">
                <a href="{{'/logout'}}" class="max-w-[140px] py-2 px-4 flex justify-center items-center  bg-red-600 hover:bg-red-700 focus:ring-red-500 focus:ring-offset-red-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg">Logout</a> 
            </div>
            
            @foreach ($todos as $todo )
            <div>
                <ul class="flex flex-col gap-3.5 w-full sm:max-w-md m-auto">
                    <li class="w-full bg-gray-100 p-3 rounded-md">
                  
                            <a href="{{route('tasks.show', $todo->id)}}">{{$todo->task}}</a>
                        
                    </li>
                </ul>
            </div>
            @endforeach
            @empty($tasks)
            <P>You have no Tasks assigned to you</P>
            @endempty
        
        </div>  --}}
    @endif
</div>

<script>
    function handleSelectChange() {
        const select = document.getElementById('userOptions');
        if (select.value === 'logout') {
            document.getElementById('logoutForm').submit();
        }
    }
    </script>
@endauth
@endsection