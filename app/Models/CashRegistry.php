<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashRegistry extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'cash_registry';

    /** @var string */
    protected $primaryKey = 'cash_registry_id';

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'point_of_sale_id',
    ];

    /** @var string[] */
    protected $casts = [
        'cash_registry_id' => 'integer',
        'point_of_sale_id' => 'integer',
    ];
}
