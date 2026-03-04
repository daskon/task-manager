<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;

    protected $casts = [
        'is_done' => 'boolean',
        'due_date' => 'date'
    ];

    protected $fillable = ['project_id','title','is_done','due_date'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
