@extends('layouts.admin')

@section('page-title', 'Edit Event')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.events.index') }}" class="text-decoration-none" style="color:var(--primary);">
        <i class="bi bi-arrow-left"></i> Kembali ke Daftar Event
    </a>
</div>

<div class="card p-4" style="border-radius:12px;">
    <h5 class="fw-bold mb-4"><i class="bi bi-pencil" style="color:var(--primary);"></i> Edit Event</h5>

    <form method="POST" action="{{ route('admin.events.update', $event) }}" enctype="multipart/form-data">
        @csrf @method('PUT')
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
                <input type="text" name="nama_event" class="form-control" value="{{ old('nama_event', $event->nama_event) }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Kategori *</label>
                <select name="kategori" class="form-select" required>
                    @foreach(['conference','seminar','workshop','exhibition','webinar','other'] as $k)
                    <option value="{{ $k }}" {{ old('kategori', $event->kategori) == $k ? 'selected' : '' }}>{{ ucfirst($k) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12">
                <label class="form-label fw-medium">Deskripsi *</label>
                <textarea name="deskripsi" class="form-control" rows="4" required>{{ old('deskripsi', $event->deskripsi) }}</textarea>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Tanggal Mulai *</label>
                <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', $event->tanggal->format('Y-m-d')) }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" class="form-control" value="{{ old('tanggal_selesai', $event->tanggal_selesai?->format('Y-m-d')) }}">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Waktu</label>
                <input type="time" name="waktu" class="form-control" value="{{ old('waktu', $event->waktu) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Lokasi *</label>
                <input type="text" name="lokasi" class="form-control" value="{{ old('lokasi', $event->lokasi) }}" required>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-medium">Kuota *</label>
                <input type="number" name="kuota" class="form-control" min="1" value="{{ old('kuota', $event->kuota) }}" required>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-medium">Harga (Rp) *</label>
                <input type="number" name="harga" class="form-control" min="0" step="0.01" value="{{ old('harga', $event->harga) }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Status *</label>
                <select name="status" class="form-select" required>
                    @foreach(['upcoming','ongoing','completed','cancelled'] as $s)
                    <option value="{{ $s }}" {{ old('status', $event->status) == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Poster Event</label>
                @if($event->poster)
                <div class="mb-2">
                    <img src="{{ Storage::url($event->poster) }}" class="rounded" style="max-height:80px;">
                </div>
                @endif
                <input type="file" name="poster" class="form-control" accept="image/*">
                <small class="text-muted">Kosongkan jika tidak ingin mengubah</small>
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary fw-bold px-4">
                <i class="bi bi-check-circle"></i> Update Event
            </button>
            <a href="{{ route('admin.events.index') }}" class="btn btn-outline-secondary ms-2">Batal</a>
        </div>
    </form>
</div>
@endsection
