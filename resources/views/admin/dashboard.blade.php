@extends('layouts.backend')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('admin.sidebar')
        </div>

        <div class="col-md-9">
            <div class="panel"></div>

            <h3>Recently Registered</h3>
            <div class="panel panel-default">
                <div class="panel-body">
                    Last 5-10 people registered
                </div>
            </div>

            <h3>Subscriptions</h3>
            <div class="panel panel-default">
                <div class="panel-body">
                    Last 5-10 subscribers
                </div>
            </div>

            <h3>Stats</h3>
            <div class="panel panel-default">
                <div class="panel-body">

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
