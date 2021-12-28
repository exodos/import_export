@extends('layouts.master')

@section('title')
    Site Information
@endsection
@section('content')
    <div class="container-fluid">
        <div class="text-right">
            <a href="{{route('customers.index')}}" class="btn btn-outline-dark mb-1"><i
                    class="fas fa-caret-left fa-2x"></i></a>
        </div>
        <div class="card border-success mb-3">
            <div class="card-header bg-gradient-gray-dark font-weight-bold">Customer Details</div>
            <div class="card-body text-black-50">
                <table class="table table-bordered">
                    <thead>
                    <tr class="bg-gradient-primary">
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Email</th>
                        <th scope="col">Address</th>
                        <th scope="col">Account</th>
                        <th scope="col">Group</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Updated At</th>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">{{$customer ->id }}</th>
                            <td>{{ $customer->customer_name }}</td>
                            <td>{{ $customer->customer_tel }}</td>
                            <td>{{ $customer->customer_email }}</td>
                            <td>{{ $customer->customer_address }}</td>
                            <td>{{ $customer->customer_account }}</td>
                            <td>{{ $customer->customer_group }}</td>
                            <td>{{ $customer->created_at->format('Y-m-d')}}</td>
                            <td>{{ $customer->updated_at->format('Y-m-d')}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
