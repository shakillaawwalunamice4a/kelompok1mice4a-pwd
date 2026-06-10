@extends('layouts.admin')

@section('page-title', 'Dashboard')

@section('content')
<!-- Stat Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="stat-card">
            <div class="d-flex align-items-center">
                <div class="stat-icon me-3" style="background:#EEF2FF;"><i class="bi bi-people" style="color:var(--primary);"></i></div>
                <div>
                    <div class="stat-label">Total Users</div>
                    <div class="stat-value">{{ $totalUsers }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card" style="border-left-color:var(--success);">
            <div class="d-flex align-items-center">
                <div class="stat-icon me-3" style="background:#ECFDF5;"><i class="bi bi-calendar-event" style="color:var(--success);"></i></div>
                <div>
                    <div class="stat-label">Event Aktif</div>
                    <div class="stat-value">{{ $activeEvents }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card" style="border-left-color:var(--accent);">
            <div class="d-flex align-items-center">
                <div class="stat-icon me-3" style="background:#FEF3C7;"><i class="bi bi-receipt" style="color:var(--accent);"></i></div>
                <div>
                    <div class="stat-label">Total Booking</div>
                    <div class="stat-value">{{ $totalBookings }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card" style="border-left-color:var(--secondary);">
            <div class="d-flex align-items-center">
                <div class="stat-icon me-3" style="background:#ECFEFF;"><i class="bi bi-currency-exchange" style="color:var(--secondary);"></i></div>
                <div>
                    <div class="stat-label">Total Transaksi</div>
                    <div class="stat-value">Rp {{ number_format($totalTransactions, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="stat-card" style="border-left-color:var(--danger);">
            <div class="d-flex align-items-center">
                <div class="stat-icon me-3" style="background:#FEE2E2;"><i class="bi bi-clock-history" style="color:var(--danger);"></i></div>
                <div>
                    <div class="stat-label">Pembayaran Pending</div>
                    <div class="stat-value">{{ $pendingPayments }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card" style="border-left-color:#8B5CF6;">
            <div class="d-flex align-items-center">
                <div class="stat-icon me-3" style="background:#EDE9FE;"><i class="bi bi-ticket-perforated" style="color:#8B5CF6;"></i></div>
                <div>
                    <div class="stat-label">Tiket Aktif</div>
                    <div class="stat-value">{{ $totalTickets }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Top Events -->
    <div class="col-md-6">
        <div class="card p-4">
            <h6 class="fw-bold mb-3"><i class="bi bi-trophy" style="color:var(--accent);"></i> Top 5 Event</h6>
            @if($topEvents->count() > 0)
            <div class="table-responsive">
                <table class="table table-sm mb-0">
                    <thead><tr><th>Event</th><th>Booking</th><th>Kuota</th></tr></thead>
                    <tbody>
                        @foreach($topEvents as $event)
                        <tr>
                            <td class="fw-medium">{{ Str::limit($event->nama_event, 30) }}</td>
                            <td><span class="badge bg-primary">{{ $event->bookings_count }}</span></td>
                            <td>{{ $event->kuota }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <p class="text-muted small">Belum ada data event.</p>
            @endif
        </div>
    </div>

    <!-- Recent Bookings -->
    <div class="col-md-6">
        <div class="card p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold mb-0"><i class="bi bi-clock-history" style="color:var(--primary);"></i> Booking Terbaru</h6>
                <a href="{{ route('admin.transactions.index') }}" class="small text-decoration-none" style="color:var(--primary);">Lihat Semua</a>
            </div>
            @if($recentBookings->count() > 0)
            @foreach($recentBookings as $booking)
            <div class="d-flex justify-content-between align-items-center p-2 mb-2 rounded" style="background:var(--gray-50);">
                <div>
                    <span class="fw-medium small">{{ $booking->user->name }}</span>
                    <span class="text-muted d-block" style="font-size:0.75rem;">{{ $booking->event->nama_event }}</span>
                </div>
                <div class="text-end">
                    <span class="badge badge-{{ $booking->status_booking }}">{{ ucfirst($booking->status_booking) }}</span>
                    <span class="d-block small text-muted">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</span>
                </div>
            </div>
            @endforeach
            @else
            <p class="text-muted small">Belum ada booking.</p>
            @endif
        </div>
    </div>
</div>

<!-- Booking Stats Chart -->
<div class="row g-4 mt-1">
    <div class="col-12">
        <div class="card p-4">
            <h6 class="fw-bold mb-3"><i class="bi bi-graph-up" style="color:var(--primary);"></i> Statistik Booking (6 Bulan Terakhir)</h6>
            @if($bookingStats->count() > 0)
            <div class="d-flex align-items-end gap-2" style="height:200px;">
                @php
                    $maxBooking = $bookingStats->max('total') ?: 1;
                @endphp
                @foreach($bookingStats as $stat)
                <div class="flex-fill text-center">
                    <div class="d-flex flex-column align-items-center justify-content-end" style="height:180px;">
                        <span class="small fw-bold mb-1">{{ $stat->total }}</span>
                        <div style="width:100%;max-width:60px;height:{{ ($stat->total / $maxBooking) * 150 }}px;background:linear-gradient(to top,var(--primary),var(--primary-light));border-radius:6px 6px 0 0;min-height:4px;"></div>
                    </div>
                    <small class="text-muted" style="font-size:0.7rem;">{{ \Carbon\Carbon::parse($stat->month . '-01')->format('M Y') }}</small>
                </div>
                @endforeach
            </div>
            @else
            <p class="text-muted small">Belum ada data statistik.</p>
            @endif
        </div>
    </div>
</div>
@endsection
