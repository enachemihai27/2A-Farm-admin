@extends('layouts.master')


@section('content')

    <div class="main-container mt-5">
        @include('layouts.messages')
        <div class="card mb-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Add partner</h4>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <a class="btn-sm btn-success mx-1" href="{{route('partners.privateIndex')}}">Back</a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('partners.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="form-label">Name</label>
                        <input id="name" type="text" class="form-control" name="name" value="{{old('name')}}">
                    </div>

                    <div class="form-group">
                        <label for="link" class="form-label">Link</label>
                        <input id="link" type="text" class="form-control" name="link" value="{{old('link')}}">
                    </div>


                    <div class="form-group">
                        <label for="image" class="form-label">Image</label>
                        <input id="image" type="file" class="form-control" name="image">
                    </div>

                    <div class="form-group mt-3">
                       <button class="btn btn-primary">Submit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection
