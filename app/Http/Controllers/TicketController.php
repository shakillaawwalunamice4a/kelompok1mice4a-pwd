<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tickets = auth()->user()->tickets()
            ->with(['event', 'booking'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('tickets.index', compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        if ($ticket->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403);
        }

        $ticket->load(['event', 'booking', 'user']);
        $qrCode = QrCode::size(200)->generate(route('tickets.verify', $ticket->kode_tiket));

        return view('tickets.show', compact('ticket', 'qrCode'));
    }

    public function downloadPdf(Ticket $ticket)
    {
        if ($ticket->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403);
        }

        $ticket->load(['event', 'booking', 'user']);
        $qrCode = QrCode::size(150)->generate(route('tickets.verify', $ticket->kode_tiket));

        $pdf = \PDF::loadView('tickets.pdf', compact('ticket', 'qrCode'));
        return $pdf->download('e-ticket-' . $ticket->kode_tiket . '.pdf');
    }

    public function verify($kode)
    {
        $ticket = Ticket::where('kode_tiket', $kode)->with(['event', 'user'])->first();

        if (!$ticket) {
            return view('tickets.verify', ['status' => 'invalid']);
        }

        return view('tickets.verify', [
            'status' => $ticket->isActive() ? 'valid' : 'invalid',
            'ticket' => $ticket,
        ]);
    }
}
