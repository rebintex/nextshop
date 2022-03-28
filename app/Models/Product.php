<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="Product",
 *      required={"name", "price", "brand_id"},
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="price",
 *          description="price",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="brand_id",
 *          description="brand_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class Product extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'products';


    protected $dates = ['deleted_at'];

    //public $incrementing = false;

    public $fillable = [
        'name',
        'price',
        'brand_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'price' => 'integer',
        'brand_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:50',
        'price' => 'required|numeric|gt:0',
        'brand_id' => 'required|exists:brands,id'
    ];

    public function orderProducts() {
        return $this->hasMany(OrderProduct::class);
    }

    public function shoppingCarts() {
        return $this->hasMany(ShoppingCart::class);
    }

    public function favourites() {
        return $this->hasMany(Favourite::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    public function featureValues() {
        return $this->belongsToMany(FeatureValues::class, 'feature_value_product', 'product_id','feature_value_id');
    }

    public function categories() {
        return $this->belongsToMany(Category::class);
    }

    public function comments() {
        return $this->morphMany(Comment::class, 'owner');
    }

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function orders() {
        return $this->belongsToMany(Order::class);
    }
}
