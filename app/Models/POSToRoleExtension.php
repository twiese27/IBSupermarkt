<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class POSToRoleExtension extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'pos_to_role_extension';

    /** @var string */
    protected $primaryKey = null; // Keine eigene ID, weil es sich um eine Verknüpfung handelt

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'point_of_sale_id',
        'role_extension_id',
        'role_id',
    ];

    /** @var string[] */
    protected $casts = [
        'point_of_sale_id' => 'integer',
        'role_extension_id' => 'integer',
        'role_id' => 'integer',
    ];
}
