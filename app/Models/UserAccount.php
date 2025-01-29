<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class UserAccount extends Authenticatable
{
    use AuthenticableTrait, HasFactory, Notifiable;

    // Wenn der Name der Tabelle nicht der Standard-Name ist
    protected $table = 'user_account';

    // Primärschlüssel definieren (falls abweichend von der Standardkonvention)
    protected $primaryKey = 'user_account_id';
    public $incrementing = false; // Weil es ein zusammengesetzter Primärschlüssel ist

    // Felder, die massenweise zuweisbar sind
    protected $fillable = [
        'user_account_id',
        'password_valid_end',
        'customer_id',
        'password',
        'password_valid_begin',
    ];

    // Optional: Timestamps deaktivieren, falls die Tabelle keine created_at/updated_at Spalten hat
    public $timestamps = false;

    public function getAuthIdentifierName() {
        return $this->USER_ACCOUNT_ID;
    }
    public function getAuthIdentifier()
    {
        return $this->getKey(); // Gibt den Wert des Primärschlüssels zurück
    }

    public function getAuthPassword()
    {
        return $this->PASSWORD;
    }

    public function getRememberToken()
    {
        return $this->remember_token; // Wenn du "Remember Me" Funktionalität nutzt
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }




    public function getPasswordValidEndAttribute($value)
    {
        // Format the date and return the custom string
        return "TO_TIMESTAMP('{$value}', 'DD-MM-YYYY HH24:MI:SS')";
    }

    public function getPasswordValidBeginAttribute($value)
    {
        // Format the date and return the custom string
        return "TO_TIMESTAMP('{$value}', 'DD-MM-YYYY HH24:MI:SS')";
    }
}
