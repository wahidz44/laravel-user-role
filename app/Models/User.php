<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    protected static $user;
    protected static function newUser($request, $userType = null)
    {
        self::$user                 =new User();
        self::$user->name           =$request->name;
        self::$user->email          =$request->email;
        self::$user->password       =bcrypt($request->password);

        if (isset($userType))
        {
            self::$user->user_type  =$userType;
        }
        if (Auth()->user()->user_type == 1)
        {
            self::$user->merchant_id =Auth()->user()->id;
        }
        if (Auth()->user()->user_type == 2)
        {
            self::$user->merchant_id    =Auth()->user()->merchant_id;
            self::$user->officer_id     =Auth()->user()->id;
        }

        self::$user->save();
    }
}
