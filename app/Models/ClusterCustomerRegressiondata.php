<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClusterCustomerRegressionData extends Model
{
    use HasFactory;

    protected $table = 'CLUSTER_CUSTOMER_REGRESSIONDATA';
    protected $primaryKey = 'CUSTOMER_ID';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'CUSTOMER_ID',
        'CUSTOMER_NAME',
        'PURCHASE_FREQUENCY',
        'TOTAL_REVENUE',
        'AVG_CART_VALUE',
        'AGE',
        'CLUSTER_CUSTOMER_ID',
        'CLUSTER_PROBABILITY',
        'CLUSTER_DISTANCE',
    ];
}
