<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $fillable = ['name'];

    public function tasks()
    {
        return $this->hasMany(Task::class, 'group_id', 'id');
    }
}
