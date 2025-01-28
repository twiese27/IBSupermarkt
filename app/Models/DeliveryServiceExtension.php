<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryServiceExtension extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'delivery_service_extension';

    /** @var string */
    protected $primaryKey = 'delivery_service_extension_id';

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'delivery_service_id',
        'point_of_sale_id',
    ];

    /** @var string[] */
    protected $casts = [
        'delivery_service_extension_id' => 'integer',
        'delivery_service_id' => 'integer',
        'point_of_sale_id' => 'integer',
    ];
}
