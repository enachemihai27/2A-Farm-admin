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
                        <h4>Edit number</h4>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <a class="btn-sm btn-success mx-1" href="{{route('numbers.index')}}">Back</a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('numbers.update', $number->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <img src="{{asset($number->icon)}}" alt="" width="80" height="80">
                        <label for="icon" class="form-label">Icon</label>
                        <input id="icon" type="file" class="form-control" name="icon">
                    </div>

                    <div class="form-group">
                        <label for="company" class="form-label">Company</label>
                        <select id="company" type="text" class="form-control" name="company_id" >
                            <option value=" ">Select</option>
                            @foreach($companies as $company)
                                <option {{$company->id == $number->client_id ? 'selected' : ''}} value="{{$company->id}}">{{$company->name}}</option>

                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="number" class="form-label">Name</label>
                        <input id="number" type="text" class="form-control" name="number" value="{{$number->number}}">
                    </div>

                    <div class="form-group">
                        <label for="text" class="form-label">Email</label>
                        <input id="text" type="text" class="form-control" name="text" value="{{$number->text}}">
                    </div>



                    <div class="form-group mt-3">
                       <button class="btn btn-primary">Submit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection