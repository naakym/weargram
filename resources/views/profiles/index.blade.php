@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row　" style="margin: auto;">
    <div class="col-3 p-5">
      <img src="{{ $user->profile->profileImage() }}" class="rounded-circle w-100">
    </div>
    <div class="col-9 pt-5">
      <div class="d-flex justify-content-between align-items-baseline">
        <div class="d-flex align-items-center pb-4">
          <div class="h4">{{ $user->username }}</div>


          <div class="d-flex justify-content-end flex-grow-1 ps-3">
            @if (auth()->user()->isFollowing($user->id))
            <form action="{{ route('unfollow', ['user' => $user->id]) }}" method="POST">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}


              <button type="submit" class="btn btn-danger">フォロー解除</button>
            </form>
            @else
            <form action="{{ route('follow', ['user' => $user->id]) }}" method="POST">
              {{ csrf_field() }}

              @cannot('update', $user->profile)
              <button type="submit" class="btn btn-primary">フォローする</button>
            </form>
            @endif
            @endcan

            @if (auth()->user()->isFollowed($user->id))
            <div class="px-2">
              <span class="px-1 bg-secondary text-light">フォローされています</span>
            </div>
            @endif

          </div>
        </div>
      </div>

<div class="d-flex">
         @can('update', $user->profile)
          <button type="button" class="btn btn-outline-secondary"><a href="/p/create">投稿</a></button>
         @endcan

         @can('update', $user->profile)
      　   <button type="button" class="btn btn-outline-secondary"><a href="/profile/{{ $user->id}}/edit">プロフィールを編集</a></button>
         @endcan

       <form></form>


       <form onsubmit="return confirm('本当に削除しますか？')" action="{{ route('user.delete', $user) }}" method="post">
       @csrf
       @method('delete')
       @can('update', $user->profile)
     　<button type="submit" class="btn btn-outline-danger">アカウントを削除</button>
       @endcan
     </form>


@can('update', $user->profile)
     @can('system-only')
     　<button type="button" class="btn btn-outline-warning"><a href="/account/delete/{{ $user->id }}">管理者用ページ</a></button>
     @endcan
      @endcan
</div>

      <div class="d-flex pt-3">
        <div class="pe-5">投稿<strong>{{ $user->posts->count() }}</strong> 件</div>
        <div class="pe-5">フォロワー<strong>{{ $follower_count }}</strong>人</div>
        <div class="pe-5">フォロー中<strong>{{ $follow_count }}</strong>人</div>
      </div>
      <div class="pt-4 font-weight-bold">{{ $user->profile->title }}</div>
      <div>{{ $user->profile->description }}</div>
      <div><a href="#">{{ $user->profile->url }}</a></div>
    </div>
  </div>

  <div class="row　pt-5">
    @foreach($user->posts as $post)
     <div class="col-4 pb-4">
       <a href="/p/{{ $post->id }}">
         <img src="/storage/{{ $post->image }}" class="w-100">
       </a>
     </div>
    @endforeach

  </div>
</div>
@endsection
