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
              <img class="img-fluid" src="{{ asset('i/logo.jpg') }}" alt="See Your Score Logo">
            </a>
            <img class="bureau" src="{{ asset('i/bureaus.png') }}" alt="">           

            <ul class="thelogin">
              <!-- Authentication Links -->
              @guest
                  <li><a class="btn u-btn-outline-primary g-font-size-13 text-uppercase g-py-10 g-px-15" href="{{ route('login') }}">Login</a></li>
              @else
                  <li class="nav-item dropdown">
                      <a href="#" class="nav-link btn u-btn-outline-primary g-font-size-13 text-uppercase g-py-10 g-px-15" data-toggle="dropdown" role="button"  aria-haspopup="true" aria-expanded="false">
                         <i class="fal fa-user"></i> {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                      </a>

                      <ul class="dropdown-menu">
                          <li>
                              <a class="dropdown-item" href="{{ route('logout') }}"
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
        </nav>
      </div>
    </header>
    <!-- End Header -->

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
  <!-- <script src="{{ asset('n_js/components/hs.header.js') }}"></script> -->
  <!-- <script src="{{ asset('n_js/helpers/hs.hamburgers.js') }}"></script> -->
  <!-- <script src="{{ asset('n_js/components/hs.tabs.js') }}"></script> -->
  <!-- <script src="{{ asset('n_js/components/hs.popup.js') }}"></script> -->
  <!-- <script src="../../n_js/components/hs.carousel.js"></script> -->
  <script src="{{ asset('n_js/components/text-animation/hs.text-slideshow.js') }}"></script>
  <!-- <script src="{{ asset('n_js/components/hs.go-to.js') }}"></script> -->


  <!-- Laravel Scripts -->
  <script src="{{ asset('js/app.js') }}"></script>
  
  <!-- JS Plugins Init. -->
  <script>
    $(document).on('ready', function () {
        // initialization of carousel
        // $.HSCore.components.HSCarousel.init('.js-carousel');

        // initialization of tabs
        // $.HSCore.components.HSTabs.init('[role="tablist"]');

        // initialization of popups
        // $.HSCore.components.HSPopup.init('.js-fancybox');

        // initialization of go to
        // $.HSCore.components.HSGoTo.init('.js-go-to');

        // initialization of text animation (typing)
        $(".u-text-animation--typing").typed({
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

      // $(window).on('load', function () {
        // initialization of header
        // $.HSCore.components.HSHeader.init($('#js-header'));
        // $.HSCore.helpers.HSHamburgers.init('.hamburger');

        // initialization of HSMegaMenu component
        // $('.js-mega-menu').HSMegaMenu({
        //   event: 'hover',
        //   pageContainer: $('.container'),
        //   breakpoint: 991
        // });
      // });

  </script>



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
