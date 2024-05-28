@extends('layouts.master')


@section('content')
    <div class="main-container mt-5">
        @include('layouts.messages')
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Company numbers</h4>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        @if($numbers->count() < 4)
                            <a class="btn-sm btn-success mx-1" href="{{route('numbers.create')}}">Create</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered bordered-drk">
                    <thead style="background: #f2f2f2">
                    <tr>
                        <th scope="col" style="width: 50px;">Id</th>
                        <th scope="col">Number</th>
                        <th scope="col" style="width: 150px;">Action</th>
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
                                        <a class="btn-sm btn-primary btn mx-2" href="{{route('numbers.edit', $number->id)}}">Edit</a>
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
