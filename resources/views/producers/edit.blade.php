@extends('layouts.master')


@section('content')

    <div class="main-container mt-5">
        @include('layouts.messages')
        <div class="card mb-4">
            <div class="card-header">
                <div class="flex flex-row items-center">
                    <div class="col-md-6">
                        <h4 class="text-lg font-semibold">Editeaza producator</h4>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <a class="btn btn-success mx-1" href="{{route('producers.privateIndex')}}">Inapoi</a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('producers.update', $producer->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name" class="form-label">Name</label>
                        <input id="name" type="text" class="form-control" name="name" value="{{$producer->name}}">
                    </div>

                    <div class="form-group">
                        <label for="link" class="form-label">Link</label>
                        <input id="link" type="text" class="form-control" name="link" value="{{$producer->link}}">
                    </div>


                    <div class="form-group mt-4">
                        <label for="image" class="form-label">Image</label>
                        <br>
                        <img src="{{asset($producer->src)}}" alt="" width="180">
                        <input id="image" type="file" class="form-control mt-3" name="image">
                    </div>

                    <div class="form-group mt-3">
                       <button class="btn btn-primary">Salveaza</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection
