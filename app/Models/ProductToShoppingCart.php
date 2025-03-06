<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductToShoppingCart extends Model
{
    use HasFactory;

    const TABLE = 'PRODUCT_TO_SHOPPING_CART';
    const PRODUCT_ID = 'PRODUCT_ID';
    const SHOPPING_CART_ID = 'SHOPPING_CART_ID';
    const TOTAL_AMOUNT = 'TOTAL_AMOUNT';

    /** @var string */
    protected $table = 'product_to_shopping_cart';

    /** @var string */
    protected $primaryKey = null; // Keine eigene ID, weil es sich um eine Verknüpfung handelt

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'product_id',
        'shopping_cart_id',
        'total_amount',
    ];

    /** @var string[] */
    protected $casts = [
        'product_id' => 'integer',
        'shopping_cart_id' => 'integer',
        'total_amount' => 'integer',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
