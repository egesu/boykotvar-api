<?php

namespace App\Model;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Support\Facades\Hash as Hash;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'updated_at',
        'created_at',
    ];

    public static function login($email, $password)
    {
        $user = self::where('email', $email)->first();
        if(Hash::check($password, $user->password)) {
            $token = self::generateToken();
            $user->auth_token = $token;
            $user->save();
            return $token;
        } else {
            return false;
        }
    }

    public static function forceLogin($userId)
    {
        $user = self::find($userId);
        $token = self::generateToken();
        $user->auth_token = $token;
        $user->save();
        return $token;
    }

    public function logout()
    {
        $this->auth_token = null;
        $this->save();
        return $this;
    }

    public static function generateToken()
    {
        return str_random(40);
    }

    protected function setPasswordAttribute($password) {
        $this->attributes['password'] = Hash::make($password);
    }
}
