<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_event',
        'deskripsi',
        'tanggal',
        'tanggal_selesai',
        'waktu',
        'lokasi',
        'kuota',
        'harga',
        'poster',
        'kategori',
        'status',
        'user_id',
    ];

    protected $casts = [
        'tanggal' => 'datetime',
        'tanggal_selesai' => 'datetime',
        'harga' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }

    public function getTiketTerjualAttribute()
    {
        return $this->bookings()
            ->where('status_booking', 'confirmed')
            ->sum('jumlah_tiket');
    }

    public function getSisaKuotaAttribute()
    {
        return $this->kuota - $this->tiket_terjual;
    }

    public function isFull(): bool
    {
        return $this->sisa_kuota <= 0;
    }
}