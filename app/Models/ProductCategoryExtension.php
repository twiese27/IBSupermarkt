<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategoryExtension extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'product_category_extension';

    /** @var string */
    protected $primaryKey = 'product_category_extension_id';

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'product_category_id',
    ];

    /** @var string[] */
    protected $casts = [
        'product_category_extension_id' => 'integer',
        'product_category_id' => 'integer',
    ];
}
