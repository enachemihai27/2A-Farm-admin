@extends('layouts.master')


@section('content')
    <div class="bg-white dark:bg-gray-800 shadow-md sm:rounded-lg">
        <div class="py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-lg text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Evenimente') }}
            </h2>
        </div>
    </div>

    <div class="main-container mt-5 sm:px-6 lg:px-8 sm:rounded-lg">
        @include('layouts.messages')
        <div class="card">
            <div class="card-header">
                <div class="flex flex-row items-center">
                    <div class="col-md-6">
                        <form action="{{ route('events.privateIndex') }}" method="GET" class="mb-2 mt-2">
                            <div class="input-group flex flex-row justify-center items-center">
                                <input type="text" name="search" class="form-control mr-2" placeholder="Cauta dupa titlul evenimentului" value="{{request('search')}}">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-6 d-flex justify-content-end">
                        @auth
                            <a class="btn btn-success mx-1" href="{{route('events.create')}}">Create</a>
                        @endauth
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered bordered-drk">
                    <thead style="background: #f2f2f2">
                    <tr>
                        <th scope="col" style="width: 50px">Id</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col" style="width: 200px">Picture</th>
                        <th scope="col" style="width: 100px">Action</th>


                    </tr>
                    </thead>
                    <tbody>
                    @foreach($events as $event)
                        <tr>
                            <th scope="row">{{$event->id}}</th>
                            <td>{{$event->title}}</td>
                            <td>{{$event->description}}</td>
                            <td>
                                <img src="{{asset($event->picture)}}" alt="" width="180px">
                            </td>
                            <td>
                                <div class="d-flex">
                                    @auth
                                        <a class="btn-sm btn-primary btn mx-2" href="{{route('events.edit', $event->id)}}">Edit</a>

                                        <form method="POST" action="{{route('events.destroy', $event->id)}}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn-sm btn-danger btn">Delete</button>
                                        </form>
                                    @endauth
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
