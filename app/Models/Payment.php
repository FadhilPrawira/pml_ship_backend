<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'order_transaction_id',
        'payment_date',
        'payment_due_date',
        'payment_amount',
        'payment_proof_document',
        'installment_number',
        'total_installments',
        'payment_status',
    ];

    // FIX
    public function order()
    {
        // One to many relationship (inverse)
        // Many payments belongs to one order
        // This will return the order that owns many payments
        // Di Tabel Orders tidak ada field yang menyimpan id payments.
        // Di Tabel payments ada field order_transaction_id yang menyimpan id Orders.
        return $this->belongsTo(Order::class, 'order_transaction_id');
    }
}
