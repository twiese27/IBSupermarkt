<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentExtension extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'payment_extension';

    /** @var string */
    protected $primaryKey = 'payment_extension_id';

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'payment_id',
        'transaction_number',
        'point_of_sale_id',
    ];

    /** @var string[] */
    protected $casts = [
        'payment_extension_id' => 'integer',
        'payment_id' => 'integer',
        'transaction_number' => 'integer',
        'point_of_sale_id' => 'integer',
    ];
}
