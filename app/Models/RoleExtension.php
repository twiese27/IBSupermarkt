<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleExtension extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'role_extension';

    /** @var string */
    protected $primaryKey = 'role_extension_id';

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'role_id',
    ];

    /** @var string[] */
    protected $casts = [
        'role_extension_id' => 'integer',
        'role_id' => 'integer',
    ];
}
