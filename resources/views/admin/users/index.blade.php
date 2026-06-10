@extends('layouts.admin')

@section('page-title', 'Kelola Users')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0">Daftar Users</h4>
        <p class="text-muted small mb-0">Kelola akun peserta terdaftar</p>
    </div>
</div>

<!-- Search -->
<div class="card p-3 mb-4" style="border-radius:10px;">
    <form method="GET" class="row g-2">
        <div class="col-md-6">
            <input type="text" name="search" class="form-control" placeholder="Cari nama atau email..." value="{{ request('search') }}">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-outline-primary w-100"><i class="bi bi-search"></i></button>
        </div>
    </form>
</div>

<!-- Users Table -->
<div class="card" style="border-radius:12px;">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Booking</th>
                    <th>Terdaftar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle d-flex align-items-center justify-content-center me-2" style="width:36px;height:36px;background:var(--primary);color:white;font-size:0.8rem;font-weight:600;">
                                {{ strtoupper($user->name[0]) }}
                            </div>
                            <span class="fw-medium">{{ $user->name }}</span>
                        </div>
                    </td>
                    <td><small>{{ $user->email }}</small></td>
                    <td><small>{{ $user->phone ?? '-' }}</small></td>
                    <td><span class="badge bg-primary">{{ $user->bookings_count }}</span></td>
                    <td><small>{{ $user->created_at->format('d M Y') }}</small></td>
                    <td>
                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Hapus user ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">{{ $users->links() }}</div>
@endsection
