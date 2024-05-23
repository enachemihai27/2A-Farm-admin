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
                        <h4>Add client</h4>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <a class="btn-sm btn-success mx-1" href="{{route('clients.index')}}">Back</a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('clients.store')}}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="name" class="form-label">Name</label>
                        <input id="name" type="text" class="form-control" name="name" value="{{old('name')}}">
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="text" class="form-control" name="email" value="{{old('email')}}">
                    </div>

                    <div class="form-group">
                        <label for="primary_phone_number" class="form-label">Primary phone</label>
                        <input id="primary_phone_number" type="text" class="form-control" name="primary_phone_number" value="{{old('primary_phone_number')}}">
                    </div>

                    <div class="form-group">
                        <label for="secondary_phone_number" class="form-label">Secondary phone</label>
                        <input id="secondary_phone_number" type="text" class="form-control" name="secondary_phone_number" value="{{old('secondary_phone_number')}}">
                    </div>

                    <div class="form-group">
                        <label for="address" class="form-label">Address</label>
                        <input id="address" type="text" class="form-control" name="address" value="{{old('address')}}">
                    </div>

                    <div class="form-group">
                        <label for="order_number" class="form-label">Order number</label>
                        <input id="order_number" type="text" class="form-control" name="order_number" value="{{old('order_number')}}">
                    </div>

                    <div class="form-group">
                        <label for="cui" class="form-label">CUI</label>
                        <input id="cui" type="text" class="form-control" name="cui" value="{{old('cui')}}">
                    </div>

{{--                    <div class="form-group">
                        <label for="category" class="form-label">Category</label>
                        <select id="category" type="text" class="form-control" name="category_id">
                            <option value=" ">Select</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>--}}

                    <div class="form-group">
                        <label for="departments_emails" class="form-label">Departments Emails</label>
                        <textarea name="departments_emails" cols="30" rows="10" id="departments_emails" class="form-control" value="{{old('departments_emails')}}"></textarea>
                    </div>


                    <div class="form-group">
                        <label for="video_url" class="form-label">Video url</label>
                        <input id="video_url" type="text" class="form-control" name="video_url" value="{{old('video_url')}}">
                    </div>

                    <div class="form-group mt-3">
                       <button class="btn btn-primary">Submit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection
