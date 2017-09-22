<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreditUrl extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'url'];
}
