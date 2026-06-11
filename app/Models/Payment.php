<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'metode_pembayaran',
        'bukti_transfer',
        'jumlah_bayar',
        'status_payment',
        'catatan',
        'verified_at',
        'verified_by',
    ];

    protected function casts(): array
    {
        return [
            'jumlah_bayar' => 'decimal:2',
            'verified_at' => 'datetime',
        ];
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function isVerified(): bool
    {
        return $this->status_payment === 'verified';
    }

    public function isPending(): bool
    {
        return $this->status_payment === 'pending';
    }

    public function isRejected(): bool
    {
        return $this->status_payment === 'rejected';
    }
}
