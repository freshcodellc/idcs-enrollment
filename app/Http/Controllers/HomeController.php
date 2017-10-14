<?php

namespace App\Http\Controllers;

use App\Api\IdcsApi;
use App\Api\IdcsApiException;
use App\Charge;
use App\CreditUrl;
use App\StripeCustomer;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * @var CreditUrl
     */
    private $credit_url;

    /**
     * @var StripeCustomer
     */
    private $stripe_customer;

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
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->getOrEnrollCreditUrl();
        $this->stripe_customer = StripeCustomer::where('user_id', Auth::user()->id)->first();

        if (!empty($this->credit_url->charge_id) && empty($this->stripe_customer->subscription_id)) {
            $this->subscribe();
        }

        $stripe_key = env('APP_ENV') == "local" ? env('STRIPE_KEY_TEST_PUBLISHABLE') : env('STRIPE_KEY_PUBLISHABLE');

        if ($request->input['error']) {
            $this->errors[] = $request->input['error'];
        }

        return view('home', [
            'stripe_key' => $stripe_key,
            'stripe_customer' => $this->stripe_customer,
            'credit_url' => $this->credit_url,
            'errors' => $this->errors,
            'success' => $request->input('success')
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

    /**
     * Create a new Stripe charge and save to the database
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    protected function payment(Request $request)
    {
        $view_params = [];
        $this->credit_url = CreditUrl::where('user_id', Auth::user()->id)->first();
        $this->stripe_customer = StripeCustomer::where('user_id', Auth::user()->id)->first();

        $stripe_key = env('APP_ENV') == "local" ? env('STRIPE_KEY_TEST_PUBLISHABLE') : env('STRIPE_KEY_PUBLISHABLE');
        $stripe_secret_key = env('APP_ENV') == "local" ? env('STRIPE_KEY_TEST_SECRET') : env('STRIPE_KEY_SECRET');

        \Stripe\Stripe::setApiKey($stripe_secret_key);

        $token = $request->stripeToken;
        $email = $request->stripeEmail;

        if (empty($this->stripe_customer)) {
            $this->createStripeCustomer($email, $token);
        }

        if (empty($this->credit_url->charge_id)) {
            $this->chargeSetupFee();
        }

        if (empty($this->stripe_customer->subscription_id)) {
            $this->subscribe("credit-report-sub");
        }

        $get_params['errors'] = $this->errors;

        if (isset($this->stripe_customer->subscription_id) && !empty($this->stripe_customer->subscription_id)) {
            $get_params['success'] = "Success! Credit card charged and subscription setup.";
        }

        // redirect back home
        return redirect()->route('home', $get_params);
    }

    protected function createSubscriptionPlan() {
        $stripe_secret_key = env('APP_ENV') == "local" ? env('STRIPE_KEY_TEST_SECRET') : env('STRIPE_KEY_SECRET');

        \Stripe\Stripe::setApiKey($stripe_secret_key);
        try {
            $plan = \Stripe\Plan::create(array(
                "amount" => 2900,
                "interval" => "month",
                "name" => "Credit Report Subscription",
                "currency" => "usd",
                "id" => "credit-report-sub",
                "trial_period_days" => 7
            ));
        } catch (\Exception $e) {
            if (stripos($e->getMessage(), "Plan already exists") !== false) {
                if (env('APP_DEBUG')) {
                    echo "Plan already created with id of 'credit-report-sub'";
                }
            }
        }

        if (env('APP_DEBUG')) {
            echo "Plan successfully created with id of 'credit-report-sub'";
        }
    }

    /**
     * Create a customer via Stripe API
     *
     * @param string $email Email used during Stripe checkout
     * @param string $token Stripe token
     * @return \Stripe\Customer
     */
    private function createStripeCustomer($email, $token) {
        $customer = \Stripe\Customer::create(array(
            'email' => $email,
            'source'  => $token
        ));

        $this->stripe_customer = StripeCustomer::create([
            'user_id' => Auth::user()->id,
            'stripe_customer_id' => $customer->id,
            'stripe_email' => $email,
        ]);
    }

    private function chargeSetupFee() {
        $stripe_charge = \Stripe\Charge::create(array(
            "customer" => $this->stripe_customer->stripe_customer_id,
            "amount" => 100,
            "currency" => "usd",
            "description" => "One-time Credit Report fee",
        ));

        if (env('APP_DEBUG')) {
            dump($stripe_charge);
        }

        // store charge information to database
        $charge = Charge::create([
            'user_id' => Auth::user()->id,
            'stripe_id' => $stripe_charge->id,
            'amount' => $stripe_charge->amount,
        ]);

        $this->credit_url->charge_id = $charge->id;
        $this->credit_url->save();
    }

    protected function subscribe($plan = 'credit-report-sub') {
        $stripe_secret_key = env('APP_ENV') == "local" ? env('STRIPE_KEY_TEST_SECRET') : env('STRIPE_KEY_SECRET');

        \Stripe\Stripe::setApiKey($stripe_secret_key);

        // subscribe user to $29 per month plan with a 7 day grace period (free trial)
        try {
            $subscription = \Stripe\Subscription::create(array(
                "customer" => $this->stripe_customer->stripe_customer_id,
                "items" => array(
                    array(
                        "plan" => $plan,
                    ),
                ),
                "trial_period_days" => 7,
            ));
        } catch (\Stripe\Error\InvalidRequest $e) {
            // check if the plan does not exist
            if (stripos($e->getMessage(), 'No such plan: credit-report-sub') !== false) {
                $this->createSubscriptionPlan();
                unset($subscription);
            }
        }

        if (!isset($subscription)) {
            // lets try again with the new plan
            $subscription = \Stripe\Subscription::create(array(
                "customer" => $this->stripe_customer->stripe_customer_id,
                "items" => array(
                    array(
                        "plan" => $plan,
                    ),
                ),
                "trial_period_days" => 7,
            ));
        }

        if (isset($subscription->id)) {
            $this->stripe_customer->subscription_id = $subscription->id;
            $this->stripe_customer->save();
        }
    }

    /**
     * Cancel Stripe Subscription and IDCS enrollment for user
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    protected function cancel(Request $request)
    {
        // cancel IDCS enrollment, if necessary
        $this->credit_url = CreditUrl::where('user_id', Auth::user()->id)->first();
        if (empty($this->credit_url->cancelled_at)) {
            $idcs_api = new IdcsApi(Auth::user());
            $cancel_response = $idcs_api->cancel();

            if ($cancel_response) {
                // mark credit url as cancelled
                $this->credit_url->cancelled_at = Carbon::now()->toDateTimeString();
                $this->credit_url->save();
            }
        } else {
            $cancel_response = true; // enrollment already cancelled
        }

        // only cancel Stripe if the enrollment has been cancelled
        if ($cancel_response) {
            // cancel Stripe, if necessary
            $this->stripe_customer = StripeCustomer::where('user_id', Auth::user()->id)->first();
            if (!empty($this->stripe_customer->subscription_id) && empty($this->stripe_customer->cancelled_at)) {
                $stripe_secret_key = env('APP_ENV') == "local" ? env('STRIPE_KEY_TEST_SECRET') : env('STRIPE_KEY_SECRET');
                \Stripe\Stripe::setApiKey($stripe_secret_key);

                $subscription = \Stripe\Subscription::retrieve($this->stripe_customer->subscription_id);
                $subscription->cancel();

                $this->stripe_customer->cancelled_at = Carbon::now()->toDateTimeString();
                $this->stripe_customer->save();

                $get_params['success'] = "Success! Enrollment cancelled.";
            } else {
                $get_params['success'] = "Enrollment already cancelled.";
            }
        } else {
            $get_params['error'] = "Error: Unable to cancel subscription.";
        }

        // redirect back home
        return redirect()->route('home', $get_params);
    }

    protected function getAlertCenter() {
        try {
            $idcs_api = new IdcsApi(Auth::user());
            $response = $idcs_api->getAlertCenterReport();
            dd($response);
        } catch (IdcsApiException $e) {
            dd($e->getMessage());
        }
    }

}
