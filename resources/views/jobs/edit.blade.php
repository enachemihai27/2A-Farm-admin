@extends('layouts.master')


@section('content')

    <div class="main-container mt-5">
        @include('layouts.messages')
        <div class="card mb-4">
            <div class="card-header">
                <div class="flex flex-row items-center">
                    <div class="col-md-6">
                        <h4 class="text-lg font-semibold">Editeaza job</h4>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <a class="btn btn-success mx-1" href="{{route('jobs.privateIndex')}}">Inapoi</a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('jobs.update', $job->id)}}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name" class="form-label">Nume</label>
                        <input id="name" type="text" class="form-control" name="name" value="{{$job->name}}">
                    </div>

                    <div class="form-group">
                        <label for="description" class="form-label mt-2">Descriere</label>
                        <textarea rows="10" id="description" type="text" class="form-control" name="description">{{$job->description}}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option {{$job->status == 1 ? 'selected' : ''}} value="1">Activ</option>
                            <option {{$job->status == 0 ? 'selected' : ''}} value="0">Inactiv</option>
                        </select>
                    </div>

                    <div class="form-group mt-3">
                       <button class="btn btn-primary">Salveaza</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection
