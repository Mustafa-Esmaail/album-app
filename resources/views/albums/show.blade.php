@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1> {{ $album->name }}</h1>
            <div class="row">
                @foreach($album->pictures as $picture)
                <div class="card" style="width: 18rem;">
                    <img src="{{   asset( $picture->path)  }}" class="card-img-top" alt="{{ $picture->name }}">
                    <div class="card-body">
                      <p class="card-text">{{  $picture->name }}.</p>
                    </div>
                  </div>

                @endforeach
            </div>
            <div class="my-4">
                <a href="{{ route('albums.index') }}" class="btn btn-primary">Back to Albums</a>
                <a href="{{ route('albums.edit',$album->id) }}" class="btn btn-success">Edit Album</a>

            </div>
        </div>
    </div>
</div>
@endsection
