<?php

namespace App\Http\Controllers;

use App\Api\IdcsApi;
use App\CreditUrl;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * @var CreditUrl
     */
    private $credit_url;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->credit_url = CreditUrl::where('user_id', Auth::user()->id)->first();

        if (empty($this->credit_url)) {
            $this->credit_url = new CreditUrl();
        }

        // check if credit_url has a kba success result and if payment has been collected
        $show_credit_report = false;
        if ($this->credit_url->kba_result) {
            // TODO: We should be checking for Stripe payment here

            $show_credit_report = true;


        }

        return view('home', [
            'credit_url' => $this->credit_url,
            'show_credit_report' => $show_credit_report
        ]);
    }

    public function enroll()
    {
        $view_params = [];
        $this->credit_url = CreditUrl::where('user_id', Auth::user()->id)->first();

        if (empty($this->credit_url)) {
            // user does not have a credit url, so enroll
            $idcs_api = new IdcsApi(Auth::user());

            try {
                $this->credit_url = $idcs_api->enroll();
            } catch (\App\Api\IdcsApiException $e) {
                $view_params['error'] = $e->getMessage();
                $this->credit_url = new CreditUrl;
            }

            if (!empty($this->credit_url->url)) {
                $view_params['success'] = "Success! You are enrolled.";
            }

            $view_params['credit_url'] = $this->credit_url;

            return view('home', $view_params);
        } else {
            return redirect('home')->with('success', 'Success! You are already enrolled.');
        }
    }

}
