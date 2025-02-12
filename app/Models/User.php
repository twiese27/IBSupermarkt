<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /** @var string */
    protected $table = 'users';

    /** @var string */
    protected $primaryKey = 'user_account_id';

    /** @var bool */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_account_id',
        'password_valid_end',
        'customer_id',
        'password',
        'password_valid_begin',
    ];

    /** @var bool */
    public $timestamps = false;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
//        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
//            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getPassordValidEndAttribute($value)
    {
        // Format the date and return the custom string
        return "TO_TIMESTAMP('{$value}', 'DD-MM-YYYY HH24:MI:SS')";
    }

    public function getPassordValidBeginnAttribute($value)
    {
        // Format the date and return the custom string
        return "TO_TIMESTAMP('{$value}', 'DD-MM-YYYY HH24:MI:SS')";
    }

    public function getRememberTokenName()
    {
        return null; // Deaktiviert die Speicherung des Tokens
    }

    public function getAuthIdentifierName()
    {
        return 'customer_id';
    }

    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }
}
