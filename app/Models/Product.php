<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'product';

    /** @var string */
    protected $primaryKey = 'product_id';

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'cases_per_pallet',
        'units_per_case',
        'product_name',
        'srp',
        'recyclable_package',
        'low_fat',
        'retail_price',
        'gross_weight',
        'shelf_width',
        'producer_id',
        'sku',
        'product_category_id',
        'net_weight',
    ];

    /** @var string[] */
    protected $casts = [
        'product_id' => 'integer',
        'cases_per_pallet' => 'integer',
        'units_per_case' => 'integer',
        'srp' => 'decimal:2',
        'recyclable_package' => 'boolean',
        'low_fat' => 'boolean',
        'retail_price' => 'decimal:2',
        'gross_weight' => 'decimal:3',
        'shelf_width' => 'decimal:2',
        'producer_id' => 'integer',
        'sku' => 'integer',
        'product_category_id' => 'integer',
        'net_weight' => 'decimal:2',
    ];
    public function producer() {
        return $this->belongsTo(Producer::class, 'producer_id');
    }
    
    public function productCategory() {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }
    
}
