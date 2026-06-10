@extends('layouts.app')

@section('title', 'My Bookings')

@section('content')
<section class="py-5">
    <div class="container">
        <h3 class="fw-bold mb-4"><i class="bi bi-bookmark" style="color:var(--primary);"></i> My Bookings</h3>

        @if($bookings->count() > 0)
        <div class="row g-4">
            @foreach($bookings as $booking)
            <div class="col-md-6">
                <div class="card h-100" style="border-radius:12px;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <span class="badge badge-{{ $booking->status_booking }} mb-2">{{ ucfirst($booking->status_booking) }}</span>
                                <h6 class="fw-bold mb-1">{{ $booking->event->nama_event }}</h6>
                                <small class="text-muted">{{ $booking->kode_booking }}</small>
                            </div>
                            <span class="fw-bold" style="color:var(--primary);">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</span>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted d-block"><i class="bi bi-calendar3"></i> {{ $booking->event->tanggal->format('d M Y') }}</small>
                            <small class="text-muted d-block"><i class="bi bi-people"></i> {{ $booking->jumlah_tiket }} tiket</small>
                            <small class="text-muted d-block"><i class="bi bi-clock"></i> {{ $booking->created_at->format('d M Y H:i') }}</small>
                        </div>

                        <!-- Payment Status -->
                        @if($booking->payment)
                        <div class="alert py-2 mb-3 alert-{{ $booking->payment->status_payment === 'verified' ? 'success' : ($booking->payment->status_payment === 'rejected' ? 'danger' : 'warning') }}">
                            <small>
                                <i class="bi bi-{{ $booking->payment->status_payment === 'verified' ? 'check-circle' : ($booking->payment->status_payment === 'rejected' ? 'x-circle' : 'clock') }}"></i>
                                Pembayaran: {{ ucfirst($booking->payment->status_payment) }}
                            </small>
                        </div>
                        @else
                        @if($booking->status_booking === 'pending')
                        <a href="{{ route('bookings.payment', $booking) }}" class="btn btn-warning btn-sm w-100 fw-bold text-dark mb-2">
                            <i class="bi bi-credit-card"></i> Upload Bukti Pembayaran
                        </a>
                        @endif
                        @endif

                        <div class="d-flex gap-2">
                            <a href="{{ route('bookings.show', $booking) }}" class="btn btn-sm btn-outline-primary">Detail</a>
                            @if($booking->status_booking === 'pending' && !$booking->payment)
                            <form method="POST" action="{{ route('bookings.cancel', $booking) }}" onsubmit="return confirm('Yakin ingin membatalkan booking ini?')">
                                @csrf @method('POST')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Batalkan</button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-4">{{ $bookings->links() }}</div>
        @else
        <div class="text-center py-5">
            <i class="bi bi-bookmark-x" style="font-size:4rem;color:var(--gray-300);"></i>
            <h5 class="mt-3 text-muted">Belum ada booking</h5>
            <a href="{{ route('events.index') }}" class="btn btn-primary mt-3">Cari Event</a>
        </div>
        @endif
    </div>
</section>
@endsection
