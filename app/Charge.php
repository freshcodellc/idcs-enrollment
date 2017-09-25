<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'credit_url_id', 'stripe_id', 'amount'];
}
