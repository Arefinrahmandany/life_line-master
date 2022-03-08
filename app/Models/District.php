<?php

namespace App\Models;

/**
 * Class District
 * @package App
 * @property int id
 * @property string name
 * @property string name_bn
 * @property float lat
 * @property float lng
 */
class District extends Model
{
    public $timestamps = false;

    protected $fillable = ['id', 'name', 'name_bn', 'lat', 'lng'];
}
