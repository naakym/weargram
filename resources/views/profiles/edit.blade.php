@extends('layouts.app')

@section('content')
<div class="container">
  <form action="/profile/{{ $user->id }}" enctype="multipart/form-data" method="post">
    @csrf
    @method('PATCH')

    <div class="row">
      <div class="col-8 offset-2">

        <div class="row">
          <h1>プロフィールを編集</h1>
        </div>

        <div class="row mb-3">
            <label for="title" class="col-md-4 col-form-label">名前</label>

                <input id="title"
                       type="text"
                       class="form-control @error('title') is-invalid @enderror"
                       name="title"
                       value="{{ old('title') ?? $user->profile->title }}"
                       autocomplete="title" autofocus>

                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
          </div>

          <div class="row mb-3">
              <label for="description" class="col-md-4 col-form-label">自己紹介</label>

                  <input id="description"
                         type="text"
                         class="form-control @error('title') is-invalid @enderror"
                         name="description"
                         value="{{ old('description') ?? $user->profile->description }}"
                         autocomplete="description" autofocus>

                  @error('description')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
            </div>

            <div class="row mb-3">
                <label for="url" class="col-md-4 col-form-label">ウェブサイト</label>

                    <input id="url"
                           type="text"
                           class="form-control @error('url') is-invalid @enderror"
                           name="url"
                           value="{{ old('url') ?? $user->profile->url }}"
                           autocomplete="url" autofocus>

                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
              </div>

          <div class="row">
            <label for="description" class="col-md-4 col-form-label">プロフィール写真を変更</label>

            <input type="file" class="form-control-file" id="image" name="image">

                @error('image')
                    <strong>{{ $message }}</strong>
            @enderror
          </div>

          <div class="row　pt-4">
            <button class="btn btn-primary">変更する</button>
          </div>

      </div>
    </div>
  </form>
</div>
@endsection
