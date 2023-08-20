<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $fillable = ['first_name', 'last_name', 'email', 'password', 'access_token', 'created_at'];

    public function tasks()
    {
        return $this->hasMany(Task::class, 'created_by', 'id');
    }
}
