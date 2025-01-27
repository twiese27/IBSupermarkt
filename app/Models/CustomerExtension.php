<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerExtension extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'customer_extension';

    /** @var string */
    protected $primaryKey = 'customer_extension_id';

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'customer_id',
        'gender',
        'additional_delivery_address_information',
    ];

    /** @var string[] */
    protected $casts = [
        'customer_extension_id' => 'integer',
        'customer_id' => 'integer',
        'gender' => 'string',
    ];
}
