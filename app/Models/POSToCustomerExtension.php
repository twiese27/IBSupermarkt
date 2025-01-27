<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class POSToCustomerExtension extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'pos_to_customer_extension';

    /** @var string */
    protected $primaryKey = null; // Keine eigene ID, weil es sich um eine Verknüpfung handelt

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'customer_extension_id',
        'customer_id',
        'point_of_sale_id',
    ];

    /** @var string[] */
    protected $casts = [
        'customer_extension_id' => 'integer',
        'customer_id' => 'integer',
        'point_of_sale_id' => 'integer',
    ];
}
