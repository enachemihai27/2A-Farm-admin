@extends('layouts.master')


@section('content')

    <div class="main-container mt-5">
        @include('layouts.messages')
        <div class="card mb-4">
            <div class="card-header">
                <div class="flex flex-row items-center">
                    <div class="col-md-6">
                        <h4 class="text-lg font-semibold">Adauga reprezentant</h4>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <a class="btn btn-success mx-1" href="{{route('persons.privateIndex')}}">Inapoi</a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('persons.store')}}" method="POST">
                    @csrf


                    <div class="form-group">
                        <label for="name" class="form-label">Nume</label>
                        <input id="name" type="text" class="form-control" name="name" value="{{old('name')}}">
                    </div>

                    <div class="form-group">
                        <label for="department" class="form-label">Departament</label>
                        <select id="department" type="text" class="form-control" name="department">
                            <option value=" ">Select</option>
                            @foreach($departments as $department)
                                <option value="{{$department->department}}">{{$department->label}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="text" class="form-control" name="email" value="{{old('email')}}">
                    </div>

                    <div class="form-group">
                        <label for="symbol" class="form-label">Judet</label>
                        <select id="symbol" type="text" class="form-control" name="symbol">
                            <option value=" ">Select</option>
                            @foreach($symbols as $symbol)
                                <option value="{{$symbol->symbol}}">{{$symbol->title}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="prefix" class="form-label">Prefix</label>
                        <input id="prefix" type="text" class="form-control" name="prefix" value="{{old('prefix')}}">
                    </div>

                    <div class="form-group">
                        <label for="phone" class="form-label">Telefon</label>
                        <input id="phone" type="text" class="form-control" name="phone" value="{{old('phone')}}">
                    </div>


                    <div class="form-group mt-3">
                       <button class="btn btn-primary">Salveaza</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection
