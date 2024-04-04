@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1>Delete Album: {{ $album->name }}</h1>
            <form method="POST" action="{{ route('albums.delete.submit', $album) }}" id="deleteAlbumForm">
                @csrf
                @method('POST')
                <div class="form-group">
                    <p>Do you want to delete all the pictures in this album?</p>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="delete_media" id="delete_media_true" value="1" checked>
                        <label class="form-check-label" for="delete_media_true">
                            Delete all pictures
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="delete_media" id="delete_media_false" value="0">
                        <label class="form-check-label" for="delete_media_false">
                            Move pictures to another album
                        </label>
                    </div>
                    @if ($others)
                        <div class="form-group">
                            <label for="new_album_id">Select the album to move the pictures:</label>
                            <select class="form-select"  id="new_album_id" name="new_album_id">
                                @foreach ($others as $album)
                                    <option value="{{ $album->id }}">{{ $album->name }}</option>
                                @endforeach
                            </select>

                        </div>
                    @endif
                </div>
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection
