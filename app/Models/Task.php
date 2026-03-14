<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['name', 'description', 'status_id', 'assigned_to_id', 'created_by_id'];

    public function status()
    {
        return $this->belongsTo(TaskStatus::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to_id');
    }
}
