<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class POSToSupplierExtension extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'pos_to_supplier_extension';

    /** @var string */
    protected $primaryKey = null; // Keine eigene ID, weil es sich um eine Verknüpfung handelt

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'supplier_extension_id',
        'supplier_id',
        'point_of_sale_id',
    ];

    /** @var string[] */
    protected $casts = [
        'supplier_extension_id' => 'integer',
        'supplier_id' => 'integer',
        'point_of_sale_id' => 'integer',
    ];
}
