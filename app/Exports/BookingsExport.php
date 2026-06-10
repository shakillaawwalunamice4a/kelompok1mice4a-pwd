<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Collection;

class BookingsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $bookings;

    public function __construct(Collection $bookings)
    {
        $this->bookings = $bookings;
    }

    public function collection()
    {
        return $this->bookings;
    }

    public function headings(): array
    {
        return [
            'Kode Booking',
            'Nama Peserta',
            'Email',
            'Event',
            'Jumlah Tiket',
            'Total Harga',
            'Status',
            'Tanggal Booking',
        ];
    }

    public function map($booking): array
    {
        return [
            $booking->kode_booking,
            $booking->user->name,
            $booking->user->email,
            $booking->event->nama_event,
            $booking->jumlah_tiket,
            $booking->total_harga,
            $booking->status_booking,
            $booking->created_at->format('d/m/Y H:i'),
        ];
    }
}
