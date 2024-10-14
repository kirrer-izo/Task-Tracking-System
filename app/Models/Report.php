<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    public function completedTask(){
        $this->belongsTo(Task::class,'completed_task');
    }

    protected $fillable = [
        'completed_task',
        'time_taken'

    ];

}
