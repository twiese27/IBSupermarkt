<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCartExtension extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'shopping_cart_extension';

    /** @var string */
    protected $primaryKey = 'shopping_cart_extension_id';

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'shopping_cart_id',
        'point_of_sale_id',
    ];

    /** @var string[] */
    protected $casts = [
        'shopping_cart_extension_id' => 'integer',
        'shopping_cart_id' => 'integer',
        'point_of_sale_id' => 'integer',
    ];
}
