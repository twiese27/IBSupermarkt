<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesAllTime extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'sales_all_time';

    /** @var string */
    protected $primaryKey = 'Sales_All_Time_ID';

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'PRODUCT_ID',
        'SALES',
        'PRODUCT_CATEGORY_ID'
    ];

    /** @var string[] */
    protected $casts = [
        'PRODUCT_ID' => 'integer',
        'SALES' => 'integer',
        'PRODUCT_CATEGORY_ID' => 'integer'
    ];
}
