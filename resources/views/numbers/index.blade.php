@extends('layouts.master')


@section('content')
    <div class="bg-white dark:bg-gray-800 shadow-md sm:rounded-lg">
        <div class="py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-lg text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Numerele companiei') }}
            </h2>
        </div>
    </div>

    <div class="main-container mt-5 sm:px-6 lg:px-8 sm:rounded-lg">
        @include('layouts.messages')
        <div class="card">
                <div class="row">
                    <div class="d-flex justify-content-end">
                        @if($numbers->count() < 4)
                            <a style="margin-right: 15px; margin-top: 15px" class="btn btn-success" href="{{route('numbers.create')}}">Adauga</a>
                        @endif
                    </div>
            </div>
            <div class="card-body">
                <table style="margin-top: 16px" class="table table-striped table-bordered bordered-drk">
                    <thead style="background: #f2f2f2">
                    <tr>
                        <th scope="col" style="width: 50px;">Id</th>
                        <th scope="col">Numar</th>
                        <th scope="col" style="width: 150px;">Actiune</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($numbers as $number)
                        <tr>
                            <th scope="row">{{$number->id}}</th>
                            <td>{{$number->number}}</td>
                            <td>
                                <div class="d-flex">
                                    @auth
                                        <a class="btn-sm btn-primary btn mx-2" href="{{route('numbers.edit', $number->id)}}">Editeaza</a>
                                    @endauth
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
