<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseExtension extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'warehouse_extension';

    /** @var string */
    protected $primaryKey = 'warehouse_extension_id';

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'warehouse_extension_id',
        'warehouse_id',
        'point_of_sale_id',
    ];

    /** @var string[] */
    protected $casts = [
        'warehouse_extension_id' => 'integer',
        'warehouse_id' => 'integer',
        'point_of_sale_id' => 'integer',
    ];
}
