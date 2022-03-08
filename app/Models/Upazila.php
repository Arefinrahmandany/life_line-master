<?php

namespace App\Models;

/**
 * Class Upazila
 * @package App
 * @property int id
 * @property int district_id
 * @property string name
 * @property string name_bn
 * @property float lat
 * @property float lng
 */
class Upazila extends Model
{
    public $timestamps = false;

    protected $fillable = ['id', 'district_id', 'name', 'name_bn', 'lat', 'lng'];
}
