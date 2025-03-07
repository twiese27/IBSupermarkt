<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    const TABLE = 'CUSTOMER';
    const CUSTOMER_ID = 'CUSTOMER_ID';
    const STREET = 'STREET';
    const HOUSE_NUMBER = 'HOUSE_NUMBER';
    const POSTAL_CODE = 'POSTAL_CODE';
    const CITY = 'CITY';
    const MIDDLE_NAME = 'MIDDLE_NAME';
    const LASTNAME = 'LASTNAME';
    const IBAN = 'IBAN';
    const BIRTH_DATE = 'BIRTH_DATE';
    const CREATED_ON = 'CREATED_ON';
    const EMAIL = 'EMAIL';
    const COUNTRY = 'COUNTRY';
    const FORENAME = 'FORENAME';

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
