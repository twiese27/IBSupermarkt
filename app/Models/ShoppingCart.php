<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'shopping_cart';

    /** @var string */
    protected $primaryKey = 'shopping_cart_id';

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'deleted_on',
        'created_on',
        'amount_of_products',
        'customer_id',
    ];

    /** @var string[] */
    protected $casts = [
        'shopping_cart_id' => 'integer',
        'deleted_on' => 'datetime',
        'created_on' => 'datetime',
        'amount_of_products' => 'integer',
        'customer_id' => 'integer',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_to_shopping_cart', 'SHOPPING_CART_ID', 'PRODUCT_ID')
            ->withPivot('TOTAL_AMOUNT');
    }
}
