@extends('layouts.master')


@section('content')

    <div class="main-container mt-5">
        @include('layouts.messages')
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Events</h4>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                            <a class="btn-sm btn-success mx-1" href="{{route('events.create')}}">Create</a>
                    </div>
                    <div class="col-md-6">
                        <form action="{{ route('events.index') }}" method="GET" class="mb-3">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Search by event title" value="{{request('search')}}">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered bordered-drk">
                    <thead style="background: #f2f2f2">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Company name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Picture</th>
                        <th scope="col">Action</th>


                    </tr>
                    </thead>
                    <tbody>
                    @foreach($events as $event)
                        <tr>
                            <th scope="row">{{$event->id}}</th>
                            <td>{{$event->title}}</td>
                            <td>{{$event->client->name}}</td>
                            <td>{{$event->description}}</td>
                            <td>
                                <img src="{{asset($event->picture)}}" alt="" width="80" height="80">
                            </td>
                            <td>
                                <div class="d-flex">

                                        <a class="btn-sm btn-primary btn mx-2" href="{{route('events.edit', $event->id)}}">Edit</a>

                                        <form method="POST" action="{{route('events.destroy', $event->id)}}">
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
                <div class="d-flex justify-content-center">
                    {{$events->links()}}
                </div>
            </div>
        </div>
    </div>

@endsection
