<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'payment_method';

    /** @var string */
    protected $primaryKey = 'payment_method_id';

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'name',
    ];

    /** @var string[] */
    protected $casts = [
        'payment_method_id' => 'integer',
        'name' => 'string',
    ];
}
