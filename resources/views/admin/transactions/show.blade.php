@extends('layouts.admin')

@section('page-title', 'Detail Transaksi')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.transactions.index') }}" class="text-decoration-none" style="color:var(--primary);">
        <i class="bi bi-arrow-left"></i> Kembali ke Daftar Transaksi
    </a>
</div>

<div class="row g-4">
    <!-- Booking Info -->
    <div class="col-md-8">
        <div class="card p-4" style="border-radius:12px;">
            <h5 class="fw-bold mb-3">Detail Booking</h5>
            <table class="table">
                <tr><td class="text-muted" style="width:35%;">Kode Booking</td><td class="fw-bold">{{ $booking->kode_booking }}</td></tr>
                <tr><td class="text-muted">Peserta</td><td>{{ $booking->user->name }} ({{ $booking->user->email }})</td></tr>
                <tr><td class="text-muted">Event</td><td>{{ $booking->event->nama_event }}</td></tr>
                <tr><td class="text-muted">Jumlah Tiket</td><td>{{ $booking->jumlah_tiket }}</td></tr>
                <tr><td class="text-muted">Total Harga</td><td class="fw-bold fs-5" style="color:var(--primary);">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</td></tr>
                <tr><td class="text-muted">Status Booking</td><td><span class="badge badge-{{ $booking->status_booking }}">{{ ucfirst($booking->status_booking) }}</span></td></tr>
                <tr><td class="text-muted">Tanggal Booking</td><td>{{ $booking->created_at->format('d M Y H:i') }}</td></tr>
            </table>
        </div>
    </div>

    <!-- Payment & Verify -->
    <div class="col-md-4">
        @if($booking->payment)
        <div class="card p-4 mb-3" style="border-radius:12px;">
            <h6 class="fw-bold mb-3">Informasi Pembayaran</h6>
            <table class="table table-sm">
                <tr><td class="text-muted">Metode</td><td>{{ ucfirst(str_replace('_', ' ', $booking->payment->metode_pembayaran)) }}</td></tr>
                <tr><td class="text-muted">Jumlah</td><td class="fw-bold">Rp {{ number_format($booking->payment->jumlah_bayar, 0, ',', '.') }}</td></tr>
                <tr><td class="text-muted">Status</td><td><span class="badge badge-{{ $booking->payment->status_payment }}">{{ ucfirst($booking->payment->status_payment) }}</span></td></tr>
            </table>

            @if($booking->payment->bukti_transfer)
            <div class="mb-3">
                <label class="form-label small fw-medium">Bukti Transfer:</label>
                <img src="{{ Storage::url($booking->payment->bukti_transfer) }}" class="img-fluid rounded" alt="Bukti Transfer">
            </div>
            @endif

            @if($booking->payment->status_payment === 'pending')
            <form method="POST" action="{{ route('admin.payments.verify', $booking->payment) }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label small fw-medium">Catatan (opsional)</label>
                    <textarea name="catatan" class="form-control form-control-sm" rows="2"></textarea>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" name="status_payment" value="verified" class="btn btn-success btn-sm fw-bold flex-fill">
                        <i class="bi bi-check-circle"></i> Verifikasi
                    </button>
                    <button type="submit" name="status_payment" value="rejected" class="btn btn-danger btn-sm fw-bold flex-fill" onclick="return confirm('Tolak pembayaran ini?')">
                        <i class="bi bi-x-circle"></i> Tolak
                    </button>
                </div>
            </form>
            @endif

            @if($booking->payment->verified_at)
            <div class="mt-3 p-2 rounded" style="background:var(--gray-50);">
                <small class="text-muted">Diverifikasi: {{ $booking->payment->verified_at->format('d M Y H:i') }}</small><br>
                @if($booking->payment->verifier)
                <small class="text-muted">Oleh: {{ $booking->payment->verifier->name }}</small>
                @endif
            </div>
            @endif
        </div>
        @else
        <div class="card p-4 text-center" style="border-radius:12px;">
            <i class="bi bi-credit-card-2-front" style="font-size:2rem;color:var(--gray-300);"></i>
            <p class="text-muted mt-2">Peserta belum mengupload bukti pembayaran</p>
        </div>
        @endif
    </div>
</div>
@endsection
