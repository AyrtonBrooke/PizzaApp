@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Customers</li>
                    </ol>
                </nav>

                <div class="card">
                    <div class="card-header">Customers
                        <a style="float:right;" href="{{route('pizza.index')}}"><button class="btn btn-success btn-sm" style="margin-left: 5px">View Pizza</button></a>
                        <a style="float:right;" href="{{route('pizza.create')}}"><button class="btn btn-success btn-sm">Create Pizza</button></a>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Member since</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($customers as $customer)
                                <tr>
                                    <td>{{$customer->name}}</td>
                                    <td>{{$customer->email}}</td>
                                    <td>{{ \Carbon\Carbon::parse($customer->created_at)->format('M d Y')}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
