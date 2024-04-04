@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h1>Edit Album: {{ $album->name }}</h1>
                <form method="post" action="{{ route('albums.update', $album) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $album->name) }}" required>
                    </div>
                    <!-- ... -->

                    <div id="inputGroupsContainer">
                         <!-- Input group template -->
                    <div class="input-group mb-3" id="inputGroupTemplate" >

                            <div class="mb-3 w-100">
                                <label for="picture_name">Picture Name</label>
                                <input type="text" class="form-control" id="picture_name" name="picture_name[]" required>
                              </div>




                            <div class="input-group mb-3 image-input-group">
                                <input type="file" name="pictures[]" class="form-control" id="images"  required>

                            </div>
                        <button type="button" class="btn btn-danger remove-input-group">Remove</button>
                    </div>
                    </div>
                    <button type="button" class="btn btn-primary" id="addInputGroup">Add more images</button>


                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Clone and append the input group
            $('#addInputGroup').click(function() {
                const inputGroup = $('#inputGroupTemplate').clone();
                $('#inputGroupsContainer').append(inputGroup);
            });

            // Remove the input group
            $(document).on('click', '.remove-input-group', function() {
                $(this).closest('.input-group').remove();
            });
        });
    </script>
@endpush
