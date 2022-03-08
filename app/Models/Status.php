<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Status
 * @package App\Models
 * @property integer type_id
 * @property string name
 * @property string|null class
 */

class Status extends Model
{
    use HasFactory;

    public const TYPE_PAYMENT=1;
    public const TYPE_ORDER=2;



    public const PaymentPaid=1;
    public const PaymentUnpaid=2;

    public const OrderPending=4;
    public const OrderDelivered=8;

    public $timestamps = false;

    public static function payment(){
      return self::where('type_id', self::TYPE_PAYMENT)->get();
    }

    public static function order(){
        return self::where('type_id', self::TYPE_ORDER)->get();
    }

}
