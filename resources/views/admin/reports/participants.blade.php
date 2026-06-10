@extends('layouts.admin')

@section('page-title', 'Laporan Peserta')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="{{ route('admin.reports.index') }}" class="text-decoration-none" style="color:var(--primary);"><i class="bi bi-arrow-left"></i> Kembali</a>
        <h4 class="fw-bold mt-2 mb-0">Laporan Peserta</h4>
        <p class="text-muted small mb-0">{{ $bookings->count() }} data peserta</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.reports.participants', array_merge(request()->all(), ['export' => 'pdf'])) }}" class="btn btn-danger btn-sm fw-bold">
            <i class="bi bi-file-earmark-pdf"></i> Export PDF
        </a>
        <a href="{{ route('admin.reports.participants', array_merge(request()->all(), ['export' => 'excel'])) }}" class="btn btn-success btn-sm fw-bold">
            <i class="bi bi-file-earmark-excel"></i> Export Excel
        </a>
    </div>
</div>

<!-- Filter -->
<div class="card p-3 mb-4" style="border-radius:10px;">
    <form method="GET" class="row g-2 align-items-end">
        <div class="col-md-3">
            <label class="form-label small">Event</label>
            <select name="event_id" class="form-select form-select-sm">
                <option value="">Semua Event</option>
                @foreach($events as $event)
                <option value="{{ $event->id }}" {{ request('event_id') == $event->id ? 'selected' : '' }}>{{ $event->nama_event }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label small">Dari Tanggal</label>
            <input type="date" name="from_date" class="form-control form-control-sm" value="{{ request('from_date') }}">
        </div>
        <div class="col-md-3">
            <label class="form-label small">Sampai Tanggal</label>
            <input type="date" name="to_date" class="form-control form-control-sm" value="{{ request('to_date') }}">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-outline-primary btn-sm w-100"><i class="bi bi-funnel"></i> Filter</button>
        </div>
    </form>
</div>

<!-- Table -->
<div class="card" style="border-radius:12px;">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Event</th>
                    <th>Tiket</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                <tr>
                    <td><small>{{ $booking->kode_booking }}</small></td>
                    <td><small class="fw-medium">{{ $booking->user->name }}</small></td>
                    <td><small>{{ $booking->user->email }}</small></td>
                    <td><small>{{ Str::limit($booking->event->nama_event, 20) }}</small></td>
                    <td><small>{{ $booking->jumlah_tiket }}</small></td>
                    <td><small>Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</small></td>
                    <td><span class="badge badge-{{ $booking->status_booking }}">{{ ucfirst($booking->status_booking) }}</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
