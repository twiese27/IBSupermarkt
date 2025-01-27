<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeExtension extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'employee_extension';

    /** @var string */
    protected $primaryKey = 'employee_extension_id';

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'employee_id',
        'bank_name',
        'bic',
        'working_hours_per_week',
        'provision_rate',
        'additional_address_information',
        'address_type',
        'gender',
        'phone_number',
        'email',
    ];

    /** @var string[] */
    protected $casts = [
        'employee_extension_id' => 'integer',
        'employee_id' => 'integer',
        'working_hours_per_week' => 'integer',
        'provision_rate' => 'decimal:2',
        'bank_name' => 'string',
        'bic' => 'string',
        'additional_address_information' => 'string',
        'address_type' => 'string',
        'gender' => 'string',
        'phone_number' => 'string',
        'email' => 'string',
    ];
}
