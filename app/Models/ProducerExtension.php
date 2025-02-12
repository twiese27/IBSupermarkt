<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProducerExtension extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'producer_extension';

    /** @var string */
    protected $primaryKey = 'producer_extension_id';

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'producer_id',
    ];

    /** @var string[] */
    protected $casts = [
        'producer_extension_id' => 'integer',
        'producer_id' => 'integer',
    ];
}
