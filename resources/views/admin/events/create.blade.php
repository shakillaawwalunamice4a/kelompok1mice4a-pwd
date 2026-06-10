@extends('layouts.admin')

@section('page-title', 'Tambah Event')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.events.index') }}" class="text-decoration-none" style="color:var(--primary);">
        <i class="bi bi-arrow-left"></i> Kembali ke Daftar Event
    </a>
</div>

<div class="card p-4" style="border-radius:12px;">
    <h5 class="fw-bold mb-4"><i class="bi bi-plus-circle" style="color:var(--primary);"></i> Tambah Event Baru</h5>

    <form method="POST" action="{{ route('admin.events.store') }}" enctype="multipart/form-data">
        @csrf
        @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0 small">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="row g-3">
            <div class="col-md-8">
                <label class="form-label fw-medium">Nama Event *</label>
                <input type="text" name="nama_event" class="form-control" value="{{ old('nama_event') }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Kategori *</label>
                <select name="kategori" class="form-select" required>
                    <option value="">Pilih Kategori</option>
                    <option value="conference" {{ old('kategori') == 'conference' ? 'selected' : '' }}>Conference</option>
                    <option value="seminar" {{ old('kategori') == 'seminar' ? 'selected' : '' }}>Seminar</option>
                    <option value="workshop" {{ old('kategori') == 'workshop' ? 'selected' : '' }}>Workshop</option>
                    <option value="exhibition" {{ old('kategori') == 'exhibition' ? 'selected' : '' }}>Exhibition</option>
                    <option value="webinar" {{ old('kategori') == 'webinar' ? 'selected' : '' }}>Webinar</option>
                    <option value="other" {{ old('kategori') == 'other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>
            <div class="col-12">
                <label class="form-label fw-medium">Deskripsi *</label>
                <textarea name="deskripsi" class="form-control" rows="4" required>{{ old('deskripsi') }}</textarea>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Tanggal Mulai *</label>
                <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal') }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" class="form-control" value="{{ old('tanggal_selesai') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Waktu</label>
                <input type="time" name="waktu" class="form-control" value="{{ old('waktu') }}">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Lokasi *</label>
                <input type="text" name="lokasi" class="form-control" value="{{ old('lokasi') }}" required>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-medium">Kuota *</label>
                <input type="number" name="kuota" class="form-control" min="1" value="{{ old('kuota') }}" required>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-medium">Harga (Rp) *</label>
                <input type="number" name="harga" class="form-control" min="0" step="0.01" value="{{ old('harga', 0) }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Poster Event</label>
                <input type="file" name="poster" class="form-control" accept="image/*">
                <small class="text-muted">Format: JPG, PNG (maks. 2MB)</small>
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary fw-bold px-4">
                <i class="bi bi-check-circle"></i> Simpan Event
            </button>
            <a href="{{ route('admin.events.index') }}" class="btn btn-outline-secondary ms-2">Batal</a>
        </div>
    </form>
</div>
@endsection
