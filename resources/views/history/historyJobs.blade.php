@extends('layouts.master')


@section('content')
    <div class="bg-white dark:bg-gray-800 shadow-md sm:rounded-lg">
        <div class="py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-lg text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Istoricul joburilor') }}
            </h2>
        </div>
    </div>

    <div class="main-container mt-5 sm:px-6 lg:px-8 sm:rounded-lg">
        @include('layouts.messages')
        <div class="card">
            <div class="card-header">
                <div class="flex flex-row justify-between items-center">
                    <div></div>
                    <div class="col-md-7">
                        <form action="{{ route('jobs.history') }}" method="GET" class="mb-2 mt-2">
                            <div class="input-group flex flex-row justify-center items-center">
                                <input type="text" name="searchOldData" class="form-control mr-2"
                                       placeholder="Cauta dupa date vechi" value="{{request('searchOldData')}}">
                                <input type="text" name="searchNewData" class="form-control mr-2"
                                       placeholder="Cauta dupa date noi" value="{{request('searchNewData')}}">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">Cauta</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="">
                            <a class="btn btn-primary" href="{{route('jobs.privateIndex')}}">Inapoi</a>
                    </div>


                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered bordered-drk">
                    <thead style="background: #f2f2f2">
                    <tr>
                        <th scope="col" style="width:20px">#</th>
                        <th scope="col" style="width: 100px">Actiune</th>
                        <th scope="col" style="width: 35%">Date vechi</th>
                        <th scope="col" style="width: 35%;">Date noi</th>
                        <th scope="col" style="width: 100px">Creat la</th>


                    </tr>
                    </thead>
                    <tbody>
                    @if($rows != null)
                        @foreach($rows as $index => $row)
                            <tr>
                                <th scope="row">{{$rows->firstItem() + $index}}</th>
                                <td>{{$row->action}}</td>
                                <td>{!! nl2br(e($row->old_data)) !!}</td>
                                <td>{!! nl2br(e($row->new_data)) !!}</td>
                                <td>{{$row->created_at}}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>

                </table>
                <!-- Pagination links -->
                @if($rows != null)
                    <div class="d-flex justify-content-center">
                        {{ $rows->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
