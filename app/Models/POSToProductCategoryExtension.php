<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class POSToProductCategoryExtension extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'pos_to_product_category_extension';

    /** @var string */
    protected $primaryKey = null; // Keine eigene ID, weil es sich um eine Verknüpfung handelt

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'product_category_extension_id',
        'product_category_id',
        'point_of_sale_id',
    ];

    /** @var string[] */
    protected $casts = [
        'product_category_extension_id' => 'integer',
        'product_category_id' => 'integer',
        'point_of_sale_id' => 'integer',
    ];
}
