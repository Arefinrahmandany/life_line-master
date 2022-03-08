<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Settings
 * @package App\Models
 * @property string name
 * @property string value
 */

class Settings extends Model
{
    use HasFactory;
    protected $fillable = ['name','value'];

    public const ADMINLOGINURL = 1;
    public const TwoFactorAuthentication = 2;
    public const ADMINER_ID = 3;

    public const TwoFactorAuthenticationEnabledValue = 'enabled';

}
