<?php

namespace App\Models;

use App\Models\Task;
use App\Models\User;
use App\Models\TaskStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TaskFollowUp extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'task_id',
        'task_status_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function taskStatus()
    {
        return $this->belongsTo(TaskStatus::class);
    }
}
