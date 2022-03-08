<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * Class TwoFactorAuth
 * @package App\Models
 * @property integer user_id
 * @property integer login_history_id
 * @property string code
 * @property string expires_at
 */

class TwoFactorAuth extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','login_history_id','code','expires_at'];
}
