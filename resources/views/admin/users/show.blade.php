@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('admin.sidebar')
            </div>

            <div class="col-md-9">
                <h3>{{$user->first_name}} {{$user->last_name}}</h3>

                <div class="panel panel-default">
                    <div class="panel-body">
                        <a href="{{ url('/admin/users') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/users/' . $user->id . '/edit') }}" title="Edit User"><button class="btn btn-info btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method' => 'DELETE',
                            'url' => ['/admin/users', $user->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete User',
                                    'disabled' => 'disabled',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}

                        <div class="row">
                            <table class="table table-striped" style="margin-top: 30px; margin-bottom: 30px;">
                                <tr>
                                    <td class="text-right">Name</td>
                                    <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                </tr>
                                <tr>
                                    <td class="text-right">Username</td>
                                    <td>{{ $user->username }}</td>
                                </tr>
                                <tr>
                                    <td class="text-right">Email</td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td class="text-right">Phone</td>
                                    <td>{{ $user->phone }}</td>
                                </tr>
                                <tr>
                                    <td class="text-right">Address</td>
                                    <td>{{ $user->address }}</td>
                                </tr>
                                <tr>
                                    <td class="text-right">City</td>
                                    <td>{{ $user->city }}</td>
                                </tr>
                                <tr>
                                    <td class="text-right">State</td>
                                    <td>{{ $user->state }}</td>
                                </tr>
                                <tr>
                                    <td class="text-right">Zip Code</td>
                                    <td>{{ $user->zip }}</td>
                                </tr>
                                <tr>
                                    <td class="text-right">Subscription Status</td>
                                    <td>
                                        @if (empty($user->credit_url->cancelled_at))
                                        <span class="text-success">Active</span>
                                        @else
                                        <span class="text-danger">Cancelled ({{$user->credit_url->cancelled_at}})</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="text-center">

                            @if (empty($user->credit_url->cancelled_at))
                            <form method="POST" action="{{ route('cancel_user') }}" style="display: inline;">
                                {{ csrf_field() }}
                                <input type="hidden" id="cancel_user_id" name="cancel_user_id" value="{{ $user->id }}" />
                                <button type="submit" class="btn btn-link centerbtn g-mt-50" style="color: #8B0000"
                                        onclick="return confirm('Are you sure you want to cancel this user\'s subscription?');">
                                    Cancel Subscription
                                </button>
                            </form>
                            @endif
                            <a class="btn btn-primary" href="{{ $user->credit_url->url }}" target="_blank">View Credit Report</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection