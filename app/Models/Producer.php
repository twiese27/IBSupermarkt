<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producer extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'producer';

    /** @var string */
    protected $primaryKey = 'producer_id';

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'postal_code',
        'street',
        'city',
        'house_number',
        'name',
        'country',
    ];

    /** @var string[] */
    protected $casts = [
        'producer_id' => 'integer',
        'postal_code' => 'string',
        'house_number' => 'string',
        'city' => 'string',
        'country' => 'string',
    ];
}
