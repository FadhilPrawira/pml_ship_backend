<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'status',
        'role',
        'name',
        'phone',
        'email',
        'password',
        'company_name',
        'company_address',
        'company_phone',
        'company_email',
        'company_NPWP',
        'company_akta',
        'reason_rejected',
        'rejected_at',
        'approved_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'two_factor_confirmed_at'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'approved_at' => 'datetime',
            'rejected_at' => 'datetime',
        ];
    }

    // FIX
    public function conference()
    {
        // FIX
        // One to many relationship
        // This User has many conference
        // This will return all conference that belong to this user
        // Di Tabel User tidak ada field yang menyimpan id Conference.
        // Di Tabel Conference ada field customer_company_id yang menyimpan id Order.
        return $this->hasMany(Conference::class, 'customer_company_id');
    }
}
