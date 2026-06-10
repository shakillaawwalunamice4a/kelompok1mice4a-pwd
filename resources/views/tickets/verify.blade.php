@extends('layouts.app')

@section('title', 'Verifikasi Tiket')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                @if($status === 'valid')
                <div class="card p-5" style="border-radius:16px;border:2px solid var(--success);">
                    <i class="bi bi-check-circle" style="font-size:5rem;color:var(--success);"></i>
                    <h3 class="fw-bold mt-3" style="color:var(--success);">Tiket Valid!</h3>
                    <p class="text-muted">Tiket ini terverifikasi dan aktif.</p>
                    <div class="card p-3 mt-3" style="border-radius:10px;background:var(--gray-50);">
                        <h6 class="fw-bold">{{ $ticket->event->nama_event }}</h6>
                        <p class="mb-1">{{ $ticket->user->name }} ({{ $ticket->user->email }})</p>
                        <small class="text-muted">{{ $ticket->kode_tiket }}</small>
                    </div>
                </div>
                @else
                <div class="card p-5" style="border-radius:16px;border:2px solid var(--danger);">
                    <i class="bi bi-x-circle" style="font-size:5rem;color:var(--danger);"></i>
                    <h3 class="fw-bold mt-3" style="color:var(--danger);">Tiket Tidak Valid</h3>
                    <p class="text-muted">Tiket ini tidak ditemukan atau sudah tidak aktif.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
