@extends('layouts.app')

@section('title', 'Detail Booking')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="border-radius:16px;">
                    <div class="card-body p-5">
                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <div>
                                <h4 class="fw-bold">Detail Booking</h4>
                                <span class="text-muted">Kode: {{ $booking->kode_booking }}</span>
                            </div>
                            <span class="badge badge-{{ $booking->status_booking }} fs-6">
                                {{ ucfirst($booking->status_booking) }}
                            </span>
                        </div>

                        <!-- Event Info -->
                        <div class="card p-3 mb-4" style="border-radius:10px;background:var(--gray-50);">
                            <h6 class="fw-bold">{{ $booking->event->nama_event }}</h6>

                            <small class="text-muted">
                                <i class="bi bi-calendar3"></i>
                                {{ \Carbon\Carbon::parse($booking->event->tanggal)->format('d F Y') }}
                            </small>
                            <br>

                            <small class="text-muted">
                                <i class="bi bi-geo-alt"></i>
                                {{ $booking->event->lokasi }}
                            </small>
                        </div>

                        <!-- Booking Details -->
                        <table class="table">
                            <tr>
                                <td class="text-muted">Jumlah Tiket</td>
                                <td class="fw-bold text-end">{{ $booking->jumlah_tiket }}</td>
                            </tr>

                            <tr>
                                <td class="text-muted">Harga per Tiket</td>
                                <td class="text-end">
                                    Rp {{ number_format($booking->event->harga, 0, ',', '.') }}
                                </td>
                            </tr>

                            <tr>
                                <td class="text-muted">Total Harga</td>
                                <td class="fw-bold text-end fs-5" style="color:var(--primary);">
                                    Rp {{ number_format($booking->total_harga, 0, ',', '.') }}
                                </td>
                            </tr>

                            <tr>
                                <td class="text-muted">Tanggal Booking</td>
                                <td class="text-end">
                                    {{ \Carbon\Carbon::parse($booking->created_at)->format('d M Y H:i') }}
                                </td>
                            </tr>
                        </table>

                        <!-- Payment Status -->
                        @if($booking->payment)
                        <div class="card p-3 mb-3"
                             style="border-radius:10px;border-left:4px solid {{ $booking->payment->status_payment === 'verified' ? 'var(--success)' : ($booking->payment->status_payment === 'rejected' ? 'var(--danger)' : 'var(--accent)') }};">

                            <h6 class="fw-bold">
                                Status Pembayaran:
                                {{ ucfirst($booking->payment->status_payment) }}
                            </h6>

                            <small class="text-muted">
                                Metode:
                                {{ str_replace('_', ' ', ucfirst($booking->payment->metode_pembayaran)) }}
                            </small>
                            <br>

                            @if($booking->payment->verified_at)
                                <small class="text-muted">
                                    Diverifikasi:
                                    {{ \Carbon\Carbon::parse($booking->payment->verified_at)->format('d M Y H:i') }}
                                </small>
                                <br>
                            @endif

                            @if($booking->payment->catatan)
                                <small class="text-muted">
                                    Catatan: {{ $booking->payment->catatan }}
                                </small>
                            @endif
                        </div>
                        @endif

                        <!-- Tickets -->
                        @if($booking->tickets->count() > 0)
                            <h6 class="fw-bold mt-4 mb-3">E-Tickets</h6>

                            @foreach($booking->tickets as $ticket)
                                <div class="d-flex justify-content-between align-items-center p-2 mb-2 rounded"
                                     style="background:var(--gray-50);">

                                    <div>
                                        <span class="fw-medium">
                                            {{ $ticket->kode_tiket }}
                                        </span>

                                        <span class="badge badge-{{ $ticket->status }} ms-2">
                                            {{ ucfirst($ticket->status) }}
                                        </span>
                                    </div>

                                    <a href="{{ route('tickets.show', $ticket) }}"
                                       class="btn btn-sm btn-primary">
                                        <i class="bi bi-qr-code"></i> Lihat
                                    </a>
                                </div>
                            @endforeach
                        @endif

                        <div class="mt-4">
                            <a href="{{ route('bookings.index') }}"
                               class="btn btn-outline-primary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection