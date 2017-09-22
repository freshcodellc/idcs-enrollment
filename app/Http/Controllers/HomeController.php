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

        //if (count($credit_urls) == 0) {
        //    $idcs_api = new IdcsApi(Auth::user());
        //    $idcs_api->enroll();
        //}

        return view('home', [
            'credit_urls' => $credit_urls
        ]);
    }

}
