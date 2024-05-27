@extends('layouts.master')


@section('content')

    <div class="main-container mt-5">
        @include('layouts.messages')
        <div class="card mb-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Edit job</h4>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <a class="btn-sm btn-success mx-1" href="{{route('jobs.index')}}">Back</a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('jobs.update', $job->id)}}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name" class="form-label">Name</label>
                        <input id="name" type="text" class="form-control" name="name" value="{{$job->name}}">
                    </div>

                    <div class="form-group">
                        <label for="description" class="form-label mt-2">Description</label>
                        <textarea rows="10" id="description" type="text" class="form-control" name="description">{{$job->description}}</textarea>
                    </div>

                    <div class="form-group mt-3">
                       <button class="btn btn-primary">Submit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection
