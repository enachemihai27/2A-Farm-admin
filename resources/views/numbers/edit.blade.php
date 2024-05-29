@extends('layouts.master')


@section('content')

    <div class="main-container mt-5">
        @include('layouts.messages')
        <div class="card mb-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Edit number</h4>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <a class="btn-sm btn-success mx-1" href="{{route('numbers.privateIndex')}}">Back</a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('numbers.update', $number->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="number" class="form-label">Number</label>
                        <input id="number" type="number" class="form-control" name="number" value="{{$number->number}}">
                    </div>

                    <div class="form-group mt-3">
                       <button class="btn btn-primary">Submit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection
