<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class LoginHistory
 * @package App\Models
 * @property integer user_id
 * @property string ip
 * @property string os
 * @property string device
 * @property string browser
 * @property string lat
 * @property string lng
 * @property string logout_at
 * @property boolean is_active
 * @property User user
 */
class LoginHistory extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'id','user_id', 'ip', 'os', 'device', 'browser', 'lat', 'lng','logout_at','is_active'
  ];

 public function user(): HasOne
  {
    return $this->hasOne(User::class,  'user_id');
  }

}
