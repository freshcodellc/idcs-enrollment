<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CreditUrl extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'url', 'sale_id', 'kba_result'];

    /**
     * Get user's personalized credit URL
     *
     * @param  string  $url CreditUrl->url that will be personalized
     * @return string
     */
    public function getUrlAttribute($url)
    {
        if (empty($url)) {
            // no need for personalized credit URL if we don't have one
            return $url;
        }

        // append build credit URL params
        $params = [
            "kba" => 1, //
            "rsp" => route('kba'), // URL to redirect to after KBA
            "fn" => Auth::user()->first_name,
            "mn" => 'NA', // middle name, not collected right now but docs say to pass NA for a blank value
            "ln" => Auth::user()->last_name,
            "a1" => Auth::user()->address,
            "ct" => Auth::user()->city,
            "st" => Auth::user()->state,
            "zc" => Auth::user()->zip
        ];

        if ($this->kba_result == 1) {
            // unset the kba parameter, user should be good to view credit report
            unset($params['kba']);
            unset($params['rsp']);
        }

        $personalized_url = $url . "&" . http_build_query($params);

        return $personalized_url;
    }
}
