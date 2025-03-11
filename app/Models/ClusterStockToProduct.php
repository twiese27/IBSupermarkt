<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClusterStockToProduct extends Model
{
    use HasFactory;

    protected $table = 'CLUSTER_STOCK_TO_PRODUCT';
    protected $primaryKey = 'PRODUCT_ID';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'PRODUCT_ID',
        'TOTAL_SALES',
        'TOTAL_STOCK',
        'CLUSTER_STOCK_ID',
        'CLUSTER_PROBABILITY',
        'CLUSTER_DISTANCE',
        
    ];
}
