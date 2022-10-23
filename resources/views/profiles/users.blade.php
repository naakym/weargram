@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
              <h4>おすすめ</h4>
                @foreach ($all_users as $user)
                    <div class="card">
                        <div class="card-haeder p-3 w-100 d-flex">
                            <img src="{{ $user->profile->profileImage() }}" class="rounded-circle" width="50" height="50">
                            <div class="ml-2 d-flex flex-column">
                              <a href="/profile/{{ $user->id }}">
                                <p class="mb-0 text-dark">{{ $user->username }}</p>
                              </a>
                            </div>
                            <div class="ps-3">
                              @if (auth()->user()->isFollowing($user->id))
                              <form action="{{ route('unfollow', ['user' => $user->id]) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}


                                <button type="submit" class="btn btn-danger　btn-sm">フォロー解除</button>
                              </form>
                              @else
                              <form action="{{ route('follow', ['user' => $user->id]) }}" method="POST">
                                {{ csrf_field() }}

                                @cannot('update', $user->profile)
                                <button type="submit" class="btn btn-primary　btn-sm">フォローする</button>
                              </form>
                              @endif
                              @endcan

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="my-4 d-flex justify-content-center">
            {{ $all_users->links() }}
        </div>
    </div>
@endsection
