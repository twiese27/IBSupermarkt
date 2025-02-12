<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class POSToEmployeeExtension extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'pos_to_employee_extension';

    /** @var string */
    protected $primaryKey = null; // Keine eigene ID, weil es sich um eine Verknüpfung handelt

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'employee_extension_id',
        'employee_id',
        'point_of_sale_id',
    ];

    /** @var string[] */
    protected $casts = [
        'employee_extension_id' => 'integer',
        'employee_id' => 'integer',
        'point_of_sale_id' => 'integer',
    ];
}
