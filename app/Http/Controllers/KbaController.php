<?php

namespace App\Http\Controllers;

use App\Charge;
use App\CreditUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
            // KBA was not successful, show error message and refund Stripe $1 charge

            // get user's charge id and save result
            $charge = Charge::where('id', $credit_url->charge_id)->first();

            if (!empty($charge->id)) {
                $stripe_secret_key = env('APP_ENV') == "local" ? env('STRIPE_KEY_TEST_SECRET') : env('STRIPE_KEY_SECRET');

                \Stripe\Stripe::setApiKey($stripe_secret_key);

                try {
                    $refund = \Stripe\Refund::create(array(
                        "charge" => $charge->stripe_id,
                    ));

                    if (isset($refund->id)) {
                        $charge->stripe_refund_id = $refund->id;
                        $charge->save();
                    }
                } catch (\Exception $e) {
                    Log::error("Unable to refund charge ID {$charge->id}. Exception: " . $e->getMessage());
                }

            }

            return view('kba', ['errors' => "Sorry! There was an error during ID verification. Please close this window and try again."]);
        }
    }


}
