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
                                            <img  src="/users/{{$tweet->user->id}}/avatar.jpg" alt="..."
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
                {{-- @endif --}}


        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
