<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class UserType
 * @package App\Models
 * @property string name
 */
class UserType extends Model
{
    use HasFactory;

    public $timestamps = false;

    public const SUPER_ADMIN = 1;
    public const ADMIN =  2;
    public const DEALER_FRANCHISEE_USER = 3;
    public const AGENT_CUSTOMER_USER = 4;

}
