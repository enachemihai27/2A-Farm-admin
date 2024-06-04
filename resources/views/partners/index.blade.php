@extends('layouts.master')


@section('content')
    <div class="bg-white dark:bg-gray-800 shadow-md sm:rounded-lg">
        <div class="py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-lg text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Parteneri') }}
            </h2>
        </div>
    </div>

    <div class="main-container mt-5 sm:px-6 lg:px-8 sm:rounded-lg">
        @include('layouts.messages')
        <div class="card">
            <div class="card-header">
                <div class="flex flex-row items-center">
                    <div class="col-md-6">
                        <form action="{{ route('partners.privateIndex') }}" method="GET" class="mb-2 mt-2">
                            <div class="input-group flex flex-row justify-center items-center">
                                <input type="text" name="search" class="form-control mr-2" placeholder="Cauta dupa nume" value="{{request('search')}}">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div  class="col-md-6 d-flex justify-content-end">
                        @auth
                            <a class="btn btn-success mx-1" href="{{route('partners.create')}}">Create</a>
                        @endauth
                    </div>

                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered bordered-drk">
                    <thead style="background: #f2f2f2">
                    <tr>
                        <th scope="col" style="width: 50px">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col" style="width: 300px">Link</th>
                        <th scope="col" style="width: 300px">Image</th>
                        <th scope="col" style="width: 100px">Action</th>


                    </tr>
                    </thead>
                    <tbody>
                    @foreach($partners as $partner)
                        <tr>
                            <th scope="row">{{$partner->id}}</th>
                            <td>{{$partner->name}}</td>
                            <td><a target="_blank" href="{{$partner->link}}">{{$partner->link}}</a></td>
                            <td>
                                <img src="{{asset($partner->src)}}" alt="" width="180px">
                            </td>
                            <td>
                                <div class="d-flex">
                                    @auth
                                        <a class="btn-sm btn-primary btn mx-2" href="{{route('partners.edit', $partner->id)}}">Edit</a>

                                        <form method="POST" action="{{route('partners.destroy', $partner->id)}}">
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
                    {{$partners->links()}}
                </div>
            </div>
        </div>
    </div>

@endsection
