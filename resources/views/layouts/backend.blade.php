<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>See Your Credit Score for All 3 Bureaus for Just $1</title>
    <link rel="icon" type="image/png" href="{{ asset('i/favicon.png') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link href="{{ asset('css/score.css') }}" rel="stylesheet">
    <script src="{{ asset('js/packs/solid.js') }}"></script>
    <script src="{{ asset('js/packs/regular.js') }}"></script>

    <link href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
<div id="app">
    @include('header')

    <div class="container">
        <div class="row">

            @if (isset($success) && !empty($success))
            <div class="col-md-8 col-md-offset-2 alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ $success }}
            </div>
            @endif

            @if (isset($errors) && !empty($errors))
            @foreach ($errors as $error)
            <div class="col-md-8 col-md-offset-2 alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ $error }}
            </div>
            @endforeach
            @endif

        </div>
    </div>

    @if (Session::has('flash_message'))
    <div class="container">
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ Session::get('flash_message') }}
        </div>
    </div>
    @endif
    @if (Session::has('error'))
    <div class="container">
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ Session::get('error') }}
        </div>
    </div>
    @endif

    @yield('content')
</div>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-push-1">
                <p><i class="fa fa-copyright"></i> SeeYourScore - All Rights Reserved</p>
                <p class="small">Important Information: The credit score you receive from us may not be the same scores used by lenders or other commercial users for credit decisions. There are various types of credit scores, and lenders may use a different type of credit score to make lending decisions that are different than the ones we offer.</p>

                <p class="small">Under federal law you have the right to receive a <em>credit report</em> from each of the three nationwide consumer reporting agencies once every 12 months. A Credit Score is not included.</p>

                <p class="small">After verification of your identity, your scores are available for immediate online, secure delivery. Scores shown in design are for illustrative purposes only.</p>
            </div>
        </div>
    </div>
</footer>

<!-- Scripts -->
<!-- This script conflicts with Stripe's Checkout -->
<script src="{{ asset('js/app.js') }}"></script>

<script type="text/javascript">
    $(function () {
        // Navigation active
        $('ul.navbar-nav a[href="{{ "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" }}"]').closest('li').addClass('active');
    });
</script>

@yield('scripts')

<script>
    window.closeCreditReportModal = function() {
        $('#creditReportModal').modal('hide');
    };

    jQuery(document).ready(function() {
        @yield('viewJquery')
    });
</script>
@yield('moreJS')
</body>
</html>