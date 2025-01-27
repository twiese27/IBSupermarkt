<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class POSToPaymentMethodExtension extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'pos_to_payment_method_extension';

    /** @var string */
    protected $primaryKey = null; // Keine eigene ID, weil es sich um eine Verknüpfung handelt

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'payment_method_extension_id',
        'payment_method_id',
        'point_of_sale_id',
    ];

    /** @var string[] */
    protected $casts = [
        'payment_method_extension_id' => 'integer',
        'payment_method_id' => 'integer',
        'point_of_sale_id' => 'integer',
    ];
}
