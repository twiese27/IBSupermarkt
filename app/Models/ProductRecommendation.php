<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRecommendation extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'product_recommendation';

    /** @var string */
    protected $primaryKey = 'product_recommendation_id';

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'product_recommendation_id',
        'antecedent_id',
        'consequent_id',
        'recommendation_score',
    ];
    /** @var string[] */
    protected $casts = [
        'product_recommendation_id' => 'integer',
        'antecedent_id' => 'integer',
        'consequent_id' => 'integer',
        'recommendation_score' => 'decimal:2',
    ];    
}
