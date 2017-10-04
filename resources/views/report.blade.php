@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row text-center">

        @if (!empty($credit_url->charge_id))
        <a type="button" class="btn btn-default" href="{{ route('home') }}">
            Go Back
        </a>
        <button type="button"
                class="btn btn-primary"
                data-toggle="modal"
                data-target="#creditReportModal">
            @if ($credit_url->kba_result) View Credit Report @else Verify Identity @endif
        </button>

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

</div>
@endsection

@section('moreJS')
<div class="container text-center">

    @if (empty($credit_url->charge_id))
    <form action="{{ route('report') }}" method="POST">
    {{ csrf_field() }}
    <script
        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
        data-key="{{ $stripe_key }}"
        data-amount="100"
        data-label="Pay $1 to View Report"
        data-name="{{ config('app.name') }}"
        data-description="Credit Report"
        data-image="/i/sys-square.jpg"
        data-locale="auto"
        data-zip-code="true">
    </script>
    @endif

    <script>
        $('#creditReportModal').on('show.bs.modal', function () {
            document.getElementById('creditReportIframe').src = "{!! $credit_url->url !!}";
        });
    </script>
</div>
@endsection
