<?php

namespace App\Models;

use App\Models\User;
use App\Models\Project;
use App\Models\TaskFollowUp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'des',
        'project_id',
        'task_sender_id',
        'task_reciver_id',
        'start_date',
        'end_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    public function taskfollowup()
    {
        return $this->belongsTo(TaskFollowUp::class);
    }
}
