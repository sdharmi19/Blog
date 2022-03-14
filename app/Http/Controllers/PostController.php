<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Comment;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Request\PostFormRequest;
use Auth;

class PostController extends Controller
{
    //
  public function show($slug)
  {
    $post = Post::where('slug',$slug)->first();

    if(!$post)
    {
     return redirect('/')->withErrors('requested page not found');
   }
   $comments = $post->comments;
   return view('posts.show')->withPost($post)->withComments($comments);
 }
 public function index()
 {
  $posts = Post::orderBy('created_at','desc')->paginate(2);

  foreach ($posts as $key => $value) {
    $totalCount = Comment::where('on_post',$value->id)->count();
    $user = User::find($value->author_id);
    $value->postCount = $totalCount;
    $posts[$key] = $value;
  }
    //dd($posts);
   $title = 'Latest Posts';
   return view('home')->withPosts($posts)->withTitle($title);
 }
 public function create(Request $request)
 {
    // 
  if ($request->user()->can_post()) {
    return view('posts.create');
  } else {
    return redirect('/')->withErrors('You have not sufficient permissions for writing post');
  }
}
public function store(PostFormRequest $request)
{
    //dd($request->all());
  $post = new Post();
  $post->title = $request->get('title');
  $post->body = $request->get('body');
  $post->status = $request->get('private');

  $post->slug = Str::slug($post->title);

  $image = $request->file('image');
  $imageName = time().'.'. $image->extension();  

  $image->move(public_path('images'), $imageName);
  $post->image =$imageName;
  $duplicate = Post::where('slug', $post->slug)->first();
  if ($duplicate) {
    return redirect('new-post')->withErrors('Title already exists.')->withInput();
  }

  $post->author_id = $request->user()->id;
  
  $post->save();
  return redirect('/')->withMessage('Post Created Successfully');
}
public function edit(Request $request,$slug)
{
  $post = Post::where('slug',$slug)->first();
  if($post && ($request->user()->id == $post->author_id || $request->user()->is_admin()))
    return view('posts.edit')->with('post',$post);
  return redirect('/')->withErrors('you have not sufficient permissions');
}
public function update(Request $request)
{
    //
  $post_id = $request->input('post_id');
  $post = Post::find($post_id);
  if ($post && ($post->author_id == $request->user()->id || $request->user()->is_admin())) {
    $title = $request->input('title');
    $slug = Str::slug($title);
    $duplicate = Post::where('slug', $slug)->first();
    if ($duplicate) {
      if ($duplicate->id != $post_id) {
        return redirect('home/' . $post->slug)->withErrors('Title already exists.')->withInput();
      } else {
        $post->slug = $slug;
      }
    }

    $post->title = $title;
    $post->body = $request->input('body');
    $post->save();
   
    return redirect('/')->withMessage('Post Update Successfully');
  } 
}
public function destroy(Request $request, $id)
{
    //
  $post = Post::find($id);
  if($post && ($post->author_id == $request->user()->id || $request->user()->is_admin()))
  {
    $post->delete();
    $data['message'] = 'Post deleted Successfully';
  }
  else 
  {
    $data['errors'] = 'Invalid Operation. You have not sufficient permissions';
  }
  return redirect('/')->with($data);
}
public function showDescription(Request $request,$id){
  $showDescription = Post::select('id','body')->where('id',$id)->first();
  return view('posts.description',compact('showDescription'));
}

}
