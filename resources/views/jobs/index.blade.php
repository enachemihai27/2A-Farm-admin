@extends('layouts.master')


@section('content')
    <div class="bg-white dark:bg-gray-800 shadow-md sm:rounded-lg">
        <div class="py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-lg text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Cariera') }}
            </h2>
        </div>
    </div>

    <div class="main-container mt-5 sm:px-6 lg:px-8 sm:rounded-lg">
        @include('layouts.messages')
        <div class="card">
            <div class="card-header">
                <div class="flex flex-row items-center">
                    <div class="col-md-6">
                        <form action="{{ route('jobs.privateIndex') }}" method="GET" class="mb-2 mt-2">
                            <div class="input-group flex flex-row justify-center items-center">
                                <input type="text" name="searchName" class="form-control mr-2"
                                       placeholder="Cauta dupa numele jobului" value="{{request('searchName')}}">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">Cauta</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-6 d-flex justify-content-end">
                        @auth
                            <a class="btn btn-success mx-1" href="{{route('jobs.create')}}">Adauga</a>
                        @endauth
                    </div>


                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered bordered-drk">
                    <thead style="background: #f2f2f2">
                    <tr>
                        <th scope="col" style="width: 50px">#</th>
                        <th scope="col" style="width: 150px">Nume</th>
                        <th scope="col">Descriere</th>
                        <th scope="col" style="width: 150px;">Actiune</th>


                    </tr>
                    </thead>
                    <tbody>
                    @if($jobs != null)
                        @foreach($jobs as $index => $job)
                            <tr>
                                <th scope="row">{{$jobs->firstItem() + $index}}</th>
                                <td>{{$job->name}}</td>
                                <td>{{$job->description}}</td>
                                <td>
                                    <div class="d-flex">
                                        @auth
                                            <a class="btn-sm btn-primary btn mx-2"
                                               href="{{route('jobs.edit', $job->id)}}">Editeaza</a>

                                            <form method="POST" action="{{route('jobs.destroy', $job->id)}}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn-sm btn-danger btn">Sterge</button>
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
