<?php

namespace App\Models;

use App\Traits\PasswordResetTrait;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 * @package App\Models
 * @property int id
 * @property string name
 * @property integer type_id
 * @property string userid
 * @property string phone
 * @property string|null photo_uri
 * @property string|null verify_code
 * @property string|null phone_verified_at
 * @property string|null email
 * @property string|null email_verified_at
 * @property string password
 * @property boolean is_active
 * @property boolean is_two_factor_auth
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable, PasswordResetTrait, SoftDeletes;

    public function appendsRules($logic)
    {
        if($this->type_id===UserType::AGENT_CUSTOMER_USER)
        {
            return $logic;
        }
        return null;
    }
    /**
     * @return HasOne
     */
    public function password_reset(): HasOne
    {
        return $this->hasOne(PasswordReset::class);
    }
    public function type(): BelongsTo
    {
        return $this->belongsTo(UserType::class,'type_id');
    }

//    public function getCartTotalAmountAttribute(): int
//    {
//        return $this->carts()->sum(DB::raw('price * quantity'));
//    }

    public function tow_factor_auth(): HasOne
    {
        return $this->hasOne(TwoFactorAuth::class,'user_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type_id',
        'userid',
        'phone',
        'email',
        'photo_uri',
        'verify_code',
        'phone_verified_at',
        'password',
        'is_active',
        'is_two_factor_auth',
        'last_active_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public static $rules = [
        'name' => 'required|string|max:255',
        'phone' => 'required|numeric',
        'email' => 'string|email|max:255',
        'password' => 'required|string|min:6|confirmed',
    ];

    /**
     * @return User|null
     */
    public static function current(): ?User
    {
        return request()->user();
    }

}
