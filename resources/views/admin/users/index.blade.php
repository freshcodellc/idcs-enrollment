@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('admin.sidebar')
            </div>

            <div class="col-md-9">
                <h3>Users</h3>

                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ url('/admin/users/create') }}" class="btn btn-success btn-sm" title="Add New User">
                                    <i class="fa fa-plus" aria-hidden="true"></i> Add User
                                </a>
                            </div>

                            <div class="col-md-6">
                                {!! Form::open(['method' => 'GET', 'url' => '/admin/users', 'class' => '', 'role' => 'search'])  !!}
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" placeholder="Search...">
                                    <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>

                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th><th>Name</th><th>Email</th><th class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td><a href="{{ url('/admin/users', $item->id) }}">{{ $item->first_name }} {{ $item->last_name }}</a></td>
                                    <td>{{ $item->email }}</td>
                                    <td class="text-right">
                                        <a href="{{ url('/admin/users/' . $item->id . '/edit') }}" title="Edit User"><button class="btn btn-default btn-info btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</button></a>
                                        {!! Form::open([
                                            'method' => 'DELETE',
                                            'url' => ['/admin/users', $item->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-xs',
                                                    'title' => 'Delete User',
                                                    'disabled' => 'disabled',
                                                    'onclick'=>'return confirm("Confirm removal of user? This will also cancel their enrollment and their payment subscription.")'
                                            )) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination" style="margin: 0;"> {!! $users->appends(['search' => Request::get('search')])->render() !!} </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
