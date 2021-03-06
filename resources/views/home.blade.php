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
                            <label for="avatar-input">
                                <a href="#" data-toggle="modal" data-target="#AvatarModal" >
                                    @if($setavatar)

                                    <img  src="/users/{{auth()->user()->id}}/avatar.jpg" alt="..."
                                    class="img-circle" style="border-radius: 100px" width="100" height="100">

                                    @else

                                    <img  src="/users/avatar.jpg" alt="..."
                                    class="img-circle" style="border-radius: 100px" width="100" height="100">

                                    @endif

                                </a>
                            </label>

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

                                            <a href="unfollow/{{$tweet->user_id}}" type="submit" class="btn btn-primary middle">
                                                Unfollow
                                            </a>

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

                            {{-- edit tweet modal --}}

                            @if($tweet->user_id == auth()->user()->id)
                                <a href="" class="float-right" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#editTweet-{{$tweet->id}}">
                                    <span aria-hidden="true">
                                        <img src="https://image.flaticon.com/icons/png/512/61/61456.png" width="20px" height="20px" alt="">
                                    </span>
                                </a>
                            @endif

                            <div class="modal fade" id="editTweet-{{$tweet->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            @if($tweet->photo !== null)
                                                <div contentEditable="true">
                                                    <img src="{{$tweet->photo}}" width="400px" height="400px" /><br><hr>
                                                    {!! nl2br($tweet->body) !!}
                                                </div>
                                            @endif

                                        </div>
                                        <div class="modal-footer">
                                            <a href="edit/{{$tweet->id}}" type="button" class="btn btn-secondary">Save changes</a>
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


    <div class="modal fade" id="AvatarModal" tabindex="-1" role="dialog" aria-labelledby="AvatarModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Select your avatar</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/home" enctype="multipart/form-data">
                   @csrf
                    <div class="input-group mb-3">
                    <div class="custom-file">
                      <input name="avatar" type="file" class="custom-file-input" id="inputGroupFile01" accept=".png,.jpg,.jpeg,.bmp" required>

                    </div>
                      <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add</button>
                  </div>
              </form>
            </div>

          </div>
        </div>
      </div>

@endsection
