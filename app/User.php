<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use App\Notifications\ResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','first_name','family_name', 'email', 'password', 'phone', 'mobile1', 'mobile2','api_token',
        'nationality','address','id_type','id_no','id_issuer','id_issued_date','id_exp_date','id_image',
        'bank','bank_iban','registered','lang','avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token) {
        $this->notify(new ResetPassword($token));
    }
}
