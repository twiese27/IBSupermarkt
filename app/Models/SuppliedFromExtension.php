<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuppliedFromExtension extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'supplied_from_extension';

    /** @var string */
    protected $primaryKey = 'batch_id';

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'batch_id',
        'number_of_cases',
        'weight',
        'manufactoring_date',
        'bbd',
        'order_date',
        'delivery_date',
        'supplier_order_price',
        'supplier_order_id',
        'point_of_sale_id',
    ];

    /** @var string[] */
    protected $casts = [
        'batch_id' => 'integer',
        'number_of_cases' => 'integer',
        'weight' => 'decimal:2', // Das Gewicht mit 2 Dezimalstellen
        'manufactoring_date' => 'date',
        'bbd' => 'date',  // Ablaufdatum (Best Before Date)
        'order_date' => 'date',
        'delivery_date' => 'date',
        'supplier_order_price' => 'decimal:2', // Der Bestellpreis des Lieferanten mit 2 Dezimalstellen
        'supplier_order_id' => 'integer',
        'point_of_sale_id' => 'integer',
    ];
}
