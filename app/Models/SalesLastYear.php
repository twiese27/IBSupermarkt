<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesLastYear extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'Sales_Last_Year';

    /** @var string */
    protected $primaryKey = 'SALES_LAST_YEAR_ID';

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
