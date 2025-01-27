<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'employee';

    /** @var string */
    protected $primaryKey = 'employee_id';

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'house_number',
        'city',
        'postal_code',
        'country',
        'street',
        'lastname',
        'forename',
        'middle_name',
        'birth_date',
        'salary',
        'iban',
        'tax_class',
        'working_since',
        'warehouse_id',
        'role_id',
    ];

    /** @var string[] */
    protected $casts = [
        'employee_id' => 'integer',
        'salary' => 'decimal:2',
        'tax_class' => 'integer',
        'working_since' => 'date',
        'birth_date' => 'date',
        'warehouse_id' => 'integer',
        'role_id' => 'integer',
        'iban' => 'string',
        'house_number' => 'string',
        'city' => 'string',
        'postal_code' => 'string',
        'country' => 'string',
        'street' => 'string',
        'lastname' => 'string',
        'forename' => 'string',
        'middle_name' => 'string',
    ];
}
