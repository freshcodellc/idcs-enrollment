@extends('layouts.app')

@section('content')
<div class="container">

    @if ($credit_url->url)
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3>Account</h3>

            <div class="panel panel-default">
                <div class="panel-body" style="padding: 25px;">

                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">

                            <table class="table table-striped table-hover">
                                <tr>
                                    <td class="text-right">Name</td>
                                    <td>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</td>
                                </tr>
                                <tr>
                                    <td class="text-right">Enrolled</td>
                                    <td>@if ($credit_url->url) <span class="text-success">Yes</span> @else <span class="text-danger">No</span> @endif</td>
                                </tr>
                                <tr>
                                    <td class="text-right">Payment Status</td>
                                    <td>@if ($credit_url->charge_id) <span class="text-success">Paid</span> @else <span class="text-danger">Outstanding</span> @endif</td>
                                </tr>
                                <tr>
                                    <td class="text-right">ID Verified</td>
                                    <td>@if ($credit_url->kba_result) <span class="text-success">Yes</span> @else <span class="text-danger">No</span> @endif</td>
                                </tr>
                            </table>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="row text-center">
        @if ($credit_url->url && empty($credit_url->charge_id))
        <a type="button" class="btn btn-primary" href="{{ route('report') }}">
            Pay $1 to View Report
        </a>
        @endif

        @if ($credit_url->url && $credit_url->charge_id > 0)
        <button type="button"
                class="btn btn-primary"
                data-toggle="modal"
                data-target="#creditReportModal">
            @if (!$credit_url->kba_result)
            Verify Identity
            @else
            View Credit Report
            @endif
        </button>
        @endif

        @if ($credit_url->kba_result)
        <a type="button" class="btn btn-primary" href="{{ route('report') }}">
            View Credit Report
        </a>
        @endif

    </div>

    @if ($credit_url->url)
    <!-- Modal -->
    <div class="modal fade" id="creditReportModal" tabindex="-1" role="dialog" aria-labelledby="creditReportModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body iframe">

                    <iframe id="creditReportIframe" src="" frameborder="0" class="creditReportIframe" name="info" seamless="" height="100%" width="100%"></iframe>

                </div>
            </div>
        </div>
    </div>
    @endif

</div>
@endsection

@section('viewJquery')
    @parent

    $('#creditReportModal').on('show.bs.modal', function () {
        document.getElementById('creditReportIframe').src = "{!! $credit_url->url !!}";
    });

    $('#creditReportModal').on('hidden.bs.modal', function () {
        location.reload();
    });
@endsection
