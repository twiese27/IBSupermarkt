<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductToWarehouse extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'product_to_warehouse';

    /** @var string */
    protected $primaryKey = null; // Keine eigene ID, weil es sich um eine Verknüpfung handelt

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'product_id',
        'warehouse_id',
        'stock',
        'storage_location',
    ];

    /** @var string[] */
    protected $casts = [
        'product_id' => 'integer',
        'warehouse_id' => 'integer',
        'stock' => 'integer',
        'storage_location' => 'string',
    ];
}
