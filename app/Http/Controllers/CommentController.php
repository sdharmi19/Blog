<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    
    public function store(Request $request)
  {
    
    $input['from_user'] = $request->user()->id;
    $input['on_post'] = $request->input('on_post');
    $input['body'] = $request->input('body');
    $slug = $request->input('slug');
    Comment::create( $input );
    return redirect($slug)->with('message', 'Comment published');     
  }
}
