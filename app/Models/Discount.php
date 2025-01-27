<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'discount';

    /** @var string */
    protected $primaryKey = 'discount_id';

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
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
