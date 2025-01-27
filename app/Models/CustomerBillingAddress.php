<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerBillingAddress extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'customer_billing_address';

    /** @var string */
    protected $primaryKey = 'customer_billing_address_id';

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'street',
        'city',
        'house_number',
        'country',
        'postal_code',
        'additional_address_information',
        'customer_id',
    ];

    /** @var string[] */
    protected $casts = [
        'customer_billing_address_id' => 'integer',
        'customer_id' => 'integer',
        'postal_code' => 'string',
    ];
}
