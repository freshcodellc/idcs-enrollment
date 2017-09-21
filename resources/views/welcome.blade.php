@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="col-md-6 col-md-offset-4">
                <a class="btn btn-primary" href="{{ route('register') }}">
                    GET STARTED
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
