@extends('layouts.app')

@section('title', 'Daftar Event')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <h3 class="fw-bold">Daftar Event</h3>
                <p class="text-muted">Temukan event yang sesuai dengan minat Anda</p>
            </div>
        </div>

        <!-- Search & Filter -->
        <div class="card mb-4" style="border-radius:12px;">
            <div class="card-body">
                <form method="GET" action="{{ route('events.index') }}">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-4">
                            <label class="form-label small fw-medium">Cari Event</label>
                            <input type="text" name="search" class="form-control" placeholder="Nama event..." value="{{ request('search') }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-medium">Kategori</label>
                            <select name="kategori" class="form-select">
                                <option value="">Semua Kategori</option>
                                @foreach($kategoris as $k)
                                <option value="{{ $k }}" {{ request('kategori') == $k ? 'selected' : '' }}>{{ ucfirst($k) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-medium">Urutkan</label>
                            <select name="sort" class="form-select">
                                <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>Terdekat</option>
                                <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                                <option value="termurah" {{ request('sort') == 'termurah' ? 'selected' : '' }}>Termurah</option>
                                <option value="termahal" {{ request('sort') == 'termahal' ? 'selected' : '' }}>Termahal</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100"><i class="bi bi-search"></i> Cari</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Events Grid -->
        @if($events->count() > 0)
        <div class="row g-4">
            @foreach($events as $event)
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
                        <p class="text-muted small mb-1">
                            <i class="bi bi-calendar3"></i> {{ $event->tanggal->format('d M Y') }}
                            @if($event->waktu) {{ $event->waktu }} @endif
                        </p>
                        <p class="text-muted small mb-1">
                            <i class="bi bi-geo-alt"></i> {{ Str::limit($event->lokasi, 40) }}
                        </p>
                        <p class="text-muted small mb-2">
                            <i class="bi bi-people"></i> Sisa {{ $event->sisa_kuota }} dari {{ $event->kuota }} tiket
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

        <div class="mt-4">
            {{ $events->withQueryString()->links() }}
        </div>
        @else
        <div class="text-center py-5">
            <i class="bi bi-calendar-x" style="font-size:4rem;color:var(--gray-300);"></i>
            <h5 class="mt-3 text-muted">Tidak ada event ditemukan</h5>
            <p class="text-muted">Coba ubah filter pencarian Anda.</p>
        </div>
        @endif
    </div>
</section>
@endsection
