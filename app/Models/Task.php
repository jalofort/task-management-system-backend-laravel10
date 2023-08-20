<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Task extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $fillable = ['title', 'description', 'group_id', 'created_at', 'created_by'];

    public function group()
    {
        return $this->belongsTo(Group::class)->select(['id', 'name']);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'id')
            ->select(['id', DB::raw("CONCAT(first_name, ' ', last_name) AS full_name")]);
    }
}
