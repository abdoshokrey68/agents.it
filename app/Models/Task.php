<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $with = ['project' ,'user', 'created_by'];

    protected $fillable = [
        'name',
        'details',
        'user_id',
        'project_id',
        'created_by',
        'status'
    ];

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function project () {
        return $this->belongsTo(Project::class);
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
