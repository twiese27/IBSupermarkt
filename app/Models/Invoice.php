<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'invoice';

    /** @var string */
    protected $primaryKey = 'invoice_id';

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'order_id',
        'tax_id',
        'issue_date',
    ];

    /** @var string[] */
    protected $casts = [
        'invoice_id' => 'integer',
        'order_id' => 'integer',
        'tax_id' => 'string',
        'issue_date' => 'date',
    ];
}
