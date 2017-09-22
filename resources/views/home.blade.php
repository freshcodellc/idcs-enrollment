@extends('layouts.app')

@section('content')
<div class="container">

    @if (count($credit_urls) > 0)
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3>Credit URLs</h3>
        </div>
    </div>
    @endif

    @foreach ($credit_urls as $credit_url)
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    {{ $credit_url->url }}
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <div class="row text-center">
        <!--<button type="button"
                class="btn btn-primary btn-lg">
            Enroll
        </button>-->

        <button type="button"
                class="btn btn-primary btn-lg"
                data-toggle="modal"
                data-target="#enrollModal">
            Launch Modal
        </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="enrollModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <!--<h5 class="modal-title" id="enrollModalLabel">Modal title</h5>-->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body iframe">

                        <iframe src="http://espn.com" id="info" class="iframe" name="info" seamless="" height="100%" width="100%"></iframe>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
