@extends('layouts.n_app')

@section('content')

<!-- Signup -->
    <section class="clearfix">
      <div class="row no-gutters align-items-center">
        <div class="col-lg-6">
            <img class="img-fluid g-bg-img-hero g-min-height-100vh--lg" src="{{ asset('i/b_square_short.jpg') }}" alt="girl looking at computer">
        </div>

        <div class="col-lg-6">
          <div class="g-pa-40 g-mx-70--xl">
            <!-- Form -->
            <h1>See Your Credit Scores Now</h1>
            <h4>View your Credit Scores and full Credit Reports from all 3 bureaus instantly. Simply fill out the form below.</h4>
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

    <!-- Vantage Notice -->
    <section class="g-mt-20">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <p class="small">Credit Score calculated based on Vantage 3.0 model. Your scores may vary from scores calculated by other credit models.</p>      
                </div>
            </div>
        </div>
    </section>

    <!-- Icon Blocks -->
    <section class="g-py-80">
      <div class="container">
        <div class="row no-gutters">
          <div class="col-lg-4 g-px-40 g-mb-50 g-mb-0--lg">
            <!-- Icon Blocks -->
            <div class="text-center">
              <span class="solid-bg-icon d-inline-block u-icon-v3 u-icon-size--xl g-bg-primary g-color-white rounded-circle g-mb-30">
                <i class="fal fa-dollar-sign"></i>
              </span>
              <h3 class="h5 g-color-gray-dark-v2 g-font-weight-600 text-uppercase mb-3">$1 for 7 Day Trial</h3>
              <p class="mb-0">No-Risk 7 day trial. Just $1 unlocks full access to all our credit services. (including a comprehensive Credit Report from all 3 Bureaus)</p>
            </div>
            <!-- End Icon Blocks -->
          </div>

          <div class="col-lg-4 g-brd-left--lg g-brd-gray-light-v4 g-px-40 g-mb-50 g-mb-0--lg">
            <!-- Icon Blocks -->
            <div class="text-center">
              <span class="solid-bg-icon d-inline-block u-icon-v3 u-icon-size--xl g-bg-primary g-color-white rounded-circle g-mb-30">
                <i class="fal fa-binoculars"></i>
              </span>
              <h3 class="h5 g-color-gray-dark-v2 g-font-weight-600 text-uppercase mb-3">24/7 Credit Monitoring</h3>
              <p class="mb-0">Around the clock credit monitoring notifies you of any significant changes to your report. (3 Bureau monitoring ensures you are notified any time your credit is used.)</p>
            </div>
            <!-- End Icon Blocks -->
          </div>

          <div class="col-lg-4 g-brd-left--lg g-brd-gray-light-v4 g-px-40">
            <!-- Icon Blocks -->
            <div class="text-center">
              <span class="solid-bg-icon d-inline-block u-icon-v3 u-icon-size--xl g-bg-primary g-color-white rounded-circle g-mb-30">
                <i class="fal fa-lock-alt"></i>
              </span>
              <h3 class="h5 g-color-gray-dark-v2 g-font-weight-600 text-uppercase mb-3">Fraud and Identity Theft Monitoring</h3>
              <p class="mb-0">Protect your identity with Social Security Monitoring, Personally Identifiable Information (PII) Monitoring, and Change of Address Monitoring.</p>
            </div>
            <!-- End Icon Blocks -->
          </div>
        </div>
        <div class="row no-gutters g-pt-80">
          <div class="col-lg-4 g-px-40 g-mb-50 g-mb-0--lg">
            <!-- Icon Blocks -->
            <div class="text-center">
              <span class="solid-bg-icon d-inline-block u-icon-v3 u-icon-size--xl g-bg-primary g-color-white rounded-circle g-mb-30">
                <i class="fal fa-clock"></i>
              </span>
              <h3 class="h5 g-color-gray-dark-v2 g-font-weight-600 text-uppercase mb-3">Access Anytime</h3>
              <p class="mb-0">View your most recent credit data at anytime, on any device. Viewing your credit report won’t hurt your score.</p>
            </div>
            <!-- End Icon Blocks -->
          </div>

          <div class="col-lg-4 g-brd-left--lg g-brd-gray-light-v4 g-px-40 g-mb-50 g-mb-0--lg">
            <!-- Icon Blocks -->
            <div class="text-center">
              <span class="solid-bg-icon d-inline-block u-icon-v3 u-icon-size--xl g-bg-primary g-color-white rounded-circle g-mb-30">
                <i class="fal fa-shield-check"></i>
              </span>
              <h3 class="h5 g-color-gray-dark-v2 g-font-weight-600 text-uppercase mb-3">$1M Identity Theft Insurance</h3>
              <p class="mb-0">Nearly 12 million Americans are victims of identity theft each year. Our $1M insurance gives peace of mind that, if anything happens, you’re covered.</p>
            </div>
            <!-- End Icon Blocks -->
          </div>

          <div class="col-lg-4 g-brd-left--lg g-brd-gray-light-v4 g-px-40">
            <!-- Icon Blocks -->
            <div class="text-center">
              <span class="solid-bg-icon d-inline-block u-icon-v3 u-icon-size--xl g-bg-primary g-color-white rounded-circle g-mb-30">
                <i class="fal fa-user"></i>
              </span>
              <h3 class="h5 g-color-gray-dark-v2 g-font-weight-600 text-uppercase mb-3">White Glove Identity Restoration</h3>
              <p class="mb-0">In the unfortunate event of Identity Fraud, our dedicated Fraud Resolution Support team will go to work on your behalf.</p>
            </div>
            <!-- End Icon Blocks -->
          </div>
        </div>
      </div>
    </section>
    <!-- End Icon Blocks -->

    <hr class="g-brd-gray-light-v4 my-0">

    <!-- Why Check Credit -->
    <section class="g-bg-secondary g-py-100">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 align-self-center g-mb-100 g-mb-0--lg">
            <header class="u-heading-v2-3--bottom g-brd-primary g-mb-20">
              <h2 class="h4 u-heading-v2__title g-color-gray-dark-v2 g-font-weight-600 text-uppercase">Why Check Your Credit?</h2>
            </header>

            <p class="g-font-size-16 g-mb-30">Your credit report unlocks the door to personal and business opportunities. Knowing your credit score is essential, whether you’re looking for good interest rates on mortgages, cars, or credit card offers; applying for a job; or trying to secure business funding. Regularly monitoring your credit keeps you informed of potential errors or red flags affecting your score, allows you to know exactly what you qualify for when applying for loans or lines of credit, and brings any signs of identity theft or credit fraud to your attention. </p>
          </div>

          <div class="col-lg-6 g-bg-img-hero g-pos-rel imgfillspace" style="background-image: url('{{ asset('i/text-bg.png') }}');">
            <div class="g-absolute-centered text-center w-100 g-px-40">
              <h2 class="h1 g-font-weight-600 g-letter-spacing-0_5">
                  <span class="u-text-animation u-text-animation--typing"></span></h2>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Why -->

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

@endsection
