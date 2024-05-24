@extends('layouts.master')


@section('content')

    <div class="main-container mt-5">
        @if($errors->any() )
            @foreach($errors->all() as $error )
                <div class="alert alert-danger">{{$error}}</div>
            @endforeach
        @endif

        <div class="card mb-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Edit event</h4>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <a class="btn-sm btn-success mx-1" href="{{route('events.index')}}">Back</a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('events.update', $event->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="title" class="form-label">Title</label>
                        <input id="title" type="text" class="form-control" name="title" value="{{$event->title}}">
                    </div>

                    <div class="form-group mt-4">
                        <label for="description" class="form-label">Description</label>
                        <textarea id="description" type="text" rows="10" class="form-control" name="description">{{$event->description}}</textarea>
                    </div>


                    <div class="form-group mt-4">
                        <div>
                            <img src="{{asset($event->picture)}}" alt="" width="80" height="80">
                        </div>
                        <label for="picture" class="form-label">Picture</label>
                        <input id="picture" type="file" class="form-control" name="picture">
                    </div>

                    <div class="form-group mt-3">
                       <button class="btn btn-primary">Submit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection
