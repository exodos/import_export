@extends('layouts.master')

@section('title')
    Site Information
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
        @elseif(session()->has('connection'))
            <div class="alert alert-danger">
                <span style="font-size: 2em; color: #ff0000">
                    <i class="fas fa-info-circle"></i></span>
                {{session()->get('connection')}}
            </div>
        @endif
        <div class="row">
            <div class="col-md-3 col-xl-5 mb-3">
                {{--                <div class="sidebar px-4 py-md-0">--}}
                <form action="{{route('customers.index')}}" class="input-group" method="get">
                    <input type="text" class="form-control" name="search"
                           placeholder="Search By Id, Name, Power Source Configuration Or Monitoring Status"
                           value="{{request()->query('search')}}">
                    <div class="input-group-addon">
                        {{--                            <span class="input-group-text"><i class="fas fa-search"></i></span>--}}
                        <button id="search" type="button" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
                {{--                </div>--}}
            </div>
            <div class="col">
                @can('site-create')
                    <div class="text-right">
                        <a href="{{route('customers.create')}}" class="btn btn-outline-dark mb-2"><i
                                class="fas fa-plus-square fa-2x"></i></a>
                    </div>
                @endcan
            </div>
        </div>
        <div class="card border-dark mb-3">
            <div class="card-header bg-gradient-gray-dark font-weight-bold">Customer Information</div>
            <div class="card-body text-black-50">
                @if($customers->isNotEmpty())
                    <table class="table table-responsive table-bordered border-primary">
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
                            @can('site-list')
                                <th scope="col">Detail</th>
                            @endcan
                            @can('site-edit')
                                <th scope="col">Update</th>
                            @endcan
                            @can('site-delete')
                                <th scope="col">Delete</th>
                            @endcan
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
                                <td>{{ $customer->group_id }}</td>
                                <td>{{ $customer->created_at->format('Y-m-d') }}</td>
                                <td>{{ $customer->updated_at->format('Y-m-d') }}</td>
                                <td>
                                    <a href="{{route('customers.show', $customer->id)}}"
                                       class="btn btn-sm">
{{--                                        <i class="bi bi-view-list">--}}
                                        <span style="font-size: 1.2em; color: Dodgerblue;">
                                           <i class="far fa-eye"></i>
                                        </span>
                                        </a>
                                </td>
                                @can('site-edit')
                                    <td><a href="{{route('customers.edit', $customer->id)}}"
                                           class="btn btn-sm">
                                            <span style="font-size: 1.2em; color: darkgreen;">
                                           <i class="fas fa-eye-dropper"></i>
                                        </span>
                                        </a></td>
                                @endcan
                                @can('site-delete')
                                    <td>
                                        <button class="btn btn-sm" onclick="handleDelete({{$customer->id}})">
                                            <span style="font-size: 1.5em; color: red;">
                                           <i class="fas fa-times"></i>
                                        </span>
                                        </button>
                                    </td>
                                @endcan
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
                            <h5 class="modal-title" id="deleteModalLabel">Delete Sites</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p class="text-center text-danger font-weight-bold">
                                Are You Sure You Want To Delete This Site ?
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
            form.action = '/sites/' + id
            // console.log('deleting', form);
            $('#deleteModal').modal('show')
        }

    </script>
@endsection
