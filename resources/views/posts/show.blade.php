@extends('layouts.app')

@section('content')


<div class="container">
  <div class="d-flex pt-3">
    <div class="col-8">
      <img src="/storage/{{ $post->image }}" class="w-100">
    </div>
    <div clas="col-4">
      <div>
        <div class="d-flex align-items-center">
          <div class="pe-3 ps-3">
            <img src="/storage/{{ $post->user->profile->image}}" class="rounded-circle w-100" style="max-width: 40px;">
          </div>
          <div>
            <div class="font-weight-bold　d-flex">
              <a href="/profile/{{ $post->user->id }}">
                <span class="text-dark">{{ $post->user->username }}</span>
              </a> 　|


              <div class="ps-3">
              <form onsubmit="return confirm('本当に削除しますか？')" action="{{ route('post.destroy', $post) }}" method="post">
                  @csrf
                  @method('delete')
                @if(Auth::id() === $post->user->id )
                <button type="submit" class="btn btn-outline-danger">削除</button>
                @endif
              </form>
            </div>

          </div>
          </div>

        </div>

        <hr>

        <p>
          <span class="font-weight-bold">
            <a href="/profile/{{ $post->user->id }}">
              <span class="text-dark ps-3">{{ $post->user->username }}</span>
            </a>
          </span> <div class="ps-3">{{ $post->caption }}</div>
        </p>

        <hr>


      </div>

      <div class="d-flex align-items-center　pe-3 ps-3">
              <div onclick="like({{$post->id}})"><i class="far fa-heart like-btn" ></i></div>
              <div onclick="unlike({{$post->id}})"><i class="fas fa-heart　unlike-btn" style="display:none;"></i></div>
      </div>

      <hr>

    </div>
  </div>
</div>


@endsection
<script src="{{ asset('js/alert.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" href="{{ asset('/css/like.css')  }}" >
