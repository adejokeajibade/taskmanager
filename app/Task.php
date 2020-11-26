<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
  protected $table = 'tasks';
  use SoftDeletes;
  protected $fillable = ['id'];
  
  	
	public function taskUsers()
    {
        return $this->belongsTo('App\UsersList','user_id','id');
    }
}
