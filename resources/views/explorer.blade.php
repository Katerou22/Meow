@extends('layouts.app')

@section('content')
    <a style="margin-top: 100px" href="/home" class="btn btn-primary float-right">Home</a>


    <div class="row justify-content-center">
        <div class="col-md-8">



                {{-- @if ($users->tweets->count() > 0) --}}
                    @foreach (App\Tweet::orderBy('id','DESC')->get() as $tweet)






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

                                                @if (App\Follower::where('follow_id',$tweet->user_id)->where('user_id',auth()->user()->id)->exists())

                                                    <a href="unfollow/{{$tweet->user_id}}" type="submit" class="btn btn-primary middle">
                                                        Unfollow
                                                    </a>
                                                @else

                                                    <a href="/follow/{{$tweet->user_id}}" class="btn btn-primary middle">
                                                        follow
                                                    </a>

                                                @endif



                                            </div>
                                          </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-10">

                                    {{-- delete tweet button --}}



                                    @if($tweet->user_id == auth()->user()->id)
                                        <button type="button" class="close float-right" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#deleteTweet-{{$tweet->id}}">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    @endif

                                {{--delete tweet Modal--}}

                                    <div class="modal fade" id="deleteTweet-{{$tweet->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <h4>Are you sure to delete this tweet?!</h4>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="delete/{{$tweet->id}}" type="button" class="btn btn-secondary">Yes</a>
                                                    <a type="button" class="btn btn-primary" data-dismiss="modal">No</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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
                {{-- @endif --}}


        </div>
    </div>

@endsection
