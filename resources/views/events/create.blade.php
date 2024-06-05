@extends('layouts.master')


@section('content')

    <div class="main-container mt-5">
        @include('layouts.messages')
        <div class="card mb-4">
            <div class="card-header">
                <div class="flex flex-row items-center">
                    <div class="col-md-6">
                        <h4 class="text-lg font-semibold">Adauga eveniment</h4>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <a class="btn btn-success mx-1" href="{{route('events.privateIndex')}}">Inapoi</a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('events.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title" class="form-label">Titlu</label>
                        <input id="title" type="text" class="form-control" name="title" value="{{old('title')}}">
                    </div>

                    <div class="form-group">
                        <label for="description" class="form-label">Descriere</label>
                        <textarea id="description" rows="10" type="text" class="form-control" name="description">{{old('description')}}</textarea>
                    </div>


                    <div class="form-group">
                        <label for="picture" class="form-label">Imagine</label>
                        <input id="picture" type="file" class="form-control" name="picture">
                    </div>

                    <div class="form-group mt-3">
                       <button class="btn btn-primary">Salveaza</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection
