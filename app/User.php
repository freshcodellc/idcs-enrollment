<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'username', 'password', 'address', 'city',
        'state', 'zip', 'phone', 'eventcode', 'uuid', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Check if user belongs to a role
     *
     * @param string|array $role
     * @return bool
     */
    public function role($role) {
        $role = (array)$role;
        return in_array($this->role, $role);
    }

    /**
     * Get the phone record associated with the user.
     */
    public function credit_url()
    {
        return $this->hasOne('App\CreditUrl');
    }
}
