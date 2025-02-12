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
    protected $primaryKey = 'customer_id'; // Primärschlüssel der Tabelle

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'customer_id',
        'forename',
        'middle_name',
        'lastname',
        'street',
        'house_number',
        'postal_code',
        'city',
        'country',
        'email',
        'iban',
        'birth_date',
        'created_on',
    ];

    /** @var string[] */
    protected $casts = [
        'birth_date' => 'string',
    ];

    public function getBirthDateAttribute($value)
    {
        // Format the date and return the custom string
        return "TO_DATE('{$value}', 'DD.MM.YYYY')";
    }
}
