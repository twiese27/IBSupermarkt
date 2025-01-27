<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesPriceConditionSet extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'sales_price_condition_set';

    /** @var string */
    protected $primaryKey = 'sales_price_condition_set_id';

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'start_date',
        'end_date',
        'vat_rate',
        'netto_price',
        'product_id',
        'point_of_sale_id',
    ];

    /** @var string[] */
    protected $casts = [
        'sales_price_condition_set_id' => 'integer',
        'vat_rate' => 'decimal:2',  // Um die Mehrwertsteuer mit 2 Dezimalstellen zu behandeln
        'netto_price' => 'decimal:2',  // Netto-Preis ebenfalls mit 2 Dezimalstellen
        'product_id' => 'integer',
        'point_of_sale_id' => 'integer',
    ];
}
