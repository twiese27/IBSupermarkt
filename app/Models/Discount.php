<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    const TABLE = 'DISCOUNT';
    const DISCOUNT_ID = 'DISCOUNT_ID';
    const PERCENTAGE = 'PERCENTAGE';
    const CODE = 'CODE';

    /** @var string */
    protected $table = 'discount';

    /** @var bool */
    public $incrementing = false;

    /** @var string */
    protected $primaryKey = 'discount_id';

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'discount_id',
        'percentage',
        'code',
    ];

    /** @var string[] */
    protected $casts = [
        'discount_id' => 'integer',
        'percentage' => 'decimal:2',
        'code' => 'string',
    ];
}
