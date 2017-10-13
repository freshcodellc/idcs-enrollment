@extends('layouts.n_app')

@section('content')
    <!-- Signup -->
    <section class="g-bg-secondary">
      <div class="container g-pb-20">
        <div class="row justify-content-between">
          <div class="col-md-6 col-lg-7 flex-md-unordered align-self-center g-my-80">
            <ul class="thesteps">
                <li>Step 1: Account</li>
                <li class="todo-step">Step 2: Billing</li>
                <li class="todo-step">Step 3: Verify &amp; View Report</li>
            </ul>              
            <div class="u-shadow-v21 g-bg-white rounded g-pa-50">            
              <header class="text-center mb-4">
                <h2 class="h2 g-font-weight-600">Create Account</h2>
              </header>

              <!-- Form -->
            <form method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="first_name" class="control-label">First Name</label>
                              <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required>

                              @if ($errors->has('first_name'))
                              <span class="help-block">
                                      <strong>{{ $errors->first('first_name') }}</strong>
                                  </span>
                              @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="last_name" class="control-label">Last Name</label>

                                <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required>

                                @if ($errors->has('last_name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                        </div>               
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label">Email</label>

                                <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>                
                    </div>
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="control-label">Phone</label>

                                <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" required>

                                @if ($errors->has('phone'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                        </div>                
                    </div>
                </div>  

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="control-label">Address</label>

                                <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" required>

                                @if ($errors->has('address'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                        </div>                
                    </div>
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                            <label for="city" class="control-label">City</label>

                              <input id="city" type="text" class="form-control" name="city" value="{{ old('city') }}" required>

                              @if ($errors->has('city'))
                              <span class="help-block">
                                      <strong>{{ $errors->first('city') }}</strong>
                                  </span>
                              @endif
                        </div>                
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="state" class="control-label">State</label>

                                <select name="state" id="state" class="form-control">
                                    <option value="AL">Alabama</option>
                                    <option value="AK">Alaska</option>
                                    <option value="AS">American Samoa</option>
                                    <option value="AZ">Arizona</option>
                                    <option value="AR">Arkansas</option>
                                    <option value="CA">California</option>
                                    <option value="CO">Colorado</option>
                                    <option value="CT">Connecticut</option>
                                    <option value="DE">Delaware</option>
                                    <option value="DC">District Of Columbia</option>
                                    <option value="FL">Florida</option>
                                    <option value="GA">Georgia</option>
                                    <option value="GU">Guam</option>
                                    <option value="HI">Hawaii</option>
                                    <option value="ID">Idaho</option>
                                    <option value="IL">Illinois</option>
                                    <option value="IN">Indiana</option>
                                    <option value="IA">Iowa</option>
                                    <option value="KS">Kansas</option>
                                    <option value="KY">Kentucky</option>
                                    <option value="LA">Louisiana</option>
                                    <option value="ME">Maine</option>
                                    <option value="MD">Maryland</option>
                                    <option value="MA">Massachusetts</option>
                                    <option value="MI">Michigan</option>
                                    <option value="MN">Minnesota</option>
                                    <option value="MS">Mississippi</option>
                                    <option value="MO">Missouri</option>
                                    <option value="MT">Montana</option>
                                    <option value="NE">Nebraska</option>
                                    <option value="NV">Nevada</option>
                                    <option value="NH">New Hampshire</option>
                                    <option value="NJ">New Jersey</option>
                                    <option value="NM">New Mexico</option>
                                    <option value="NY">New York</option>
                                    <option value="NC">North Carolina</option>
                                    <option value="ND">North Dakota</option>
                                    <option value="MP">Northern Mariana Islands</option>
                                    <option value="OH">Ohio</option>
                                    <option value="OK">Oklahoma</option>
                                    <option value="OR">Oregon</option>
                                    <option value="PA">Pennsylvania</option>
                                    <option value="PR">Puerto Rico</option>
                                    <option value="RI">Rhode Island</option>
                                    <option value="SC">South Carolina</option>
                                    <option value="SD">South Dakota</option>
                                    <option value="TN">Tennessee</option>
                                    <option value="TX">Texas</option>
                                    <option value="UT">Utah</option>
                                    <option value="VT">Vermont</option>
                                    <option value="VI">Virgin Islands</option>
                                    <option value="VA">Virginia</option>
                                    <option value="WA">Washington</option>
                                    <option value="WV">West Virginia</option>
                                    <option value="WI">Wisconsin</option>
                                    <option value="WY">Wyoming</option>
                                </select>
                        </div>                
                    </div>
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('zip') ? ' has-error' : '' }}">
                            <label for="zip" class="control-label">Zip Code</label>

                                <input id="zip" type="text" class="form-control" name="zip" value="{{ old('zip') }}" required>

                                @if ($errors->has('zip'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('zip') }}</strong>
                                    </span>
                                @endif
                        </div>                
                    </div>
                </div>
                
                <h4 class="g-mb-5 g-mt-15">User Details</h4>
                <hr class="g-mt-0">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="control-label">Username</label>
                              <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required>
                              @if ($errors->has('username'))
                              <span class="help-block">
                                      <strong>{{ $errors->first('username') }}</strong>
                                  </span>
                              @endif
                        </div>                
                    </div>
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="control-label">Password</label>

                              <input id="password" type="password" class="form-control" name="password" required>

                              @if ($errors->has('password'))
                              <span class="help-block">
                                      <strong>{{ $errors->first('password') }}</strong>
                                  </span>
                              @endif
                        </div>                
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group" id="invite-code">
                            <label for="event-code" class="control-label">Invite Code</label>
                            <input id="event-code" type="text" class="form-control" name="eventcode" null>
                            <span id="error" style="color:red;"></span>
                        </div>
                    </div>

                    <script>
                    // Test and validate invite code ONLY if on fundwise.seeyourscore.com
                    if (location.host == "fundwise.seeyourscore.com") {
                        document.getElementById("invite-code").innerHTML = '<label for="event-code" class="control-label">Invite Code</label><input id="event-code" type="text" class="form-control" name="eventcode" onBlur="inviteCodeError()" onfocus="inviteCodeReset()" required> <span id="error" style="color:red;"></span>'
                    }
                    else {
                        document.getElementById("invite-code").innerHTML = '<label for="event-code" class="control-label">Invite Code</label><input id="event-code" type="text" class="form-control" name="eventcode" null>'
                    }

                    var inviteCodeReset = function() {
                        document.getElementById("error").innerHTML = ""
                    }
                    var inviteCodeError = function(){
                      var eventCode = document.getElementById('event-code').value.toLowerCase();
                      console.log(eventCode)
                      if (eventCode.match("response1|response2|response3|response4|response5|response6|response7|response8|response9|fwc1")) {
                      }
                      else
                        document.getElementById("error").innerHTML = "Invite code is not valid."
                    };
                    </script>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password-confirm" class="control-label">Confirm Password</label>

                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>                                    
                    </div>
                </div>

                <div class="form-group accountsub">
                    <div class="col-md-12 text-center g-mt-20">
                        <button type="submit" class="btn btn-primary btn-lg">
                            Create Account
                        </button>
                    </div>
                </div>
            </form>
            <!-- End Form -->

            <div class="lawyerstuff g-my-30" id="fwextra">
                <p>By clicking "Create Account", you agree to our <a href="/terms">Terms &amp; Conditions</a>, accept our <a href="/privacy">Privacy Policy</a>, and give See Your Score authorization to obtain your credit report and submit your secure order.</p>
            </div>
            <script>
                    if (location.host == "fundwise.seeyourscore.com") {
                        document.getElementById("fwextra").innerHTML = '
                        <p>By clicking "Create Account", you agree to our <a href="/terms">Terms &amp; Conditions</a>, accept our <a href="/privacy">Privacy Policy</a>, and give See Your Score authorization to obtain your credit report and submit your secure order. <br>By using this Invite code, you authorize your information to be shared with Fundwise Capital and its affiliates.</p>
                        '
                    }                
            </script>

              <footer class="text-center">
                <p class="g-color-gray-dark-v5 mb-0">Already have an account? <a class="g-font-weight-600" href="/login">login</a>
                </p>
              </footer>
            </div>
          </div>


        @include('sidebar')
      </div>
    </section>
    <!-- End Signup -->
@endsection
