<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSeriesAnalysis extends Model
{
    use HasFactory;

    // Definiere den Tabellennamen, falls er vom Laravel-Standard abweicht
    protected $table = 'TIME_SERIES_ANALYSIS';

    // Definiere den Primärschlüssel
    protected $primaryKey = 'TIME_SERIES_ANALYSIS_ID';

    // Falls der Primärschlüssel kein Auto-Inkrement ist, setze dies auf false
    public $incrementing = false;

    // Falls der Primärschlüssel nicht vom Typ Integer ist
    protected $keyType = 'string';

    // Laravel erwartet `created_at` und `updated_at`. Falls nicht benötigt, deaktiviere sie:
    public $timestamps = false;

    // Definiere die zuweisbaren Felder (Mass Assignment)
    protected $fillable = [
        'TIME_SERIES_ANALYSIS_ID',
        'PRODUCT_ID',
        'FORECAST',
    ];

    // Beziehung zu Produkten (optional, falls benötigt)
    public function product()
    {
        return $this->belongsTo(Product::class, 'PRODUCT_ID');
    }
}
