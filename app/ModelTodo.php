<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelTodo extends Model
{
    protected $table = 'todo';

    protected $fillable = ['activity', 'description'];
}
