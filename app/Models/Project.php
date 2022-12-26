<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'details',
        'created_by'
    ];

    protected $with = ['created_by'];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
