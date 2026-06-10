@extends('layouts.admin')

@section('page-title', 'Laporan Kehadiran')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="{{ route('admin.reports.index') }}" class="text-decoration-none" style="color:var(--primary);"><i class="bi bi-arrow-left"></i> Kembali</a>
        <h4 class="fw-bold mt-2 mb-0">Laporan Kehadiran</h4>
        <p class="text-muted small mb-0">{{ $attendance->count() }} data kehadiran</p>
    </div>
    <a href="{{ route('admin.reports.attendance', array_merge(request()->all(), ['export' => 'excel'])) }}" class="btn btn-success btn-sm fw-bold">
        <i class="bi bi-file-earmark-excel"></i> Export Excel
    </a>
</div>

<!-- Filter -->
<div class="card p-3 mb-4" style="border-radius:10px;">
    <form method="GET" class="row g-2 align-items-end">
        <div class="col-md-4">
            <label class="form-label small">Event</label>
            <select name="event_id" class="form-select form-select-sm">
                <option value="">Semua Event</option>
                @foreach($events as $event)
                <option value="{{ $event->id }}" {{ request('event_id') == $event->id ? 'selected' : '' }}>{{ $event->nama_event }}</option>
                @endforeach
            </select>
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
                    <th>Peserta</th>
                    <th>Email</th>
                    <th>Event</th>
                    <th>Kode Tiket</th>
                    <th>Status</th>
                    <th>Check-in</th>
                </tr>
            </thead>
            <tbody>
                @foreach($attendance as $item)
                <tr>
                    <td><small class="fw-medium">{{ $item->user->name }}</small></td>
                    <td><small>{{ $item->user->email }}</small></td>
                    <td><small>{{ Str::limit($item->event->nama_event, 20) }}</small></td>
                    <td><small>{{ $item->ticket->kode_tiket }}</small></td>
                    <td>
                        @if($item->status === 'checked_in')
                        <span class="badge badge-verified">Checked In</span>
                        @elseif($item->status === 'absent')
                        <span class="badge badge-cancelled">Absent</span>
                        @else
                        <span class="badge badge-pending">Registered</span>
                        @endif
                    </td>
                    <td><small>{{ $item->check_in_time ? $item->check_in_time->format('d M Y H:i') : '-' }}</small></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
