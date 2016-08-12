<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $fillable=[
    	'id_user',
        'title',
        'description',
        'priority',
        'due_date',
        'complete'
    ];
}
