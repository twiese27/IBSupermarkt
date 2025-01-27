<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointOfSale extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'point_of_sale';

    /** @var string */
    protected $primaryKey = 'point_of_sale_id';

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'type',
        'is_a_physical_store',
        'postal_code',
        'city',
        'country',
        'street',
        'place_of_sale_name',
        'house_number',
        'additional_address_information',
    ];

    /** @var string[] */
    protected $casts = [
        'point_of_sale_id' => 'integer',
        'is_a_physical_store' => 'boolean',
        'postal_code' => 'string',
        'city' => 'string',
        'country' => 'string',
        'street' => 'string',
        'place_of_sale_name' => 'string',
        'house_number' => 'string',
        'additional_address_information' => 'string',
    ];
}
