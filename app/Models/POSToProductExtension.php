<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class POSToProductExtension extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'pos_to_product_extension';

    /** @var string */
    protected $primaryKey = null; // Keine eigene ID, weil es sich um eine Verknüpfung handelt

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'point_of_sale_id',
        'product_extension_id',
        'product_id',
        'is_being_sold',
        'min_age_requirement',
    ];

    /** @var string[] */
    protected $casts = [
        'point_of_sale_id' => 'integer',
        'product_extension_id' => 'integer',
        'product_id' => 'integer',
        'is_being_sold' => 'string', // CHAR wird als string behandelt
        'min_age_requirement' => 'integer',
    ];
}
