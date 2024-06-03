@extends('layouts.master')


@section('content')

    <div class="main-container mt-5">
        @include('layouts.messages')
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Persons</h4>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        @auth
                            <a class="btn-sm btn-success mx-1" href="{{route('persons.create')}}">Create</a>
                        @endauth
                    </div>
                    <div class="col-md-6">
                        <form action="{{ route('persons.privateIndex') }}" method="GET" class="mb-3">
                            <div class="input-group">
                                <input type="text" name="searchName" class="form-control"
                                       placeholder="Search by name" value="{{request('searchName')}}">

                                <input type="text" name="searchJudet" class="form-control"
                                       placeholder="Search by judet" value="{{request('searchJudet')}}">

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
                        <th scope="col" style="width: 50px">Id</th>
                        <th scope="col" style="width: 150px">Name</th>
                        <th scope="col">Department</th>
                        <th scope="col">Email</th>
                        <th scope="col">Judet</th>
                        <th scope="col">Prefix</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Action</th>


                    </tr>
                    </thead>
                    <tbody>
                    @if($persons != null)
                        @foreach($persons as $person)
                            <tr>
                                <th scope="row">{{$person->id}}</th>
                                <td>{{$person->name}}</td>
                                <td>{{$person->representativesDepartments->label}} </td>
                                <td>{{$person->email}}</td>
                                <td>{{$person->map_data->title}}</td>
                                <td>{{$person->prefix}}</td>
                                <td>{{$person->phone}}</td>
                                <td>
                                    <div class="d-flex">
                                        @auth
                                            <a class="btn-sm btn-primary btn mx-2"
                                               href="{{route('persons.edit', $person->id)}}">Edit</a>

                                            <form method="POST" action="{{route('persons.destroy', $person->id)}}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn-sm btn-danger btn">Delete</button>
                                            </form>
                                        @endauth
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>

                </table>
                <!-- Pagination links -->
                @if($persons != null)
                    <div class="d-flex justify-content-center">
                        {{ $persons->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
