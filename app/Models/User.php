<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
      {
        parent::boot();

        static::created(function ($user){
          $user->profile()->create([
            'title' => $user->username,
          ]);
        });
      }


    public function getAllUsers(Int $user_id)
    {
    return $this->Where('id', '<>', $user_id)->paginate(5);
  }


    public function posts()
    {
      return $this->hasMany(Post::class)->orderBy('created_at', 'DESC');
    }

    public function profile()
    {
      return $this->hasOne(\App\Models\Profile::class);
    }

    public function followers()
   {
       return $this->belongsToMany(self::class, 'followers', 'followed_id', 'following_id');
   }

   public function follows()
   {
       return $this->belongsToMany(self::class, 'followers', 'following_id', 'followed_id');
   }

   // フォローする
    public function follow(Int $user_id)
    {
        return $this->follows()->attach($user_id);
    }

    // フォロー解除する
    public function unfollow(Int $user_id)
    {
        return $this->follows()->detach($user_id);
    }

    // フォローしているか
    public function isFollowing(Int $user_id)
    {
      return $this->follows()->where('followed_id', $user_id)->exists();
    }

    // フォローされているか
    public function isFollowed(Int $user_id)
    {
        return (boolean) $this->followers()->where('following_id', $user_id)->first(['id']);
    }

    //フォローカウント
    public function getFollowCount()
    {
        return $this->follows()->count();
    }

    public function getFollowerCount()
    {
        return $this->followers()->count();
    }


    //多対多のリレーションを書く
    public function likes()
    {
        return $this->belongsToMany('App\Models\Post','likes','user_id','post_id')->withTimestamps();
    }

    //この投稿に対して既にlikeしたかどうかを判別する
    public function isLike($postId)
    {
      return $this->likes()->where('post_id',$postId)->exists();
    }

    //isLikeを使って、既にlikeしたか確認したあと、いいねする（重複させない）
    public function like($postId)
    {
      if($this->isLike($postId)){
        //もし既に「いいね」していたら何もしない
      } else {
        $this->likes()->attach($postId);
      }
    }

    //isLikeを使って、既にlikeしたか確認して、もししていたら解除する
    public function unlike($postId)
    {
      if($this->isLike($postId)){
        //もし既に「いいね」していたら消す
        $this->likes()->detach($postId);
      } else {
      }
    }

    public function userDestroy(Int $user)
{
    return $this->where('user_id', $user)->delete();
}

}
