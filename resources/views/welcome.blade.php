@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="col-md-6 col-md-offset-4">
                @if (empty(Auth::user()->id))
                <a class="btn btn-primary" href="{{ route('register') }}">
                    GET STARTED
                </a>
                @else
                <a class="btn btn-primary" href="{{ route('home') }}">
                    Go to My Account
                </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
