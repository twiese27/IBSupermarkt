<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'warehouse';

    /** @var string */
    protected $primaryKey = 'warehouse_id';

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'warehouse_id',
        'street',
        'city',
        'country',
        'postal_code',
        'house_number',
        'capacity',
    ];

    /** @var string[] */
    protected $casts = [
        'warehouse_id' => 'integer',
        'capacity' => 'integer',
    ];
}
