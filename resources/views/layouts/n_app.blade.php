<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Title -->
  <title>See Your Credit Score for All 3 Bureaus for Just $1 - See Your Score</title>

  <!-- Required Meta Tags Always Come First -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <link rel="icon" type="image/png" href="{{ asset('i/favicon.png') }}">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  <!-- CSS Global Compulsory -->
  <link rel="stylesheet" href="{{ asset('vendor/bootstrap/bootstrap.min.css') }}">
  <!-- CSS Global Icons -->
  <link rel="stylesheet" href="{{ asset('vendor/dzsparallaxer/dzsparallaxer.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/dzsparallaxer/dzsscroller/scroller.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/dzsparallaxer/advancedscroller/plugin.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/animate.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/fancybox/jquery.fancybox.min.css') }}">
  <!-- <link rel="stylesheet" href="{{ asset('vendor/slick-carousel/slick/slick.css') }}"> -->
  <link rel="stylesheet" href="{{ asset('vendor/typedjs/typed.css') }}">
  <!-- <link rel="stylesheet" href="{{ asset('vendor/hs-megamenu/src/hs.megamenu.css') }}"> -->
  <!-- <link rel="stylesheet" href="{{ asset('vendor/hamburgers/hamburgers.min.css') }}"> -->

  <!-- CSS Unify -->
  <link rel="stylesheet" href="{{ asset('css/unify.css') }}">
  <!-- <link rel="stylesheet" href="{{ asset('css/unify-components.css') }}"> -->
  <!-- <link rel="stylesheet" href="{{ asset('css/unify-globals.css') }}"> -->

  <!-- CSS Customization -->
  <link href="{{ asset('css/n_score.css') }}" rel="stylesheet">
  <script src="{{ asset('js/fontawesome.js') }}"></script>
  <script src="{{ asset('js/packs/light.js') }}"></script>
  <script src="{{ asset('js/packs/brands.js') }}"></script>
</head>

