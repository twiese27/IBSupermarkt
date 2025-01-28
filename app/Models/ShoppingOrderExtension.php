<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingOrderExtension extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'shopping_order_extension';

    /** @var string */
    protected $primaryKey = 'shopping_order_extension_id';

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'order_id',
        'net_purchase_price',
        'point_of_sale_id',
        'cash_registry_id',
    ];

    /** @var string[] */
    protected $casts = [
        'shopping_order_extension_id' => 'integer',
        'order_id' => 'integer',
        'net_purchase_price' => 'decimal:2', // Um den Nettokaufpreis mit 2 Dezimalstellen zu speichern
        'point_of_sale_id' => 'integer',
        'cash_registry_id' => 'integer',
    ];
}
