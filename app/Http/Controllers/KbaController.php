<?php

namespace App\Http\Controllers;

use App\CreditUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KbaController extends Controller
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
     * Handle the results from the IDCS KBA
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // get parameters
        $kba_result = $request->query('result');

        // get user's credit URL and save result
        $credit_url = CreditUrl::where('user_id', Auth::user()->id)->first();
        $credit_url->kba_result = (int) $kba_result;
        $credit_url->save();

        if ($credit_url->kba_result == 1) {
            return view('kba', ['success' => "Success! Identity verified."]);
        } else {
            // KBA was not successful, show error message
            return view('kba', ['error' => "Sorry! There was an error during ID verification. Please close this window and try again."]);
        }
    }


}
