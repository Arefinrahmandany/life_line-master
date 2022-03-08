<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Class Category
 * @package App\Models
 * @property integer id
 * @property integer shop_type_id
 * @property integer type_id
 * @property string name
 * @property string|null slug
 * @property string|null image
 * @property string|null icon
 * @property string|null description
 * @property boolean is_active
 * @property CategoryType category_type
 */
class Category extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['id','shop_type_id','type_id','name','slug','image','icon','description','is_active','order'];

    public function shop_type(): BelongsTo
    {
        return $this->belongsTo(ShopType::class,'shop_type_id');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(CategoryType::class);
    }

    public static function getProductCategories(): Collection
    {
        return DB::table('categories')->where('type_id',CategoryType::PRODUCT)->get();
    }

    protected $dates = ['deleted_at'];

}
