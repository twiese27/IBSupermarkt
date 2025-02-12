<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supervision extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'supervision';

    /** @var string */
    protected $primaryKey = 'supervision_id';

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'employee_id',
        'supervisor_id',
        'supervision_id',
    ];

    /** @var string[] */
    protected $casts = [
        'employee_id' => 'integer',
        'supervisor_id' => 'integer',
        'supervision_id' => 'integer',
    ];
}
