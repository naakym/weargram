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
                            <form onsubmit="return confirm('本当に削除しますか？')" action="{{ route('user.destroy', $user) }}" method="post">
                                @csrf
                                @method('delete')

                              <button type="submit" class="btn btn-outline-danger">削除</button>
                            
                            </form>
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
