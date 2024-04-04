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
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                Showing All Allbum
                            </span>

                            <div class="btn-group pull-right btn-group-xs">





                                <a href="{{ route('albums.create') }}" type="button" class="btn btn-default btn-sm pull-right" data-toggle="modal"
                                    data-target="#create">
                                    <i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>
                                    Create New Allbum
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">



                        <div class="table-responsive users-table">
                            <h1>Albums</h1>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Number of Pictures</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($albums as $album)
                                    <tr>
                                        <td>  <a href="{{ route('albums.show', $album->id) }}" >{{ $album->name }}</a></td>
                                        <td class="text-right">{{ $album->pictures->count() ?  : '0'  }}</td>
                                        <td class="text-right">
                                            <a href="{{ route('albums.edit', $album->id) }}" class="btn btn-sm btn-success mr-2">Edit</a>
                                            <a href="{{ route('albums.delete', $album->id) }}" class="btn btn-sm btn-danger mr-2">Delete</a>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>



                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
