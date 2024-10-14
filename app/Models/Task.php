<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public function assigner(){
        return $this->belongsTo(User::class,'created_by');
    }

    public function itTechnician(){
        return $this->belongsTo(User::class,'assigned_to');
    }

    public function completedTask(){
        return $this->hasOne(Report::class,'completed_task');
    }

    protected $fillable = [
        'task',
        'created_by',
        'assigned_to',
        'status',
        'review'
    ];

}
