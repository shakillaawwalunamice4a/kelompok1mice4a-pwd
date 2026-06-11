@extends('layouts.app')

@section('title', 'Lupa Password')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-sm border-0" style="border-radius:16px;">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <i class="bi bi-key" style="font-size:3rem;color:var(--primary);"></i>
                        <h4 class="fw-bold mt-2">Lupa Password?</h4>
                        <p class="text-muted">Masukkan email Anda untuk mendapat link reset password.</p>
                    </div>

                    @if(session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label fw-medium">Email</label>
                            <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                value="{{ old('email') }}" placeholder="email@example.com" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold" style="border-radius:10px;">
                            Kirim Link Reset Password
                        </button>
                    </form>

                    <div class="text-center mt-4">
                        <a href="{{ route('login') }}" class="text-decoration-none" style="color:var(--primary);">
                            <i class="bi bi-arrow-left"></i> Kembali ke Login
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
