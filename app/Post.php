<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
  
  protected $guarded = [];

  public function comments()
  {
    return $this->hasMany('App\Comment', 'on_post');
  }
  
  public function author()
  {
    return $this->belongsTo('App\User', 'author_id');
  }
}