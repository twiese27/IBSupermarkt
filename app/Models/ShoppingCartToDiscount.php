<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCartToDiscount extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'shopping_cart_to_discount';

    /** @var string */
    protected $primaryKey = 'shopping_cart_id'; // Hier könnte auch eine andere Logik verwendet werden, wenn es keinen eigenen Primärschlüssel gibt

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'shopping_cart_id',
        'discount_id',
    ];

    /** @var string[] */
    protected $casts = [
        'shopping_cart_id' => 'integer',
        'discount_id' => 'integer',
    ];
}
