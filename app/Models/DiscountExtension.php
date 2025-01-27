<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountExtension extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'discount_extension';

    /** @var string */
    protected $primaryKey = 'discount_extension_id';

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'discount_id',
        'point_of_sale_id',
    ];

    /** @var string[] */
    protected $casts = [
        'discount_extension_id' => 'integer',
        'discount_id' => 'integer',
        'point_of_sale_id' => 'integer',
    ];
}
