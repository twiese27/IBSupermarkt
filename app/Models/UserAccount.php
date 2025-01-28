<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccount extends Model
{
    use HasFactory;

    // Wenn der Name der Tabelle nicht der Standard-Name ist
    protected $table = 'user_account';

    // Primärschlüssel definieren (falls abweichend von der Standardkonvention)
    protected $primaryKey = ['user_account_id', 'password_valid_end', 'password_valid_beginn'];
    public $incrementing = false; // Weil es ein zusammengesetzter Primärschlüssel ist

    // Felder, die massenweise zuweisbar sind
    protected $fillable = [
        'user_account_id',
        'password_valid_end',
        'customer_id',
        'password',
        'password_valid_beginn',
    ];

    // Optional: Timestamps deaktivieren, falls die Tabelle keine created_at/updated_at Spalten hat
    public $timestamps = false;
}
