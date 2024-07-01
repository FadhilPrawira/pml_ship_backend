<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    //    use HasFactory;
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'transaction_id';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    /**
     * The data type of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'transaction_id',
        'user_id',
        'shipper_name',
        'shipper_address',
        'consignee_name',
        'consignee_address',
        'port_of_loading_id',
        'port_of_discharge_id',
        'vessel_id',
        'date_of_loading',
        'date_of_discharge',
        'status',
        'cargo_description',
        'cargo_weight',
        'shipping_cost',
        'handling_cost',
        'biaya_parkir_pelabuhan',
        'tax',
        'total_bill',
        'cumulative_paid',
        'rating_star',
        'review',
        'negotiation_approved_at',
        'order_rejected_at',
        'order_canceled_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'negotiation_approved_at' => 'datetime',
            'order_rejected_at' => 'datetime',
            'order_canceled_at' => 'datetime',
        ];
    }


    // FIX
    public function user()
    {
        // One to many relationship (inverse)
        // Many Order belongs to one User
        // This will return the User that owns many Order
        // Di Tabel User tidak ada field yang menyimpan id Order.
        // Di Tabel Order ada field user_id yang menyimpan id User.
        return $this->belongsTo(User::class);
    }

    // FIX
    public function portOfLoading()
    {
        // One to many relationship (inverse)
        // Many Order belongs to one port
        // This will return the port that owns many Order
        // Di Tabel port tidak ada field yang menyimpan id Order.
        // Di Tabel Order ada field port_of_loading_id yang menyimpan id port.
        return $this->belongsTo(Port::class, 'port_of_loading_id');
    }

    // FIX
    public function portOfDischarge()
    {
        // One to many relationship (inverse)
        // Many Order belongs to one port
        // This will return the port that owns many Order
        // Di Tabel port tidak ada field yang menyimpan id Order.
        // Di Tabel Order ada field port_of_discharge_id yang menyimpan id port.
        return $this->belongsTo(Port::class, 'port_of_discharge_id');
    }

    // FIX
    public function vesselName()
    {
        // One to many relationship (inverse)
        // Many Order belongs to one Vessel
        // This will return the Vessel that owns many Order
        // Di Tabel Vessel tidak ada field yang menyimpan id Order.
        // Di Tabel Order ada field vessel_id yang menyimpan id Vessel.
        return $this->belongsTo(Vessel::class, 'vessel_id');
    }

    // FIX
    public function documents()
    {
        // One to many relationship
        // This order has many documents
        // This will return all documents that belong to this user
        // Di Tabel Orders tidak ada field yang menyimpan id Documents.
        // Di Tabel Documents ada field order_transaction_id yang menyimpan id Orders.
        return $this->hasMany(Document::class, 'order_transaction_id');
    }

    // FIX
    public function conference()
    {
        // FIX
        // One to one relationship
        // This order has one conference
        // This will return one conference that belong to this order
        // Di Tabel Order tidak ada field yang menyimpan id Conference.
        // Di Tabel Conference ada field order_transaction_id yang menyimpan id Order.
        return $this->hasOne(Conference::class, 'order_transaction_id');
    }


    // FIX
    public function payments()
    {
        // One to many relationship
        // This order has many payments
        // This will return all payments that belong to this user
        // Di Tabel Orders tidak ada field yang menyimpan id Payments.
        // Di Tabel Payments ada field order_transaction_id yang menyimpan id Orders.
        return $this->hasMany(Payment::class, 'order_transaction_id');
    }
}
