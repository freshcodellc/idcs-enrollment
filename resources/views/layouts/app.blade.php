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
    <script src="{{ asset('js/fontawesome.js') }}"></script>
    <script src="{{ asset('js/packs/solid.js') }}"></script>
    <script src="{{ asset('js/packs/regular.js') }}"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <a class="sys-logo" href="/"><img src="{{ asset('i/logo.jpg') }}" alt="See Your Score Logo"></a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav bwrap">
                        <img class="bureau" src="{{ asset('i/bureaus.png') }}" alt="">
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

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
