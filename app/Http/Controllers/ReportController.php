<?php

namespace App\Http\Controllers;

use App\Api\IdcsApi;
use App\Charge;
use App\CreditUrl;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
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
     * View credit report if everything is in order
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->credit_url = CreditUrl::where('user_id', Auth::user()->id)->first();
        $view_params['stripe_key'] = env('APP_DEBUG') ? env('STRIPE_KEY_TEST_PUBLISHABLE') : env('STRIPE_KEY_PUBLISHABLE');
        $view_params['credit_url'] = $this->credit_url;

        if (empty($this->credit_url->kba_result)) {
            return redirect('home')->with('error', 'Credit report not viewable at this time. Please ensure your identity has been verified.');
        }

        return view('report', $view_params);
    }

    /**
     * Create a new Stripe charge and save to the database
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    protected function charge(Request $request)
    {
        $stripe_secret_key = env('APP_DEBUG') ? env('STRIPE_KEY_TEST_SECRET') : env('STRIPE_KEY_SECRET');

        \Stripe\Stripe::setApiKey($stripe_secret_key);

        $token = $request->stripeToken;

        // Charge the user's card:
        $stripe_charge = \Stripe\Charge::create(array(
            "amount" => 100,
            "currency" => "usd",
            "description" => "Credit report",
            "source" => $token,
        ));

        $this->credit_url = CreditUrl::where('user_id', Auth::user()->id)->first();

        try {
            $charge = Charge::create([
                'user_id' => Auth::user()->id,
                'stripe_id' => $stripe_charge->id,
                'amount' => $stripe_charge->amount,
            ]);

            $this->credit_url->charge_id = $charge->id;
            $this->credit_url->save();
        } catch (\Exception $e) {
            return view('report', [
                'error' => 'Credit card charge was unable to process.',
                'credit_url' => $this->credit_url
            ]);
        }

        return view('report', [
            'success' => 'Credit card charge successful.',
            'credit_url' => $this->credit_url
        ]);
    }
}
