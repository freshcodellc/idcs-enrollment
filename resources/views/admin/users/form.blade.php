<?php $states = [
"AL" =>"Alabama",
"AK" =>"Alaska",
"AS" =>"American Samoa",
"AZ" =>"Arizona",
"AR" =>"Arkansas",
"CA" =>"California",
"CO" =>"Colorado",
"CT" =>"Connecticut",
"DE" =>"Delaware",
"DC" =>"District Of Columbia",
"FL" =>"Florida",
"GA" =>"Georgia",
"GU" =>"Guam",
"HI" =>"Hawaii",
"ID" =>"Idaho",
"IL" =>"Illinois",
"IN" =>"Indiana",
"IA" =>"Iowa",
"KS" =>"Kansas",
"KY" =>"Kentucky",
"LA" =>"Louisiana",
"ME" =>"Maine",
"MD" =>"Maryland",
"MA" =>"Massachusetts",
"MI" =>"Michigan",
"MN" =>"Minnesota",
"MS" =>"Mississippi",
"MO" =>"Missouri",
"MT" =>"Montana",
"NE" =>"Nebraska",
"NV" =>"Nevada",
"NH" =>"New Hampshire",
"NJ" =>"New Jersey",
"NM" =>"New Mexico",
"NY" =>"New York",
"NC" =>"North Carolina",
"ND" =>"North Dakota",
"MP" =>"Northern Mariana Islands",
"OH" =>"Ohio",
"OK" =>"Oklahoma",
"OR" =>"Oregon",
"PA" =>"Pennsylvania",
"PR" =>"Puerto Rico",
"RI" =>"Rhode Island",
"SC" =>"South Carolina",
"SD" =>"South Dakota",
"TN" =>"Tennessee",
"TX" =>"Texas",
"UT" =>"Utah",
"VT" =>"Vermont",
"VI" =>"Virgin Islands",
"VA" =>"Virginia",
"WA" =>"Washington",
"WV" =>"West Virginia",
"WI" =>"Wisconsin",
"WY" =>"Wyoming",
];
?>

<div class="form-group{{ $errors->has('first_name') ? ' has-error' : ''}}">
    {!! Form::label('first_name', 'First Name', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('first_name', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('first_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group{{ $errors->has('last_name') ? ' has-error' : ''}}">
    {!! Form::label('last_name', 'Last Name', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('last_name', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('last_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group{{ $errors->has('email') ? ' has-error' : ''}}">
    {!! Form::label('email', 'Email', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::email('email', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group{{ $errors->has('phone') ? ' has-error' : ''}}">
    {!! Form::label('phone', 'Phone', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('phone', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group{{ $errors->has('address') ? ' has-error' : ''}}">
    {!! Form::label('address', 'Address', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('address', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group{{ $errors->has('city') ? ' has-error' : ''}}">
    {!! Form::label('city', 'City', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('city', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('city', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group{{ $errors->has('state') ? ' has-error' : ''}}">
    {!! Form::label('state', 'State', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('state', $states, null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group{{ $errors->has('zip') ? ' has-error' : ''}}">
    {!! Form::label('zip', 'Zip Code', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('zip', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('zip', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group{{ $errors->has('invite_code') ? ' has-error' : ''}}">
    {!! Form::label('invite_code', 'Invite Code', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('invite_code', null, ['class' => 'form-control']) !!}
        {!! $errors->first('invite_code', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group{{ $errors->has('username') ? ' has-error' : ''}}">
    {!! Form::label('username', 'Username', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('username', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('username', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group{{ $errors->has('password') ? ' has-error' : ''}}">
    {!! Form::label('password', 'Password', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::password('password', ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group{{ $errors->has('role') ? ' has-error' : ''}}">
    {!! Form::label('role', 'Role', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('role', $roles, 'Client', ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
