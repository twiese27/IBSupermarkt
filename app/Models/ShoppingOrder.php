<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingOrder extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'shopping_order';

    /** @var string */
    protected $primaryKey = 'order_id';

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'status',
        'order_time',
        'shopping_cart_id',
        'employee_id',
        'delivery_service_id',
        'total_price',
    ];

    /** @var string[] */
    protected $casts = [
        'order_id' => 'integer',
        'order_time' => 'datetime',  // Um den Timestamp korrekt zu behandeln
        'shopping_cart_id' => 'integer',
        'employee_id' => 'integer',
        'delivery_service_id' => 'integer',
        'total_price' => 'decimal:2',  // Der Gesamtpreis mit 2 Dezimalstellen
    ];

    public function shoppingCart() {
        return $this->belongsTo(ShoppingCart::class, 'SHOPPING_CART_ID', 'SHOPPING_CART_ID');
    }
}
