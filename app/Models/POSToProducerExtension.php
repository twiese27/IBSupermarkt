<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class POSToProducerExtension extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'pos_to_producer_extension';

    /** @var string */
    protected $primaryKey = null; // Keine eigene ID, weil es sich um eine Verknüpfung handelt

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'producer_extension_id',
        'producer_id',
        'point_of_sale_id',
    ];

    /** @var string[] */
    protected $casts = [
        'producer_extension_id' => 'integer',
        'producer_id' => 'integer',
        'point_of_sale_id' => 'integer',
    ];
}
