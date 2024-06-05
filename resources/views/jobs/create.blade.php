@extends('layouts.master')


@section('content')

    <div class="main-container mt-5">
        @include('layouts.messages')
        <div class="card mb-4">
            <div class="card-header">
                <div class="flex flex-row items-center">
                    <div class="col-md-6">
                        <h4 class="text-lg font-semibold">Adauga job</h4>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <a class="btn btn-success mx-1" href="{{route('jobs.privateIndex')}}">Inapoi</a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('jobs.store')}}" method="POST">
                    @csrf


                    <div class="form-group">
                        <label for="name" class="form-label">Nume</label>
                        <input id="name" type="text" class="form-control" name="name" value="{{old('name')}}">
                    </div>

                    <div class="form-group">
                        <label for="description" class="form-label">Descriere</label>
                        <textarea id="description" rows="10" type="text" class="form-control" name="description">{{old('description')}}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1">Activ</option>
                            <option value="0">Inactiv</option>
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
