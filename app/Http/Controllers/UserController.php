<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Post;
use Auth;


class UserController extends Controller
{
    //
    public function user_posts($id)
  {
    //
    $posts = Post::where('author_id',$id)->orderBy('created_at','desc')->paginate(5);
    $title = User::find($id)->name;
    return view('home')->withPosts($posts)->withTitle($title);
  }
  public function user_posts_all(Request $request)
  {
    //
    $user = $request->user();
    $posts = Post::where('author_id',$user->id)->orderBy('created_at','desc')->paginate(5);
    $title = $user->name;
    return view('home')->withPosts($posts)->withTitle($title);
  }
  
  public function profile(Request $request, $id) 
  {
    $data['user'] = User::find($id);
    if (!$data['user'])
      return redirect('/');
    if ($request -> user() && $data['user'] -> id == $request -> user() -> id) {
      $data['author'] = true;
    } else {
      $data['author'] = null;
    }
    $data['comments_count'] = $data['user'] -> comments -> count();
    $data['posts_count'] = $data['user'] -> posts -> count();
    $data['posts_active_count'] = $data['user'] -> posts -> count();
    $data['posts_draft_count'] = $data['posts_count'] - $data['posts_active_count'];
    $data['latest_posts'] = $data['user'] -> posts  -> take(5);
    $data['latest_comments'] = $data['user'] -> comments -> take(5);
    return view('admin.profile', $data);
  }
  public function logout()
  {
     Auth::logout();
    return redirect('/login');
  }
}
