<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Collection;

class AttendanceExport implements FromCollection, WithHeadings, WithMapping
{
    protected $attendance;

    public function __construct(Collection $attendance)
    {
        $this->attendance = $attendance;
    }

    public function collection()
    {
        return $this->attendance;
    }

    public function headings(): array
    {
        return [
            'Nama Peserta',
            'Email',
            'Event',
            'Kode Tiket',
            'Status Kehadiran',
            'Waktu Check-in',
        ];
    }

    public function map($item): array
    {
        return [
            $item->user->name,
            $item->user->email,
            $item->event->nama_event,
            $item->ticket->kode_tiket,
            $item->status,
            $item->check_in_time ? $item->check_in_time->format('d/m/Y H:i') : '-',
        ];
    }
}
