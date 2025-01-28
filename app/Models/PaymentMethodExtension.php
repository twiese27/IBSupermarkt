<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethodExtension extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'payment_method_extension';

    /** @var string */
    protected $primaryKey = 'payment_method_extension_id';

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'payment_method_id',
    ];

    /** @var string[] */
    protected $casts = [
        'payment_method_extension_id' => 'integer',
        'payment_method_id' => 'integer',
    ];
}
