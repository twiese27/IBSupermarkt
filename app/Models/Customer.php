<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'customer';

    /** @var string */
    protected $primaryKey = 'customer_id';

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'street',
        'house_number',
        'postal_code',
        'city',
        'middle_name',
        'lastname',
        'iban',
        'birth_date',
        'created_on',
        'email',
        'country',
        'forename',
    ];

    /** @var string[] */
    protected $casts = [
        'customer_id' => 'integer',
        'postal_code' => 'string',
        'birth_date' => 'date',
        'created_on' => 'date',
    ];
}
