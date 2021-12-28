@extends('layouts.master')

@section('title')
    Customer Information
@endsection

@section('sitemap')
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item active"><a href="{{route('customers.index')}}">Index</a></li>
    <li class="breadcrumb-item active"><a href="#">Create</a></li>
@endsection

@section('content')

    <div class="container">
        <div class="card border-success">
            <div class="card-header font-weight-bold bg-gradient-primary bg-success"><h3 class="mb-0">Create Customers</h3></div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="list-group">
                            @foreach($errors->all() as $error)
                                <li class="list-group-item text-danger">
                                    {{$error}}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{route('customers.store')}}" method="post">
                    @csrf
{{--                    <div class="form-group">--}}
{{--                        <label for="id">Customer Id</label>--}}
{{--                        <input type="number" class="form-control" id="id" name="id" value="{{request()->old('id')}}">--}}
{{--                    </div>--}}
                    <div class="form-group">
                        <label for="customer_name">Customer Name</label>
                        <input type="text" class="form-control" id="customer_name" name="customer_name" value="{{request()->old('customer_name')}}">
                    </div>
                    <div class="form-group">
                        <label for="customer_tel">Customer Phone Number</label>
                        <input type="text" class="form-control" id="customer_tel" name="customer_tel" value="{{request()->old('customer_tel')}}">
                    </div>
                    <div class="form-group">
                        <label for="customer_email">Customer Email</label>
                        <input type="email" class="form-control" id="customer_email" name="customer_email" value="{{request()->old('customer_email')}}">
                    </div>
                    <div class="form-group">
                        <label for="customer_address">Customer Address</label>
                        <input type="text" class="form-control" id="customer_address" name="customer_address" value="{{request()->old('customer_address')}}">
                    </div>
                    <div class="form-group">
                        <label for="customer_account">Customer Account</label>
                        <input type="text" class="form-control" id="customer_account" name="customer_account" value="{{request()->old('customer_account')}}">
                    </div>
                    <div class="form-group">
                        <label for="customer_group">Customer Group</label>
                        <select class="form-control form-control-lg mb-3" name="customer_group"
                                id="customer_group">
                            <option value="none" selected disabled hidden>Please Select</option>
                            @foreach(\App\Models\Group::all() as $group)
                                <option value="{{$group->group_name}}">{{$group->group_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-primary btn-lg">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
