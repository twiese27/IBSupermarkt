<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int product_category_id
 * @property string name
 * @property int parent_category
 */
class ProductCategory extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'PRODUCT_CATEGORY';

    /** @var string */
    protected $primaryKey = 'PRODUCT_CATEGORY_ID';

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'name',
        'parent_category',
    ];

    /** @var string[] */
    protected $casts = [
        'product_category_id' => 'integer',
        'parent_category' => 'integer',
    ];
}
