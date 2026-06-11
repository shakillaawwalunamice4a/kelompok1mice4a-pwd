<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Ticket;
use Illuminate\Support\Facades\Storage;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with(['user', 'event', 'payment']);

        if ($request->filled('status')) {
            $query->where('status_booking', $request->status);
        }

        if ($request->filled('search')) {
            $query->where('kode_booking', 'like', '%' . $request->search . '%')
                ->orWhereHas('user', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->search . '%');
                });
        }

        $bookings = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.transactions.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        $booking->load(['user', 'event', 'payment', 'tickets']);

        return view('admin.transactions.show', compact('booking'));
    }

    public function verifyPayment(Request $request, Payment $payment)
    {
        $request->validate([
            'status_payment' => 'required|in:verified,rejected',
            'catatan' => 'nullable|string',
        ]);

        $payment->update([
            'status_payment' => $request->status_payment,
            'catatan' => $request->catatan,
            'verified_at' => now(),
            'verified_by' => auth()->id(),
        ]);

        $booking = $payment->booking;

        if ($request->status_payment === 'verified') {
            $booking->update(['status_booking' => 'confirmed']);

            // Generate tickets for each tiket booked
            for ($i = 0; $i < $booking->jumlah_tiket; $i++) {
                Ticket::create([
                    'booking_id' => $booking->id,
                    'user_id' => $booking->user_id,
                    'event_id' => $booking->event_id,
                    'status' => 'active',
                ]);
            }
        } elseif ($request->status_payment === 'rejected') {
            $booking->update(['status_booking' => 'cancelled']);
        }

        return redirect()->route('admin.transactions.index')
            ->with('success', 'Pembayaran berhasil ' . ($request->status_payment === 'verified' ? 'diverifikasi' : 'ditolak') . '!');
    }
}
