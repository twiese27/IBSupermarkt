<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductToSupplierToSuppliedFromExtension extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'product_to_supplier_to_supplied_from_extension';

    /** @var string */
    protected $primaryKey = null; // Keine eigene ID, weil es sich um eine Verknüpfung handelt

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'product_id',
        'supplier_id',
        'batch_id',
        'purchase_price',
    ];

    /** @var string[] */
    protected $casts = [
        'product_id' => 'integer',
        'supplier_id' => 'integer',
        'batch_id' => 'integer',
        'purchase_price' => 'decimal:2', // Falls es sich um einen Preis handelt
    ];
}
