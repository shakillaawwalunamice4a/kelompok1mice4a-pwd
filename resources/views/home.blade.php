@extends('layouts.app')

@section('title', 'Home')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container position-relative" style="z-index:1;">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <h1 class="fw-bold display-5 mb-3">Kelola Event MICE<br>dengan <span style="color:var(--accent);">Mudah</span></h1>
                <p class="lead mb-4 opacity-90">Platform terpadu untuk manajemen event, pemesanan tiket, pembayaran, dan e-ticket. Semua dalam satu tempat.</p>
                <div class="d-flex gap-3">
                    <a href="{{ route('events.index') }}" class="btn btn-warning btn-lg fw-bold text-dark px-4">
                        <i class="bi bi-calendar-event"></i> Lihat Event
                    </a>
                    @guest
                    <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg px-4">
                        <i class="bi bi-person-plus"></i> Daftar Gratis
                    </a>
                    @endguest
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block text-center">
                <i class="bi bi-calendar2-check" style="font-size:12rem;opacity:0.2;"></i>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Kenapa MeeTopia?</h2>
            <p class="text-muted">Fitur lengkap untuk pengelolaan event profesional</p>
        </div>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="text-center p-4">
                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width:64px;height:64px;background:#EEF2FF;">
                        <i class="bi bi-calendar-plus" style="font-size:1.5rem;color:var(--primary);"></i>
                    </div>
                    <h6 class="fw-bold">Manajemen Event</h6>
                    <p class="text-muted small">Buat dan kelola event dengan mudah</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center p-4">
                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width:64px;height:64px;background:#ECFDF5;">
                        <i class="bi bi-ticket-perforated" style="font-size:1.5rem;color:var(--success);"></i>
                    </div>
                    <h6 class="fw-bold">Booking Tiket</h6>
                    <p class="text-muted small">Pesan tiket dalam hitungan menit</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center p-4">
                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width:64px;height:64px;background:#FEF3C7;">
                        <i class="bi bi-credit-card" style="font-size:1.5rem;color:var(--accent);"></i>
                    </div>
                    <h6 class="fw-bold">Pembayaran Aman</h6>
                    <p class="text-muted small">Upload bukti bayar & verifikasi</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center p-4">
                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width:64px;height:64px;background:#FCE7F3;">
                        <i class="bi bi-qr-code" style="font-size:1.5rem;color:#EC4899;"></i>
                    </div>
                    <h6 class="fw-bold">E-Ticket QR</h6>
                    <p class="text-muted small">Tiket digital dengan QR Code</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Upcoming Events Section -->
@if($upcomingEvents->count() > 0)
<section class="py-5" style="background:var(--gray-100);">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-1">Event Mendatang</h3>
                <p class="text-muted mb-0">Jangan lewatkan event terbaru!</p>
            </div>
            <a href="{{ route('events.index') }}" class="btn btn-outline-primary btn-sm fw-bold">
                Lihat Semua <i class="bi bi-arrow-right"></i>
            </a>
        </div>
        <div class="row g-4">
            @foreach($upcomingEvents as $event)
            <div class="col-md-4">
                <div class="card event-card h-100">
                    @if($event->poster)
                    <img src="{{ Storage::url($event->poster) }}" class="card-img-top" alt="{{ $event->nama_event }}">
                    @else
                    <div class="card-img-top d-flex align-items-center justify-content-center bg-light" style="height:200px;">
                        <i class="bi bi-image" style="font-size:3rem;color:var(--gray-300);"></i>
                    </div>
                    @endif
                    <div class="card-body">
                        <div class="d-flex gap-2 mb-2">
                            <span class="badge badge-kategori">{{ ucfirst($event->kategori) }}</span>
                            @if($event->isFull())
                            <span class="badge bg-danger">Full</span>
                            @endif
                        </div>
                        <h6 class="fw-bold">{{ $event->nama_event }}</h6>
                        <p class="text-muted small mb-2">
                            <i class="bi bi-calendar3"></i> {{ $event->tanggal->format('d M Y') }}
                        </p>
                        <p class="text-muted small mb-2">
                            <i class="bi bi-geo-alt"></i> {{ Str::limit($event->lokasi, 30) }}
                        </p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="price-tag">
                                @if($event->harga == 0) GRATIS @else Rp {{ number_format($event->harga, 0, ',', '.') }} @endif
                            </span>
                            <a href="{{ route('events.show', $event) }}" class="btn btn-sm btn-primary">Detail</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Popular Events Section -->
@if($popularEvents->count() > 0)
<section class="py-5">
    <div class="container">
        <h3 class="fw-bold mb-4">Event Populer</h3>
        <div class="row g-4">
            @foreach($popularEvents as $event)
            <div class="col-md-3">
                <div class="card event-card h-100">
                    @if($event->poster)
                    <img src="{{ Storage::url($event->poster) }}" class="card-img-top" alt="{{ $event->nama_event }}">
                    @else
                    <div class="card-img-top d-flex align-items-center justify-content-center bg-light" style="height:160px;">
                        <i class="bi bi-image" style="font-size:2.5rem;color:var(--gray-300);"></i>
                    </div>
                    @endif
                    <div class="card-body">
                        <h6 class="fw-bold">{{ Str::limit($event->nama_event, 30) }}</h6>
                        <p class="text-muted small mb-1"><i class="bi bi-calendar3"></i> {{ $event->tanggal->format('d M Y') }}</p>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <span class="price-tag small">
                                @if($event->harga == 0) GRATIS @else Rp {{ number_format($event->harga, 0, ',', '.') }} @endif
                            </span>
                            <small class="text-muted">{{ $event->tiket_terjual }} terjual</small>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
