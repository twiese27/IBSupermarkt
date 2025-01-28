<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'role';

    /** @var string */
    protected $primaryKey = 'role_id';

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'name',
        'is_admin',
    ];

    /** @var string[] */
    protected $casts = [
        'role_id' => 'integer',
        'is_admin' => 'boolean', // Um "is_admin" als boolean zu behandeln
    ];
}
