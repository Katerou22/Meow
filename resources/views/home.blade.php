@extends('layouts.app')

@section('content')
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

                {{-- @if ($users->tweets->count() > 0) --}}
                    @foreach (App\Tweet::orderBy('id','DESC')->get() as $tweet)
                        <div class="card border-top-0" style="border-radius: 0 !important;">


                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                            <img  src="/users/{{$tweet->user->id}}/avatar.jpg" alt="..."
                                            class="img-circle" style="border-radius: 100px" width="100" height="100">
                                    <span style="margin-left: 24px">
                                        <a href="">
                                        {{$tweet->user->name}}
                                        </a>
                                    </span>

                                    </div>
                                    <div class="col-md-10">
                                        <div>
                                            {{-- @if($tweet->photo !== null) --}}
                                            {{-- { --}}
                                                <span>
                                                    <img class="col-md-12" src="{{$tweet->photo}}" alt="">
                                                <hr>
                                                </span>
                                            {{-- }
                                            @endif --}}
                                        </div>

                                        {!! nl2br($tweet->body) !!}
                                    </div>


                                </div>

                            </div>

                        </div>
                    @endforeach
                {{-- @endif --}}


            </form>
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
