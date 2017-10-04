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
     * @var array Array of errors to display to provide to the resulting view
     */
    private $errors = [];

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
        $this->getOrEnrollCreditUrl();

        return view('home', [
            'credit_url' => $this->credit_url,
            'errors' => $this->errors
        ]);
    }

    public function getOrEnrollCreditUrl()
    {
        $this->credit_url = CreditUrl::where('user_id', Auth::user()->id)->first();

        if (empty($this->credit_url)) {
            // user does not have a credit url, so enroll
            $idcs_api = new IdcsApi(Auth::user());

            $enroll_response = $idcs_api->enroll();
            if (isset($enroll_response['credit_url'])) {
                $this->credit_url = $enroll_response['credit_url'];
            }
            $this->errors = array_merge($enroll_response['errors'], $this->errors);
        }
    }

}
