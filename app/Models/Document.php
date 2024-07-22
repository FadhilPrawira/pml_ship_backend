<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Document extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_transaction_id',
        'document_name',
        'document_type',
        'uploaded_at',
        'max_input_document_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'document_name' => 'string',
            'document_type' => 'string',
            'max_input_document_at' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }
    // FIX
    public function order()
    {
        // One to many relationship (inverse)
        // Many documents belongs to one order
        // This will return the order that owns many documents
        // Di Tabel Orders tidak ada field yang menyimpan id Documents.
        // Di Tabel Documents ada field order_transaction_id yang menyimpan id Orders.
        return $this->belongsTo(Order::class, 'order_transaction_id');
    }
}
