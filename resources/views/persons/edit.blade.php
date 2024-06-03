@extends('layouts.master')


@section('content')

    <div class="main-container mt-5">
        @include('layouts.messages')
        <div class="card mb-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Edit person</h4>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <a class="btn-sm btn-success mx-1" href="{{route('persons.privateIndex')}}">Back</a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('persons.update', $person->id)}}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name" class="form-label">Name</label>
                        <input id="name" type="text" class="form-control" name="name" value="{{$person->name}}">
                    </div>

                    <div class="form-group">
                        <label for="department" class="form-label">Department</label>
                        <select id="department" type="text" class="form-control" name="department">
                            <option value=" ">Select</option>
                            @foreach($departments as $department)
                                <option
                                    {{$department->department == $person->department ? 'selected' : ''}}  value="{{$department->department}}">{{$department->label}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="text" class="form-control" name="email" value="{{$person->email}}">
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="text" class="form-control" name="email" value="{{$person->email}}">
                    </div>

                    <div class="form-group">
                        <label for="symbol" class="form-label">Judet</label>
                        <select id="symbol" type="text" class="form-control" name="symbol">
                            <option value=" ">Select</option>
                            @foreach($judete as $judet)
                                <option
                                    {{$judet->symbol == $person->symbol ? 'selected' : ''}}  value="{{$judet->symbol}}">{{$judet->title}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="prefix" class="form-label">Prefix</label>
                        <input id="prefix" type="text" class="form-control" name="prefix" value="{{$person->prefix}}">
                    </div>

                    <div class="form-group">
                        <label for="phone" class="form-label">Phone</label>
                        <input id="phone" type="text" class="form-control" name="phone" value="{{$person->phone}}">
                    </div>


                    <div class="form-group mt-3">
                        <button class="btn btn-primary">Submit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection
