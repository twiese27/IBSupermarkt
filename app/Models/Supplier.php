<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'supplier';

    /** @var string */
    protected $primaryKey = 'supplier_id';

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'supplier_id',
        'house_number',
        'city',
        'postal_code',
        'street',
        'country',
        'name',
        'iban',
        'phone_number',
        'contact_person',
        'contact_person_email',
    ];

    /** @var string[] */
    protected $casts = [
        'supplier_id' => 'integer',
        'phone_number' => 'string',
        'iban' => 'string',
    ];
}
