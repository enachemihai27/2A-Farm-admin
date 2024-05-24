@extends('layouts.master')


@section('content')

    <div class="main-container mt-5">
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
                        <th scope="col">#</th>
                        <th scope="col" style="width: 100px">icon</th>
                        <th scope="col" style="width: 150px">Company name</th>
                        <th scope="col">Number</th>
                        <th scope="col">Text</th>
                        <th scope="col">Action</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($numbers as $number)
                        <tr>
                            <th scope="row">{{$number->id}}</th>
                            <th style="background: gray;">
                                <img src="{{asset($number->icon)}}" alt="" width="80" height="80">
                            </th>
                            <td>{{$number->client->name}}</td>

                            <td>{{$number->number}}</td>
                            <td>{{$number->text}}</td>

                            <td>
                                <div class="d-flex">

                                        <a class="btn-sm btn-primary btn mx-2" href="{{route('numbers.edit', $number->id)}}">Edit</a>

                                        <form method="POST" action="{{route('numbers.destroy', $number->id)}}">
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
            </div>
        </div>
    </div>

@endsection
