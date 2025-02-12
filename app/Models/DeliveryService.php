<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryService extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'delivery_service';

    /** @var string */
    protected $primaryKey = 'delivery_service_id';

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'city',
        'street',
        'country',
        'postal_code',
        'house_number',
        'name',
        'phone_number',
        'iban',
        'contact_person',
    ];

    /** @var string[] */
    protected $casts = [
        'delivery_service_id' => 'integer',
        'postal_code' => 'string',
        'phone_number' => 'string',
        'iban' => 'string',
    ];
}
