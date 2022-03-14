<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  
  protected $guarded = [];
  public function author()
  {
    return $this->belongsTo('App\User', 'from_user');
  }
  public function post()
  {
    return $this->belongsTo('App\Post', 'on_post');
  }
}
