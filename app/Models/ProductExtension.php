<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductExtension extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'product_extension';

    /** @var string */
    protected $primaryKey = 'product_extension_id';

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'product_id',
        'shelf_height',
        'shelf_depth',
    ];

    /** @var string[] */
    protected $casts = [
        'product_extension_id' => 'integer',
        'product_id' => 'integer',
        'shelf_height' => 'decimal:2',
        'shelf_depth' => 'decimal:2',
    ];
}
