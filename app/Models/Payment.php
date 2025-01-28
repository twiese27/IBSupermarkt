<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'payment';

    /** @var string */
    protected $primaryKey = 'payment_id';

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'payment_date',
        'cash_flow',
        'supplier_id',
        'order_id',
        'employee_id',
        'warehouse_id',
        'payment_method_id',
    ];

    /** @var string[] */
    protected $casts = [
        'payment_id' => 'integer',
        'cash_flow' => 'decimal:2',
        'supplier_id' => 'integer',
        'order_id' => 'integer',
        'employee_id' => 'integer',
        'warehouse_id' => 'integer',
        'payment_method_id' => 'integer',
        'payment_date' => 'date',
    ];
}
