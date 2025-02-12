<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierExtension extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'supplier_extension';

    /** @var string */
    protected $primaryKey = 'supplier_extension_id';

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'supplier_extension_id',
        'supplier_id',
        'address_type',
        'additional_address_information',
    ];

    /** @var string[] */
    protected $casts = [
        'supplier_extension_id' => 'integer',
        'supplier_id' => 'integer',
        'address_type' => 'string',
        'additional_address_information' => 'string',
    ];
}
