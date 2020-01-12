@extends('layouts.app')

@section('content')
<a style="margin-top: 100px" href="/explorer" class="btn btn-primary float-right">All tweets</a>

<div class="row justify-content-center">
    <div class="col-md-8">
        <form action="/tweet" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="card border-top-0" style="border-radius: 0 !important;">
                <div class="card-header bg-white"><strong>
                        Home
                    </strong></div>


                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                          <a href="#" data-toggle="modal" data-target="#exampleModal" >
                            <img  src="/users/{{auth()->user()->id}}/avatar.jpg" alt="..."
                            class="img-circle" style="border-radius: 100px" width="100" height="100">
                          </a>

                        </div>
                        <div class="col-md-10">
                            <textarea placeholder="Whats Happening..." name="body" class="form-control border-0" id="" cols="30"
                                      rows="3"></textarea>
                            <div class="float-right">
                                <label for="file-input">
                                        <img style="cursor: cell;" width="30px" height="30px" src="https://img.icons8.com/officel/2x/add-image.png"/>
                                </label>
                                <input style="display: none;" id="file-input" type="file" name="photo" />
                            </div>


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
        </form>
            {{-- @if ($users->tweets->count() > 0) --}}
        @foreach (App\Tweet::orderBy('tweets.id','DESC')->join('followers', 'tweets.user_id', '=' , 'followers.follow_id')
                            ->where('followers.user_id', auth()->user()->id)
                            ->select('tweets.id','tweets.user_id','tweets.body', 'tweets.photo')->get() as $tweet)
            <div class="card border-top-0" style="border-radius: 0 !important;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                                <img  src="/users/{{$tweet->user_id}}/avatar.jpg" alt="..."
                                class="img-circle" style="border-radius: 100px" width="100" height="100">


                            <a href="" data-toggle="modal" data-target="#id-{{$tweet->id}}">
                                <span style="margin-left: 24px">
                                    {{$tweet->user->name}}
                                </span>
                            </a>

                            <!-- Modal -->
                            <div class="modal fade" id="id-{{$tweet->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">{{$tweet->user->name}}</h5>

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="/follow" method="POST">
                                        @csrf
                                        <div>
                                            <label for="id-input">
                                                @if (App\Follower::where('follow_id',$tweet->user_id)->where('user_id',auth()->user()->id)->exists())

                                                    <button type="submit" class="btn btn-primary middle">
                                                        Unfollow
                                                    </button>
                                                @else


                                                <button type="submit" class="btn btn-primary middle">
                                                    follow
                                                </button>

                                                @endif


                                            </label>
                                            <input type="hidden" name="follow_id" value="{{$tweet->user_id}}">
                                        </div>
                                    </form>
                                </div>
                                </div>
                            </div>
                            </div>

                        </div>
                        <div class="col-md-10">
                            <div>
                                @if($tweet->photo !== null)
                                    <span>
                                        <img class="col-md-12" src="{{$tweet->photo}}" alt="">
                                    <hr>
                                    </span>
                                @endif
                            </div>

                            {!! nl2br($tweet->body) !!}
                        </div>


                    </div>

                </div>

            </div>
        @endforeach

@endsection
