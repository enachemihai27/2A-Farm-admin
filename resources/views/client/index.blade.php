@extends('layouts.master')


@section('content')

    <div class="bg-white dark:bg-gray-800 shadow-md sm:rounded-lg">
        <div class="py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-lg text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Contact') }}
            </h2>
        </div>
    </div>

    <div class="main-container mt-5 sm:px-6 lg:px-8 sm:rounded-lg">
        <div class="card mb-4">
            <div class="card-body">
                <div class="form-group">
                    <label for="name" class="form-label">Name</label>
                    <input id="name" type="text" class="form-control" name="name" value="{{$client->name}}" readonly>
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="text" class="form-control" name="email" value="{{$client->email}}" readonly>
                </div>

                <div class="form-group">
                    <label for="primary_phone_number" class="form-label">Primary phone</label>
                    <input id="primary_phone_number" type="text" class="form-control" name="primary_phone_number"
                           value="{{$client->primary_phone_number}}" readonly>
                </div>

                <div class="form-group">
                    <label for="secondary_phone_number" class="form-label">Secondary phone</label>
                    <input id="secondary_phone_number" type="text" class="form-control" name="secondary_phone_number"
                           value="{{$client->secondary_phone_number}}" readonly>
                </div>

                <div class="form-group">
                    <label for="address" class="form-label">Address</label>
                    <input id="address" type="text" class="form-control" name="address" value="{{$client->address}}"
                           readonly>
                </div>

                <div class="form-group">
                    <label for="order_number" class="form-label">Order number</label>
                    <input id="order_number" type="text" class="form-control" name="order_number"
                           value="{{$client->order_number}}" readonly>
                </div>

                <div class="form-group">
                    <label for="cui" class="form-label">CUI</label>
                    <input id="cui" type="text" class="form-control" name="cui" value="{{$client->CUI}}" readonly>
                </div>

                <div class="form-group mt-3">
                    <iframe id="videoFrame" width="300" height="250"
                            src="{{$client->video_url}}">
                    </iframe>
                    <input id="video_url" type="text" class="form-control" name="video_url"
                           value="{{$client->video_url}}" readonly>
                </div>

                @auth
                    <div class="d-flex justify-content-end mt-4">
                        <a class="btn-sm btn-success" href="{{route('client.edit', $client->id)}}">Edit</a>
                    </div>
                @endauth
            </div>
        </div>
    </div>

@endsection
