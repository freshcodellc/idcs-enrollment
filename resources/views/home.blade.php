@extends('layouts.app')

@section('content')
<div class="container">

    @if (isset($success))
    <div class="alert alert-success" role="alert">
        {{ $success }}
    </div>
    @endif

    @if (isset($error))
    <div class="alert alert-danger" role="alert">
        {{ $error }}
    </div>
    @endif

    @if ($credit_url)
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3>Credit URL</h3>

            <div class="panel panel-default">
                <div class="panel-body">
                    {{ $credit_url }}
                </div>
            </div>
        </div>
    </div>
    @endif

    @if (isset($credit_url))
    <div class="row text-center">
        @if (!$credit_url)
        <a type="button" class="btn btn-primary" href="{{ route('enroll') }}">
            Enroll
        </a>
        @endif

        @if ($credit_url)
        <button type="button"
                class="btn btn-primary"
                data-toggle="modal"
                data-target="#creditReportModal">
            View Credit Report
        </button>
        @endif
    </div>
    @endif

    @if (isset($credit_url) && $credit_url)
    <!-- Modal -->
    <div class="modal fade" id="creditReportModal" tabindex="-1" role="dialog" aria-labelledby="creditReportModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <!--<h5 class="modal-title" id="enrollModalLabel">Modal title</h5>-->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body iframe">

                        <iframe src="{{ $credit_url }}" id="info" class="iframe" name="info" seamless="" height="100%" width="100%"></iframe>

                </div>
            </div>
        </div>
    </div>
    @endif

</div>
@endsection
