@extends('layouts.master')


@section('content')

    <div class="main-container mt-5">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Jobs</h4>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                            <a class="btn-sm btn-success mx-1" href="{{route('jobs.create')}}">Create</a>
                    </div>
                    <div class="col-md-6">
                        <form action="{{ route('jobs.index') }}" method="GET" class="mb-3">
                            <div class="input-group">
                                <input type="text" name="searchName" class="form-control" placeholder="Search by job name" value="{{request('searchName')}}">
                                <input type="text" name="searchCompanyName" class="form-control" placeholder="Search by company name" value="{{request('searchCompanyName')}}">


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
                    <tr >
                        <th scope="col">#</th>
                        <th scope="col" style="width: 150px">Name</th>
                        <th scope="col" style="width: 200px">Company name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Action</th>


                    </tr>
                    </thead>
                    <tbody>
                    @foreach($jobs as $job)
                        <tr>
                            <th scope="row">{{$job->id}}</th>
                            <td>{{$job->name}}</td>
                            <td>{{$job->client_name}}</td>
                            <td>{{$job->description}}</td>
                            <td>
                                <div class="d-flex">

                                        <a class="btn-sm btn-primary btn mx-2" href="{{route('jobs.edit', $job->id)}}">Edit</a>

                                        <form method="POST" action="{{route('jobs.destroy', $job->id)}}">
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
                <!-- Pagination links -->
                <div class="d-flex justify-content-center">
                    {{ $jobs->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