<body>
  <main>
    <!-- Header -->
    <header id="js-header" class="u-header u-header--static">
      <div class="u-header__section u-header__section--light g-bg-white g-transition-0_3 g-py-10">
        <nav class="js-mega-menu navbar navbar-expand-lg">
          <div class="container">

            <!-- Logo -->
            <a href="/" class="navbar-brand">
              <img src="{{ asset('i/logo.jpg') }}" alt="See Your Score Logo">
            </a>
            <img class="bureau" src="{{ asset('i/bureaus.png') }}" alt="">           

            <div class="d-inline-block g-pos-rel g-valign-middle g-pl-30 g-pl-0--lg thelogin">
              <!-- Authentication Links -->
              @guest
                  <li><a class="btn u-btn-outline-primary g-font-size-13 text-uppercase g-py-10 g-px-15" href="{{ route('login') }}">Login</a></li>
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
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- End Header -->

    <!-- Signup -->
    <section class="clearfix">
      <div class="row no-gutters align-items-center">
        <div class="col-lg-6">
            <!-- <div class="js-slide g-bg-img-hero g-min-height-100vh--lg" style="background-image: url(../../assets/img-temp/900x900/img3.jpg);" data-calc-target="#js-header"></div> -->
            <img class="img-fluid g-bg-img-hero g-min-height-100vh--lg" src="{{ asset('i/b_square.jpg') }}" alt="girl looking at computer">
        </div>

        <div class="col-lg-6">
          <div class="g-pa-40 g-mx-70--xl">
            <!-- Form -->
            <h1>See Your Credit Scores Now</h1>
            <h4>Get your full credit report from all three credit reporting agencies in minutes. Begin the 3 simple steps by filling out the form below.</h4>
            <p><em>Checking your credit will not harm your score.</em></p>
            @if (empty(Auth::user()->id))

            <form class="form-horizontal startform" method="POST">
                {{ csrf_field() }}

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="first_name" class="col-md-4 control-label">First Name</label>
                            <div class="col-md-8 startformfield">
                                <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" placeholder="First Name" required>

                                @if ($errors->has('first_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="last_name" class="col-md-4 control-label">Last Name</label>

                            <div class="col-md-8 startformfield">
                                <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name" required>

                                @if ($errors->has('last_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Email</label>

                            <div class="col-md-8 startformfield">
                                <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required>

                                @if ($errors->has('email'))
                                <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-warning btn-lg text-center startbtn">
                    GET STARTED NOW
                </button>
            </form>
            @else
            <a class="btn btn-warning btn-lg text-center startbtn" href="{{ route('home') }}">
                Go to My Account
            </a>
            @endif
            <!-- End Form -->
          </div>
        </div>
      </div>
    </section>
    <!-- End Signup -->







    <!-- Promo Block -->
    <!-- <section class="dzsparallaxer auto-init height-is-based-on-content use-loading mode-scroll loaded dzsprx-readyall" data-options='{direction: "reverse", settings_mode_oneelement_max_offset: "150"}'>
      <div class="divimage dzsparallaxer--target w-100 g-bg-pos-bottom-center" style="height: 120%; background-image: url({{ asset('i/banner3darker.jpg') }});"></div>
      <div class="container g-py-100">
        <div class="row">
          <div class="col-md-6">
            <h3 class="banner-text g-color-white g-font-weight-300 g-font-size-40 g-line-height-1_2 mb-4">See Your Credit Score<br>&amp; Full Report
              </h3>
            <span class="banner-text d-block g-color-white-opacity-0_8 g-font-size-16 mb-5">From All 3 Bureaus</span>
          </div>
          <div class="col-md-6 g-color-white">
            <h3>See Your Scores Now</h3>
                <p>Get your full credit report from all three credit reporting agencies in minutes.</p>
                <p><em>Checking your credit will not harm your score.</em></p>
                @if (empty(Auth::user()->id))

                <form class="form-horizontal startform" method="POST">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                <label for="first_name" class="col-md-4 control-label">First Name</label>
                                <div class="col-md-8 startformfield">
                                    <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" placeholder="First Name" required>

                                    @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                <label for="last_name" class="col-md-4 control-label">Last Name</label>

                                <div class="col-md-8 startformfield">
                                    <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name" required>

                                    @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Email</label>

                                <div class="col-md-8 startformfield">
                                    <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required>

                                    @if ($errors->has('email'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg btn-warning text-center startbtn">
                        GET STARTED NOW
                    </button>
                </form>
                @else
                <a class="btn btn-primary btn-lg btn-warning text-center startbtn" href="{{ route('home') }}">
                    Go to My Account
                </a>
                @endif
          </div>
        </div>
      </div>
    </section> -->
    <!-- End Promo Block -->

    <!-- Icon Blocks -->
    <section class="g-py-100">
      <div class="container">
        <div class="row no-gutters">
          <div class="col-lg-4 g-px-40 g-mb-50 g-mb-0--lg">
            <!-- Icon Blocks -->
            <div class="text-center">
              <span class="solid-bg-icon d-inline-block u-icon-v3 u-icon-size--xl g-bg-primary g-color-white rounded-circle g-mb-30">
                <i class="fal fa-dollar-sign"></i>
              </span>
              <h3 class="h5 g-color-gray-dark-v2 g-font-weight-600 text-uppercase mb-3">7 Day Free Trial</h3>
              <p class="mb-0">No risk 7 day free trial. Just pay $1 for your 3 bureau credit report.</p>
            </div>
            <!-- End Icon Blocks -->
          </div>

          <div class="col-lg-4 g-brd-left--lg g-brd-gray-light-v4 g-px-40 g-mb-50 g-mb-0--lg">
            <!-- Icon Blocks -->
            <div class="text-center">
              <span class="solid-bg-icon d-inline-block u-icon-v3 u-icon-size--xl g-bg-primary g-color-white rounded-circle g-mb-30">
                <i class="fal fa-shield-check"></i>
              </span>
              <h3 class="h5 g-color-gray-dark-v2 g-font-weight-600 text-uppercase mb-3">Fraud &amp; Credit Monitoring</h3>
              <p class="mb-0">Get daily credit, fraud and identity theft monitoring. $1M dollar ID theft policy included.</p>
            </div>
            <!-- End Icon Blocks -->
          </div>

          <div class="col-lg-4 g-brd-left--lg g-brd-gray-light-v4 g-px-40">
            <!-- Icon Blocks -->
            <div class="text-center">
              <span class="solid-bg-icon d-inline-block u-icon-v3 u-icon-size--xl g-bg-primary g-color-white rounded-circle g-mb-30">
                <i class="fal fa-lock-alt"></i>
              </span>
              <h3 class="h5 g-color-gray-dark-v2 g-font-weight-600 text-uppercase mb-3">Secure Online Delivery</h3>
              <p class="mb-0">Get instant unlimited access to your credit reports via your secure account.</p>
            </div>
            <!-- End Icon Blocks -->
          </div>
        </div>
      </div>
    </section>
    <!-- End Icon Blocks -->

    <hr class="g-brd-gray-light-v4 my-0">

    <!-- About Our Company -->
    <section class="1g-bg-secondary g-py-100">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 align-self-center g-mb-100 g-mb-0--lg">
            <header class="u-heading-v2-3--bottom g-brd-primary g-mb-20">
              <h2 class="h4 u-heading-v2__title g-color-gray-dark-v2 g-font-weight-600 text-uppercase">About See Your Score</h2>
            </header>

            <p class="g-font-size-16 g-mb-30">See Your Score was founded to provide easy access for everyone to their credit scores with a full credit report from all three bureaus.</p>

            <ul class="list-unstyled g-color-gray-dark-v4 mb-0">
              <li class="d-flex g-mb-10">
                <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Daily Credit Monitoring &amp; Alerts
              </li>
              <li class="d-flex g-mb-10">
                <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> $1M ID Theft Policy
              </li>
              <li class="d-flex g-mb-10">
                <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Fraud &amp; Identity Theft Monitoring
              </li>
              <li class="d-flex g-mb-10">
                <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Toll Free Customer Service
              </li>
            </ul>
          </div>

          <div class="col-lg-6 g-bg-img-hero g-pos-rel" style="background-image: url('{{ asset('i/text-bg.png') }}');">
            <div class="g-absolute-centered text-center w-100 g-px-40">
              <h2 class="h1 g-font-weight-600 g-letter-spacing-0_5">
                  <span class="u-text-animation u-text-animation--typing"></span></h2>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End About Our Company -->


    <!-- Most Quality Solution -->
    <section class="dzsparallaxer auto-init height-is-based-on-content use-loading" data-options='{direction: "reverse", settings_mode_oneelement_max_offset: "150"}'>
      <!-- Parallax Image -->
      <div class="divimage dzsparallaxer--target w-100 u-bg-overlay g-bg-img-hero g-bg-white-opacity-0_7--after" style="height: 140%; background-image: url('{{ asset('i/banner3.jpg') }}');"></div>
      <!-- End Parallax Image -->

      <div class="container u-bg-overlay__inner g-py-150--md g-py-80">
        <div class="row">
          <!-- Section Content -->
          <div class="col-lg-6 order-2 order-sm-1 g-mb-0 g-mb-50--sm g-mb-0--lg">
            <div class="u-heading-v2-3--bottom g-brd-primary g-mb-30">
              <h2 class="h4 u-heading-v2__title g-color-gray-dark-v2 g-font-weight-600 text-uppercase">Your Latest Credit Score</h2>
            </div>
            <p class="g-font-size-16 g-line-height-2 g-mb-30">Our goal is helping you make wise credit decisions by giving you quick and simple access to your credit reports and scores. Online signup in just minutes, with a FREE 7 day trial and easy online cancellation.</p>
          </div>
          <!-- End Section Content -->
        </div>
      </div>
    </section>
    <!-- End Most Quality Solution -->



    <!-- Call To Action -->
    <section class="g-bg-primary g-color-white g-pa-30">
      <div class="d-md-flex justify-content-md-center text-center">
        <div class="align-self-md-center">
          <p class="lead g-font-weight-400 g-mr-20--md g-mb-15 g-mb-0--md">Get your 3 bureau credit report now for just $1</p>
        </div>
        <div class="align-self-md-center">
          <a class="btn btn-lg u-btn-white text-uppercase g-font-weight-600 g-font-size-12" href="/register">Begin Registration</a>
        </div>
      </div>
    </section>
    <!-- End Call To Action -->

    <!-- Footer -->
    <div id="contacts-section" class="g-bg-black-opacity-0_9 g-color-white-opacity-0_8 g-py-60">
      <div class="container">
        <div class="row">
          <!-- Footer Content -->
          <div class="col-lg-9 col-md-6 g-mt-60 g-mb-0--lg">
            <p class="small">Important Information: The credit score you receive from us may not be the same scores used by lenders or other commercial users for credit decisions. There are various types of credit scores, and lenders may use a different type of credit score to make lending decisions that are different than the ones we offer.</p>

            <p class="small">Under federal law you have the right to receive a credit report from each of the three nationwide consumer reporting agencies once every 12 months. A Credit Score is not included.</p>

            <p class="small">After verification of your identity, your scores are available for immediate online, secure delivery. Scores shown in design are for illustrative purposes only.</p>
          </div>
          <!-- End Footer Content -->

          <!-- Footer Content -->
          <div class="col-lg-3 col-md-6">
            <div class="u-heading-v2-3--bottom g-brd-white-opacity-0_8 g-mb-20">
              <h2 class="u-heading-v2__title h6 text-uppercase mb-0">Contact Us</h2>
            </div>

            <address class="g-bg-no-repeat g-font-size-12 mb-0 g-pb-100" style="background-image: url('{{ asset('i/map2.png') }}');">
              <!-- Location -->
<!--               <div class="d-flex g-mb-20">
                <div class="g-mr-10">
                  <span class="u-icon-v3 u-icon-size--xs g-pt-4 g-bg-white-opacity-0_1 g-color-white-opacity-0_6">
                    <i class="fal fa-map-marker"></i>
                  </span>
                </div>
                <p class="mb-0">795 Folsom Ave, Suite 600, <br> San Francisco, CA 94107 795</p>
              </div> -->
              <!-- End Location -->

              <!-- Phone -->
              <div class="d-flex g-mb-20">
                <div class="g-mr-10">
                  <span class="u-icon-v3 u-icon-size--xs g-pt-4 g-bg-white-opacity-0_1 g-color-white-opacity-0_6">
                    <i class="fal fa-phone"></i>
                  </span>
                </div>
                <p class="mb-0">(888) 876-6610</p>
              </div>
              <!-- End Phone -->

              <!-- Email and Website -->
              <div class="d-flex g-mb-20">
                <div class="g-mr-10">
                  <span class="u-icon-v3 u-icon-size--xs g-pt-4 g-bg-white-opacity-0_1 g-color-white-opacity-0_6">
                    <i class="fal fa-globe"></i>
                  </span>
                </div>
                <p class="mb-0">
                  <a class="g-color-white-opacity-0_8 g-color-white--hover" href="mailto:support@seeyourscore.com">support@seeyourscore.com</a>
                </p>
              </div>
              <!-- End Email and Website -->
            </address>
          </div>
          <!-- End Footer Content -->
        </div>
      </div>
    </div>
    <!-- End Footer -->

    <!-- Copyright Footer -->
    <footer class="g-bg-gray-dark-v1 g-color-white-opacity-0_8 g-py-20">
      <div class="container">
        <div class="row">
          <div class="col-md-8 text-center text-md-left g-mb-10 g-mb-0--md">
            <div class="d-lg-flex">
              <small class="d-block g-font-size-default g-mr-10 g-mb-10 g-mb-0--md">2017 © SeeYourScore - All Rights Reserved.</small>
              <ul class="u-list-inline">
                <li class="list-inline-item">
                  <a class="g-color-white-opacity-0_8 g-color-white--hover" href="#">Privacy Policy</a>
                </li>
                <li class="list-inline-item">
                  <span>|</span>
                </li>
                <li class="list-inline-item">
                  <a class="g-color-white-opacity-0_8 g-color-white--hover" href="#">Terms of Use</a>
                </li>
              </ul>
            </div>
          </div>

          <!-- Social accounts -->
<!--           <div class="col-md-4 align-self-center">
            <ul class="list-inline text-center text-md-right mb-0">
              <li class="list-inline-item g-mx-10" data-toggle="tooltip" data-placement="top" title="Facebook">
                <a href="#" class="g-color-white-opacity-0_5 g-color-white--hover">
                  <i class="fab fa-facebook"></i>
                </a>
              </li>
              <li class="list-inline-item g-mx-10" data-toggle="tooltip" data-placement="top" title="Linkedin">
                <a href="#" class="g-color-white-opacity-0_5 g-color-white--hover">
                  <i class="fab fa-linkedin"></i>
                </a>
              </li>
              <li class="list-inline-item g-mx-10" data-toggle="tooltip" data-placement="top" title="Twitter">
                <a href="#" class="g-color-white-opacity-0_5 g-color-white--hover">
                  <i class="fab fa-twitter"></i>
                </a>
              </li>
            </ul>
          </div> -->

        </div>
      </div>
    </footer>
    <!-- End Copyright Footer -->
    <a class="js-go-to u-go-to-v1 g-pt-6 g-pl-8" href="#" data-type="fixed" data-position='{
     "bottom": 15,
     "right": 15
   }' data-offset-top="400" data-compensation="#js-header" data-show-effect="zoomIn">
      <i class="fal fa-arrow-alt-up fa-2x"></i>
    </a>
  </main>

  <div class="u-outer-spaces-helper"></div>


  <!-- JS Global Compulsory -->
  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/jquery-migrate/jquery-migrate.min.js') }}"></script>
  <script src="{{ asset('vendor/jquery.easing/js/jquery.easing.js') }}"></script>
  <script src="{{ asset('vendor/popper.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/bootstrap.min.js') }}"></script>

  <!-- JS Implementing Plugins -->
  <!-- <script src="../../vendor/hs-megamenu/src/hs.megamenu.js"></script> -->
  <script src="{{ asset('vendor/dzsparallaxer/dzsparallaxer.js') }}"></script>
  <script src="{{ asset('vendor/dzsparallaxer/dzsscroller/scroller.js') }}"></script>
  <script src="{{ asset('vendor/dzsparallaxer/advancedscroller/plugin.js') }}"></script>
  <script src="{{ asset('vendor/fancybox/jquery.fancybox.min.js') }}"></script>
  <!-- <script src="../../vendor/slick-carousel/slick/slick.js"></script> -->
  <script src="{{ asset('vendor/typedjs/typed.min.js') }}"></script>

  <!-- JS Unify -->
  <script src="{{ asset('n_js/hs.core.js') }}"></script>
  <script src="{{ asset('n_js/components/hs.header.js') }}"></script>
  <!-- <script src="{{ asset('n_js/helpers/hs.hamburgers.js') }}"></script> -->
  <script src="{{ asset('n_js/components/hs.tabs.js') }}"></script>
  <script src="{{ asset('n_js/components/hs.popup.js') }}"></script>
  <!-- <script src="../../n_js/components/hs.carousel.js"></script> -->
  <script src="{{ asset('n_js/components/text-animation/hs.text-slideshow.js') }}"></script>
  <script src="{{ asset('n_js/components/hs.go-to.js') }}"></script>

  <!-- JS Customization -->
  <!-- <script src="../../n_js/custom.js"></script> -->

  <!-- JS Plugins Init. -->
  <script>
    $(document).on('ready', function () {
        // initialization of carousel
        // $.HSCore.components.HSCarousel.init('.js-carousel');

        // initialization of tabs
        $.HSCore.components.HSTabs.init('[role="tablist"]');

        // initialization of popups
        $.HSCore.components.HSPopup.init('.js-fancybox');

        // initialization of go to
        $.HSCore.components.HSGoTo.init('.js-go-to');

        // initialization of text animation (typing)
        $(".u-text-animation.u-text-animation--typing").typed({
          strings: [
            "Easy registration",
            "Reports in minutes",
            "See YOUR score"
          ],
          typeSpeed: 60,
          loop: true,
          backDelay: 1500
        });
      });

      $(window).on('load', function () {
        // initialization of header
        $.HSCore.components.HSHeader.init($('#js-header'));
        // $.HSCore.helpers.HSHamburgers.init('.hamburger');

        // initialization of HSMegaMenu component
        // $('.js-mega-menu').HSMegaMenu({
        //   event: 'hover',
        //   pageContainer: $('.container'),
        //   breakpoint: 991
        // });
      });

      $(window).on('resize', function () {
        setTimeout(function () {
          $.HSCore.components.HSTabs.init('[role="tablist"]');
        }, 200);
      });
  </script>


</body>

</html>
