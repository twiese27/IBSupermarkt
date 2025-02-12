<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class POSToCustomerBillingAddress extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'pos_to_customer_billing_address';

    /** @var string */
    protected $primaryKey = null; // Keine eigene ID, weil es sich um eine Verknüpfung handelt

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'point_of_sale_id',
        'customer_billing_address_id',
    ];

    /** @var string[] */
    protected $casts = [
        'point_of_sale_id' => 'integer',
        'customer_billing_address_id' => 'integer',
    ];
}
