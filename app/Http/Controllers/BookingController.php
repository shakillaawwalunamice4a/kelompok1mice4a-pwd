<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Event;
use App\Models\Ticket;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $bookings = auth()->user()->bookings()
            ->with(['event', 'payment'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('bookings.index', compact('bookings'));
    }

    public function create(Event $event)
    {
        if ($event->isFull()) {
            return back()->with('error', 'Maaf, kuota tiket sudah habis!');
        }

        return view('bookings.create', compact('event'));
    }

    public function store(Request $request, Event $event)
    {
        $request->validate([
            'jumlah_tiket' => 'required|integer|min:1|max:' . $event->sisa_kuota,
        ]);

        if ($event->isFull()) {
            return back()->with('error', 'Maaf, kuota tiket sudah habis!');
        }

        $totalHarga = $event->harga * $request->jumlah_tiket;

        $booking = Booking::create([
            'user_id' => auth()->id(),
            'event_id' => $event->id,
            'jumlah_tiket' => $request->jumlah_tiket,
            'total_harga' => $totalHarga,
            'status_booking' => 'pending',
        ]);

        return redirect()->route('bookings.payment', $booking)
            ->with('success', 'Booking berhasil dibuat! Silakan lakukan pembayaran.');
    }

    public function show(Booking $booking)
    {
        $this->authorizeBooking($booking);
        $booking->load(['event', 'payment', 'tickets']);

        return view('bookings.show', compact('booking'));
    }

    public function cancel(Booking $booking)
    {
        $this->authorizeBooking($booking);

        if ($booking->status_booking !== 'pending') {
            return back()->with('error', 'Booking tidak bisa dibatalkan.');
        }

        $booking->update(['status_booking' => 'cancelled']);

        return redirect()->route('bookings.index')
            ->with('success', 'Booking berhasil dibatalkan.');
    }

    private function authorizeBooking(Booking $booking)
    {
        if ($booking->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403, 'Anda tidak memiliki akses ke booking ini.');
        }
    }
}
