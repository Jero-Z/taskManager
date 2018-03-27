<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed project
 */
class Task extends Model
{
    protected $fillable = [
        'title', 'project_id', 'completed'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function steps()
    {
        return $this->hasMany(Step::class);
    }

    public function getProjectListAttribute()
    {
        return $this->project->id;
    }
}
