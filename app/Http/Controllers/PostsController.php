<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Models\Post;
use App\Models\Like;
use App\Models\Follower;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

    public function create()
    {
      $user = auth()->user();
      return view('posts.create', [
      'user'      => $user
    ]);
    }

    public function index(Post $posts, Follower $follower)
    {
      $user = auth()->user();
       $follow_ids = $follower->followingIds($user->id);
       // followed_idだけ抜き出す
       $following_ids = $follow_ids->pluck('followed_id')->toArray();

       $timelines = $posts->getTimelines($user->id, $following_ids);

       return view('posts.timeline', [
           'user'      => $user,
           'timelines' => $timelines,
           'post' => $posts
       ]);
    }

    public function store()
    {
      $data = request()->validate([
        'caption' => 'required',
        'image' => ['required', 'image'],
      ]);

      $imagePath = request('image')->store('uploads', 'public');

      $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200,1200);
      $image->save();

      auth()->user()->posts()->create([
        'caption' => $data['caption'],
        'image' => $imagePath,
      ]);
      return redirect('/profile/' . auth()->user()->id);
    }

    public function show(\App\Models\Post $post)
    {
      $user = auth()->user();

      return view('posts.show', compact('post'), [
       'user' => $user
        ]);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        $user_id = Auth::id();
        return redirect('/profile/' . auth()->user()->id);
    }

}
