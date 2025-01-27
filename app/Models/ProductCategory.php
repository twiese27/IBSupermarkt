<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'product_category';

    /** @var string */
    protected $primaryKey = 'product_category_id';

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
        'parent_category' => 'integer', // Falls es eine Null oder eine ID ist
    ];
}
