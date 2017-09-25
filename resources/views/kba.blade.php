<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Credit Report') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style type="text/css">
        body {
            background: #FFFFFF;
        }
    </style>

</head>
<body>
<div id="app">

    <div class="container" style="margin-top: 40px;">
        <div class="row">

            @if (isset($success) && !empty($success))
            <div class="col-md-8 col-md-offset-2 alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ $success }}
            </div>
            @endif

            @if (isset($error) && !empty($error))
            <div class="col-md-8 col-md-offset-2 alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ $error }}
            </div>
            @endif

        </div>

        <div class="text-center" style="margin-top: 30px;">
            <button id="closeWindow" type="button" class="btn btn-primary">
                Close Window
            </button>
        </div>
    </div>

</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>

<script>
    jQuery(document).ready(function() {
        $("#closeWindow").click(function() {
            window.parent.closeCreditReportModal();
        })
    });
</script>
</body>
</html>
