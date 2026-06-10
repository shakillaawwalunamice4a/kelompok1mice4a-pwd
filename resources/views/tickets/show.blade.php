@extends('layouts.app')

@section('title', 'E-Ticket')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card" style="border-radius:16px;overflow:hidden;">
                    <!-- Header -->
                    <div class="p-4 text-center text-white" style="background:linear-gradient(135deg,var(--primary),var(--secondary));">
                        <i class="bi bi-ticket-perforated-fill fs-1"></i>
                        <h4 class="fw-bold mt-2 mb-0">E-TICKET</h4>
                    </div>

                    <!-- QR Code -->
                    <div class="text-center p-4 bg-white">
                        {!! $qrCode !!}
                        <p class="mt-2 mb-0 fw-bold" style="color:var(--primary);">{{ $ticket->kode_tiket }}</p>
                    </div>

                    <!-- Ticket Details -->
                    <div class="card-body p-4">
                        <div class="text-center mb-3">
                            <span class="badge badge-{{ $ticket->status }} fs-6">{{ ucfirst($ticket->status) }}</span>
                        </div>

                        <h5 class="fw-bold text-center mb-3">{{ $ticket->event->nama_event }}</h5>

                        <table class="table table-sm mb-0">
                            <tr>
                                <td class="text-muted"><i class="bi bi-calendar3"></i> Tanggal</td>
                                <td class="fw-bold text-end">{{ $ticket->event->tanggal->format('d F Y') }}</td>
                            </tr>
                            @if($ticket->event->waktu)
                            <tr>
                                <td class="text-muted"><i class="bi bi-clock"></i> Waktu</td>
                                <td class="fw-bold text-end">{{ $ticket->event->waktu }}</td>
                            </tr>
                            @endif
                            <tr>
                                <td class="text-muted"><i class="bi bi-geo-alt"></i> Lokasi</td>
                                <td class="fw-bold text-end">{{ $ticket->event->lokasi }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted"><i class="bi bi-person"></i> Peserta</td>
                                <td class="fw-bold text-end">{{ $ticket->user->name }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted"><i class="bi bi-envelope"></i> Email</td>
                                <td class="text-end small">{{ $ticket->user->email }}</td>
                            </tr>
                        </table>
                    </div>

                    <!-- Actions -->
                    <div class="p-4 pt-0 d-flex gap-2">
                        @if($ticket->isActive())
                        <a href="{{ route('tickets.download', $ticket) }}" class="btn btn-primary flex-fill fw-bold">
                            <i class="bi bi-download"></i> Download PDF
                        </a>
                        @endif
                        <a href="{{ route('tickets.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
