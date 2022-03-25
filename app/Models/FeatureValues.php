<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="FeatureValues",
 *      required={"feature_id"},
 *      @SWG\Property(
 *          property="feature_id",
 *          description="feature_id",
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
class FeatureValues extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'feature_values';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'feature_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'feature_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'feature_id' => 'required|exists:features,id'
    ];

    public function feature() {
        return $this->belongsTo(Features::class);
    }


}
