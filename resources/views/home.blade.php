@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="/tweet" method="POST">
                @csrf

                <div class="card border-top-0" style="border-radius: 0 !important;">
                    <div class="card-header bg-white"><strong>
                            Home
                        </strong></div>


                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <img src="/users/{{auth()->user()->id}}/avatar.jpg" alt="..."
                                     class="img-thumbnail" style="border-radius: 100px">

                            </div>
                            <div class="col-md-10">
                                <textarea placeholder="Whats Happening..." name="body" class="form-control border-0" id="" cols="30"
                                          rows="3"></textarea>


                                @error('body')
                                <div class="alert alert-danger">
                                    <small>
                                        {{ $message }}
                                    </small>
                                </div>
                                @enderror
                            </div>


                        </div>

                    </div>
                    <div class="card-footer bg-white">
                        <button type="submit" class="btn btn-primary float-right">Tweet</button>
                    </div>
                </div>

                {{-- @if ($users->tweets->count() > 0) --}}
                @foreach(App\User::all() as $user)
                    @foreach ($user->tweets()->orderBy('id','DESC')->get() as $tweet)
                        <div class="card border-top-0" style="border-radius: 0 !important;">


                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <img src="/users/{{$user->id}}/avatar.jpg" alt="..."
                                             class="img-thumbnail" style="border-radius: 100px">
                                    <span class="col-md-2">
                                        {{$tweet->user->name}}
                                    </span>

                                    </div>
                                    <div class="col-md-10">

                                        {!! nl2br($tweet->body) !!}
                                    </div>


                                </div>

                            </div>

                        </div>
                    @endforeach
                @endforeach
                {{-- @endif --}}


            </form>
        </div>
    </div>
@endsection
