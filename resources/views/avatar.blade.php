@extends('layouts.app')

@section('content')

<form action="/avatar" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="input-group mb-3">
        <div class="input-group-prepend">
          <button class="btn btn-outline-secondary" type="submit">Add</button>
        </div>
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="inputGroupFile03" name="photo" required>
          <label class="custom-file-label" for="inputGroupFile03">Choose file</label>
        </div>
      </div>
</form>



@endsection
