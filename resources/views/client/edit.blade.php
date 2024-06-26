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
                <div class="flex flex-row items-center">
                    <div class="col-md-6">
                        <h4 class="text-lg font-semibold">Editeaza contact</h4>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <a class="btn btn-success mx-1" href="{{route('client.privateIndex')}}">Inapoi</a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('client.update', $client->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name" class="form-label">Nume</label>
                        <input id="name" type="text" class="form-control" name="name" value="{{$client->name}}">
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="text" class="form-control" name="email" value="{{$client->email}}">
                    </div>

                    <div class="form-group">
                        <label for="primary_phone_number" class="form-label">Telefon principal</label>
                        <input id="primary_phone_number" type="text" class="form-control" name="primary_phone_number" value="{{$client->primary_phone_number}}">
                    </div>

                    <div class="form-group">
                        <label for="secondary_phone_number" class="form-label">Telefon secundar</label>
                        <input id="secondary_phone_number" type="text" class="form-control" name="secondary_phone_number" value="{{$client->secondary_phone_number}}">
                    </div>

                    <div class="form-group">
                        <label for="address" class="form-label">Adresa</label>
                        <input id="address" type="text" class="form-control" name="address" value="{{$client->address}}">
                    </div>

                    <div class="form-group">
                        <label for="order_number" class="form-label">Nr.Ord.Reg.Com.</label>
                        <input id="order_number" type="text" class="form-control" name="order_number" value="{{$client->order_number}}">
                    </div>

                    <div class="form-group">
                        <label for="cui" class="form-label">CUI</label>
                        <input id="cui" type="text" class="form-control" name="cui" value="{{$client->CUI}}">
                    </div>

                    <div class="form-group">
                        <label for="video_url" class="form-label">Video url</label>
                        <input id="video_url" type="text" class="form-control" name="video_url" value="{{$client->video_url}}">
                    </div>
                    @auth
                        <div class="form-group mt-3">
                           <button class="btn btn-primary">Salveaza</button>
                        </div>
                    @endauth
                </form>
            </div>
        </div>
    </div>

@endsection
