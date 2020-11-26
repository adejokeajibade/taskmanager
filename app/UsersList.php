<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UsersList extends Model
{
  protected $table = 'users_lists';
  use SoftDeletes;
  protected $fillable = ['id'];
  
  public function AssignedTask() 
    {
        return $this->hasMany('App\Task','user_id','id');
    }
}
