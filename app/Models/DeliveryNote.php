<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryNote extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'delivery_note';

    /** @var string */
    protected $primaryKey = 'delivery_id';

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'order_id',
        'issue_time',
        'arrival_time',
        'pick_up_time',
        'shipping_cost',
    ];

    /** @var string[] */
    protected $casts = [
        'delivery_id' => 'integer',
        'order_id' => 'integer',
        'issue_time' => 'datetime',
        'arrival_time' => 'datetime',
        'pick_up_time' => 'datetime',
        'shipping_cost' => 'float',
    ];
}
