@extends('layouts.master')


@section('content')

    <div class="main-container mt-5">
        @include('layouts.messages')
        <div class="card mb-4">
            <div class="card-header">
                <div class="flex flex-row items-center">
                    <div class="col-md-6">
                        <h4 class="text-lg font-semibold">Editeaza eveniment</h4>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <a class="btn btn-success mx-1" href="{{route('events.privateIndex')}}">Inapoi</a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('events.update', $event->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="title" class="form-label">Titlu</label>
                        <input id="title" type="text" class="form-control" name="title" value="{{$event->title}}">
                    </div>

                    <div class="form-group mt-4">
                        <label for="description" class="form-label">Descriere</label>
                        <textarea id="description" type="text" rows="10" class="form-control" name="description">{{$event->description}}</textarea>
                    </div>


                    <div class="form-group mt-4">
                        <label for="picture" class="form-label">Imagine</label>
                        <br>
                        <img src="{{asset($event->picture)}}" alt="" width="180">
                        <input id="picture" type="file" class="form-control mt-3" name="picture">
                    </div>

                    <div class="form-group mt-3">
                       <button class="btn btn-primary">Salveaza</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection
