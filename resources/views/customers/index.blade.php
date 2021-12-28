@extends('layouts.master')

@section('title')
    Customers Information
@endsection

@section('content')
    <div class="container-fluid">
        @if(session()->has('success'))
            <div class="alert alert-success">
                <span style="font-size: 2em; color: #00a87d">
                    <i class="fas fa-info-circle"></i></span>
                {{session()->get('success')}}
            </div>
        @elseif(session()->has('updated'))
            <div class="alert alert-success">
                <span style="font-size: 2em; color: #00a87d">
                    <i class="fas fa-info-circle"></i></span>
                {{session()->get('updated')}}
            </div>
        @elseif(session()->has('deleted'))
            <div class="alert alert-danger">
                <span style="font-size: 2em; color: #ff0000">
                    <i class="fas fa-info-circle"></i></span>
                {{session()->get('deleted')}}
            </div>
        @elseif(session()->has('unable'))
            <div class="alert alert-danger">
                <span style="font-size: 2em; color: #ff0000">
                    <i class="fas fa-info-circle"></i></span>
                {{session()->get('unable')}}
            </div>
        @endif
        <div class="row mt-1">
            <div class="col">
                @can('site-create')
                    <div class="text-right">
                        <a href="{{route('customers.create')}}" class="btn btn-outline-dark mb-2"><i
                                class="bi bi-plus-circle-fill text-success" style="font-size: 1.25em;"></i></a>
                    </div>
                @endcan
            </div>
        </div>
        <div class="card border-dark mb-3">
            <div class="card-header bg-gradient-gray-dark font-weight-bold">Customer Information</div>
            <div class="card-body text-black-50">
                <form action="{{route('customers.index')}}" method="get">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-2 mx-auto">
                            <div class="form-group">
                                <input type="text" class="form-control" id="customer_name"
                                       name="customer_name"
                                       value="{{request()->query('customer_name')}}" placeholder="Name">
                            </div>
                        </div>
                        <div class="col-2 mx-auto">
                            <div class="form-group">
                                <input type="text" class="form-control" id="customer_tel"
                                       name="customer_tel"
                                       value="{{request()->query('customer_tel')}}" placeholder="Tel">
                            </div>
                        </div>
                        <div class="col-2 mx-auto">
                            <div class="form-group">
                                <input type="email" class="form-control" id="customer_email"
                                       name="customer_email"
                                       value="{{request()->query('customer_email')}}" placeholder="Email">
                            </div>
                        </div>
                        <div class="col-2 mx-auto">
                            <div class="form-group">
                                <input type="email" class="form-control" id="customer_address"
                                       name="customer_address"
                                       value="{{request()->query('customer_address')}}" placeholder="Address">
                            </div>
                        </div>
                        <div class="col-2 mx-auto">
                            <div class="form-group">
                                <select class="form-control form-control-lg mb-3" name="customer_group"
                                        id="customer_group">
                                    <option value="none" selected disabled hidden>Group</option>
                                    @foreach(\Illuminate\Support\Facades\DB::table('customers')->distinct()->orderBy('customer_group', 'ASC')->get(['customer_group']) as $group)
                                        <option
                                            value="{{$group->customer_group}}">{{$group->customer_group}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                        {{--                        <div class="container text-center">--}}
                        {{--                            <button class="btn btn-primary btn-lg" type="submit" id="search" name="search">Search--}}
                        {{--                            </button>--}}
                        {{--                        </div>--}}
                    </div>
                </form>


                @if($customers->isNotEmpty())
                    <table class="table table-bordered table-responsive border-primary">
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
                            @canany(['site-list','site-edit','site-delete'])
                                <th width="150px">Action</th>
{{--                                <th width="280px">Action</th>--}}
                            @endcanany
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($customers as $customer)
                            <tr>
                                <th scope="row">{{$customer ->id }}</th>
                                <td>{{ $customer->customer_name }}</td>
                                <td>{{ $customer->customer_tel }}</td>
                                <td>{{ $customer->customer_email }}</td>
                                <td>{{ $customer->customer_address }}</td>
                                <td>{{ $customer->customer_account }}</td>
                                <td>{{ $customer->customer_group }}</td>
                                <td>{{ $customer->created_at}}</td>
                                <td>{{ $customer->updated_at}}</td>

                                <td>
                                    <a href="{{route('customers.show', $customer->id)}}"
                                       class="btn btn-sm">
                                        {{--                                        <i class="bi bi-view-list">--}}
                                        <span style="font-size: 1.2em; color: Dodgerblue;">
                                           <i class="far fa-eye"></i>
                                        </span>
                                        @can('site-edit')
                                            <a href="{{route('customers.edit', $customer->id)}}"
                                               class="btn btn-sm">
                                            <span style="font-size: 1.2em; color: darkgreen;">
                                           <i class="fas fa-eye-dropper"></i>
                                        </span>
                                            </a>
                                        @endcan
                                        @can('site-delete')
                                            <button class="btn btn-sm" onclick="handleDelete({{$customer->id}})">
                                            <span style="font-size: 1.5em; color: red;">
                                           <i class="fas fa-times"></i>
                                        </span>
                                            </button>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-danger px-4" role="alert">
                        No results found for query {{ request()->query('search') }}
                    </div>
                @endif
            </div>
            <div class="d-flex justify-content-center">
                {!! $customers->appends(['search' => request()->query('search')])->links() !!}
            </div>
        </div>
        <form action="" method="post" id="deleteForm">
        @csrf
        @method('DELETE')

        <!-- Modal -->
            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-gradient-danger">
                            <h5 class="modal-title" id="deleteModalLabel">Delete Customer</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p class="text-center text-danger font-weight-bold">
                                Are You Sure You Want To Delete This Customer ?
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, Go Back</button>
                            <button type="submit" class="btn btn-danger">Yes, Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        function handleDelete(id) {
            var form = document.getElementById('deleteForm')
            form.action = '/customers/' + id
            // console.log('deleting', form);
            $('#deleteModal').modal('show')
        }

    </script>
@endsection
