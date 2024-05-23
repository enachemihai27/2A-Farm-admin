@extends('layouts.master')


@section('content')

    <div class="main-container mt-5">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Clients</h4>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                            <a class="btn-sm btn-success mx-1" href="{{route('clients.create')}}">Create</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered bordered-drk">
                    <thead style="background: #f2f2f2">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Primary phone</th>
                        <th scope="col">Secondary phone</th>
                        <th scope="col">Address</th>
                        <th scope="col">Order number</th>
                        <th scope="col">CUI</th>
                        <th scope="col">Departments emails</th>
                        <th scope="col">Video</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($clients as $client)
                        <tr>
                            <th scope="row">{{$client->id}}</th>

                            <td>{{$client->name}}</td>
                            <td>{{$client->email}}</td>
                            <td>{{$client->primary_phone_number}}</td>
                            <td>{{$client->secondary_phone_number}}</td>
                            <td>{{$client->address}}</td>
                            <td>{{$client->order_number}}</td>
                            <td>{{$client->CUI}}</td>
                            <td>{{$client->departments_emails}}</td>
                            <td>
                                <iframe width="180" height="180"
                                        src="{{$client->video_url}}">
                                </iframe>
                            </td>
                            <td>
                                <div class="d-flex">

                                        <a class="btn-sm btn-primary btn mx-2" href="{{route('clients.edit', $client->id)}}">Edit</a>

                                        <form method="POST" action="{{route('clients.destroy', $client->id)}}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn-sm btn-danger btn">Delete</button>
                                        </form>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>

@endsection
