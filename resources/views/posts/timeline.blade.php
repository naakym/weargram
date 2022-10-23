@extends('layouts.app')

@section('content')

<div class="container center-block">



              @foreach ($timelines as $timeline)

              <div class="col-md-8 mb-3">
                                  <div class="card">
                                      <div class="card-haeder p-3 w-100 d-flex">
                                        <a href="/profile/{{ $timeline->user->id }}">
                                          <img src="{{ $timeline->user->profile->profileImage() }}" class="rounded-circle" width="50" height="50">
                                        </a>

                                          <div class="ml-2 d-flex flex-column">
                                            <a href="/profile/{{ $timeline->user->id }}">
                                              <span class="text-dark">{{ $timeline->user->username }}</span>
                                            </a>
                                            <a href="/profile/{{ $timeline->user->id }}">
                                              <img src="/storage/{{ $timeline->image }}" class="w-100">
                                            </s>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                @endforeach
              </div>
<div class="userbtn">
@endsection
