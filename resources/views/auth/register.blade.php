@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-12">
            <ul class="thesteps">
                <li class="comped">1. Create Account</li>
                <li>2. Review & Pay</li>
                <li>3. Verify & View Report</li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="first_name" class="col-md-4 control-label">First Name</label>
                            <div class="col-md-8">
                                <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required>

                                @if ($errors->has('first_name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="last_name" class="col-md-4 control-label">Last Name</label>

                            <div class="col-md-8">
                                <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required>

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
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Email</label>

                            <div class="col-md-8">
                                <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                
                    </div>
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Phone</label>

                            <div class="col-md-8">
                                <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" required>

                                @if ($errors->has('phone'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                
                    </div>
                </div>  

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label">Address</label>

                            <div class="col-md-8">
                                <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" required>

                                @if ($errors->has('address'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                
                    </div>
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                            <label for="city" class="col-md-4 control-label">City</label>

                            <div class="col-md-8">
                                <input id="city" type="text" class="form-control" name="city" value="{{ old('city') }}" required>

                                @if ($errors->has('city'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="state" class="col-md-4 control-label">State</label>

                            <div class="col-md-8">
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
                    </div>
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('zip') ? ' has-error' : '' }}">
                            <label for="zip" class="col-md-4 control-label">Zip Code</label>

                            <div class="col-md-8">
                                <input id="zip" type="text" class="form-control" name="zip" value="{{ old('zip') }}" required>

                                @if ($errors->has('zip'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('zip') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">Username</label>

                            <div class="col-md-8">
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required>

                                @if ($errors->has('username'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                
                    </div>
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-8">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8 col-md-push-4">
                        <div class="form-group">
                            <label for="password-confirm" class="col-md-6 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>                                    
                    </div>
                </div>

                <div class="form-group accountsub">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary btn-lg">
                            Create Account
                        </button>
                    </div>
                </div>
            </form>
        </div>
        @include('sidebar')
    </div>
    @endsection
