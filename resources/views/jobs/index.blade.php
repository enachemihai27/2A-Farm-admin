@extends('layouts.master')


@section('content')

    <div class="main-container mt-5">
        @include('layouts.messages')
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Jobs</h4>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        @auth
                            <a class="btn-sm btn-success mx-1" href="{{route('jobs.create')}}">Create</a>
                        @endauth
                    </div>
                    <div class="col-md-3">
                        <form action="{{ route('jobs.index') }}" method="GET" class="mb-3">
                            <div class="input-group">
                                <input type="text" name="searchName" class="form-control"
                                       placeholder="Search by job name" value="{{request('searchName')}}">
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
                        <th scope="col">Description</th>
                        <th scope="col">Action</th>


                    </tr>
                    </thead>
                    <tbody>
                    @if($jobs != null)
                        @foreach($jobs as $job)
                            <tr>
                                <th scope="row">{{$job->id}}</th>
                                <td>{{$job->name}}</td>
                                <td>{{$job->description}}</td>
                                <td>
                                    <div class="d-flex">
                                        @auth
                                            <a class="btn-sm btn-primary btn mx-2"
                                               href="{{route('jobs.edit', $job->id)}}">Edit</a>

                                            <form method="POST" action="{{route('jobs.destroy', $job->id)}}">
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
                @if($jobs != null)
                    <div class="d-flex justify-content-center">
                        {{ $jobs->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
