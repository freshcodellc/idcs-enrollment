@extends('layouts.n_app')

@section('content')
<!-- Signup -->
    <section class="g-bg-secondary">
      <div class="container g-pb-20">
        <div class="row justify-content-between">
            <div class="col-md-6 col-lg-7 flex-md-unordered g-mt-100 betaller">
                <ul class="thesteps">
                    <li class="">Step 1: Account</li>
                    <li @if ($credit_url->charge_id) @else class="todo-step"@endif>Step 2: Billing</li>
                    <li class="todo-step">Step 3: Verify &amp; View Report</li>
                </ul>              
                <div class="u-shadow-v21 g-bg-white rounded g-pa-50">            
                  <header class="text-center mb-4">
                    <h2 class="h2 g-font-weight-600">Account Status</h2>
                  </header>   
                               
                @if ($credit_url->url)
                <table class="table table-striped table-hover g-my-70">
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
                @endif

                @if ($credit_url->url && empty($credit_url->charge_id))
                <form class="text-center" action="{{ route('charge_payment') }}" method="POST">
                    {{ csrf_field() }}
                    <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                            data-key="{{ $stripe_key }}"
                            data-amount="100"
                            data-label="Pay $1 to View Report"
                            data-name="{{ config('app.name') }}"
                            data-description="Credit Report"
                            data-image="{{ secure_asset('i/sys-square.jpg') }}"
                            data-locale="auto"
                            data-zip-code="true">
                    </script>
                </form>

                <div class="lawyerstuff g-my-30">
                    <p>After the 7 day trial period, you will be billed $29.99 for each month of your membership. You may cancel your membership at any time by contacting our support team at 888-876-6610, however you will be billed for the full amount due for that month’s membership, and will not be eligible for a pro-rated refund.</p>
                </div>
                @endif

                @if ($credit_url->url && $credit_url->charge_id > 0 && $stripe_customer->subscription_id)

                    @if (empty($credit_url->cancelled_at))                   
                    <button type="button"
                            class="btn btn-primary btn-lg centerbtn"
                            data-toggle="modal"
                            data-target="#creditReportModal">
                        @if (!$credit_url->kba_result)
                        Verify Identity
                        @else
                        View Credit Report
                        @endif
                    </button>
                    @endif


{{-- Don't show ability to cancel to the user - Uncomment to allow them to cancel their own subscription --}}
{{--                     @if (empty($stripe_customer->cancelled_at))
                    <form method="POST" action="{{ route('cancel') }}" style="display: inline;">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-link centerbtn g-mt-50" style="color: #8B0000">
                            Cancel Subscription
                        </button>
                    </form>
                    @endif    --}}                 
                @endif 
                </div>
            </div>
            @include('sidebar')
        </div>

        @if ($credit_url->url)
        <!-- Modal -->
        <div class="modal fade" id="creditReportModal" tabindex="-1" role="dialog" aria-labelledby="creditReportModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              <div class="modal-body">
                <div class="themodalcon">
                    <iframe id="creditReportIframe" src="" class="creditReportIframe" name="info" seamless=""></iframe>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endif
      </div>
    </section>
    <!-- End Signup -->
@endsection

@section('viewJquery')
    @parent

    $('#creditReportModal').on('show.bs.modal', function () {
        document.getElementById('creditReportIframe').src = "{!! $credit_url->url !!}";
    });

    $('#creditReportModal').on('hidden.bs.modal', function () {
        location.reload();
    });
               $(document).ready(function() {
                $('#creditReportIframe').contents().find('body').css('overflow', 'auto');
            });
@endsection
