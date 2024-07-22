<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Conference extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_transaction_id',
        'customer_company_id',
        'status',
        'conference_type',
        'location',
        'conference_date',
        'conference_time',
        'reason_rejected',
        'conference_approved_at',
        'conference_rejected_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => 'string',
            'conference_type' => 'string',
            'location' => 'string',
            'conference_date' => 'date',
            'conference_time' => 'string',
            'conference_approved_at' => 'datetime',
            'conference_rejected_at' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    // FIX
    public function order()
    {
        // One to one relationship (inverse)
        // One conference belongs to one order
        // This will return the order that owns a conference
        // Di Tabel Order tidak ada field yang menyimpan id Conference.
        // Di Tabel Conference ada field transaction_id yang menyimpan id Order.
        return $this->belongsTo(Order::class, 'order_transaction_id');
    }

    // FIX
    public function customerCompany(): BelongsTo
    {
        // One to many relationship (inverse)
        // Many Conference belongs to one user
        // This will return the user that owns many Conference
        // Di Tabel User tidak ada field yang menyimpan id Conference.
        // Di Tabel Conference ada field customer_company_id yang menyimpan id User.
        return $this->belongsTo(User::class, 'customer_company_id');
    }
}
