<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerRecommendation extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'customer_recommendation';

    /** @var string */
    protected $primaryKey = 'customer_recommendation_id';

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'customer_recommendation_id',
        'customer_id',
        'suggested_product_id',
    ];

    /** @var string[] */
    protected $casts = [
        'customer_recommendation_id' => 'integer',
        'customer_id' => 'integer',
        'suggested_product_id' => 'integer',
    ];
}
