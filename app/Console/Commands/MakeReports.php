<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;
use App\Models\Report;
use Carbon\Carbon;

class MakeReports extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make-reports';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $completed_task = Task::where('status','Completed')->get();

        foreach($completed_task as $task){
            $time_taken = Carbon::parse($task->updated_at)->diffInSeconds(Carbon::parse($task->created_at));
            
            Report::create([
                'completed_task' => $task->id,
                'time_taken' => gmdate('H:i:s',$time_taken)
            ]);
        }
    }
}
