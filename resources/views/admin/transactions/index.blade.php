@extends('layouts.admin')

@section('page-title', 'Transaksi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0">Daftar Transaksi</h4>
        <p class="text-muted small mb-0">Verifikasi pembayaran dan kelola booking</p>
    </div>
</div>

<!-- Filter -->
<div class="card p-3 mb-4" style="border-radius:10px;">
    <form method="GET" class="row g-2 align-items-end">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Cari kode booking atau nama..." value="{{ request('search') }}">
        </div>
        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-outline-primary w-100"><i class="bi bi-search"></i></button>
        </div>
    </form>
</div>

<!-- Transactions Table -->
<div class="card" style="border-radius:12px;">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Kode Booking</th>
                    <th>Peserta</th>
                    <th>Event</th>
                    <th>Tiket</th>
                    <th>Total</th>
                    <th>Status Booking</th>
                    <th>Pembayaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                <tr>
                    <td><span class="fw-medium">{{ $booking->kode_booking }}</span></td>
                    <td><small>{{ $booking->user->name }}</small></td>
                    <td><small>{{ Str::limit($booking->event->nama_event, 20) }}</small></td>
                    <td><small>{{ $booking->jumlah_tiket }}</small></td>
                    <td><small class="fw-bold" style="color:var(--primary);">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</small></td>
                    <td><span class="badge badge-{{ $booking->status_booking }}">{{ ucfirst($booking->status_booking) }}</span></td>
                    <td>
                        @if($booking->payment)
                        <span class="badge badge-{{ $booking->payment->status_payment }}">{{ ucfirst($booking->payment->status_payment) }}</span>
                        @else
                        <span class="text-muted small">Belum bayar</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.transactions.show', $booking) }}" class="btn btn-sm btn-outline-primary" title="Detail">
                            <i class="bi bi-eye"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">{{ $bookings->links() }}</div>
@endsection
