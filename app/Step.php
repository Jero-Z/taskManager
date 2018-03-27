<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property bool completed 是否完成
 */
class Step extends Model
{
    protected $fillable = [
        'name', 'completed'
    ];


    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function getCompletedAttribute($value)
    {
        if ($value) {
            return $this->completed = true;
        }
        return $this->completed = false;
    }

}
