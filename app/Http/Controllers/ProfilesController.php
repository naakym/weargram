<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Models\Follower;

class ProfilesController extends Controller
{
  public function index(User $user)
  {
    $follower_count = $user->getFollowerCount();
    $follow_count = $user->getFollowCount();

      return view('profiles.index', compact('user', 'follow_count', 'follower_count'));
  }

  public function edit(User $user)
  {
    $this->authorize('update', $user->profile);

    return view('profiles.edit', compact('user'));
  }
  public function update(User $user)
  {
    $data = request()->validate([
      'title' => 'required',
      'description' => 'required',
      'url' => 'url',
      'image' => '',
    ]);
    if (request('image')) {
      $imagePath = request('image')->store('profile', 'public');

      $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000,1000);
      $image->save();

      $imageArray = ['image' => $imagePath];
    }
    auth()->user()->profile->update(array_merge(
      $data,
      $imageArray ?? []
    ));
    return redirect("/profile/{$user->id}");
  }


  // フォロー
     public function follow(User $user)
     {
         $follower = auth()->user();
         // フォローしているか
         $is_following = $follower->isFollowing($user->id);
         if(!$is_following) {
             // フォローしていなければフォローする
             $follower->follow($user->id);
             return back();
         }
     }

     // フォロー解除
     public function unfollow(User $user)
     {
         $follower = auth()->user();
         // フォローしているか
         $is_following = $follower->isFollowing($user->id);
         if($is_following) {
             // フォローしていればフォローを解除する
             $follower->unfollow($user->id);
             return back();
         }
     }



}
