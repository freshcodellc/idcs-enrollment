<?php

namespace App\Http\Controllers;

use App\Api\IdcsApi;
use App\CreditUrl;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
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
        $credit_urls = CreditUrl::where('user_id', Auth::user()->id)->get();

        $credit_url = false;
        if (isset($credit_urls[0]->url)) {
            $credit_url = $credit_urls[0]->url;
        }

        return view('home', [
            'credit_url' => $credit_url
        ]);
    }

    public function enroll()
    {
        $credit_urls = CreditUrl::where('user_id', Auth::user()->id)->get();

        if (count($credit_urls) == 0) {
            // user does not have a credit url, so enroll
            $idcs_api = new IdcsApi(Auth::user());

            $credit_url = $idcs_api->enroll();

            if ($credit_url) {
                return view('home', [
                    'success' => "Success! You are enrolled.",
                    'credit_url' => $credit_url
                ]);
            } else {
                return view('home', [
                    'error' => "Sorry! An error has occurred during enrollment.",
                    'credit_url' => false
                ]);
            }
        } else {
            return redirect('home')->with('success', 'Success! You are already enrolled.');
        }
    }

}
