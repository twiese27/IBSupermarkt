<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssociationRuleCat extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'association_rule_category';

    /** @var string */
    protected $primaryKey = 'association_rule_category_id';

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    protected $fillable = [
        'association_rule_id',
        'lift',
        'support',
        'confidence',
    ];

    /** @var string[] */
    protected $casts = [
        'association_rule_id' => 'integer',
        'lift' => 'float',
        'support' => 'float',
        'confidence' => 'float',
    ];
}
