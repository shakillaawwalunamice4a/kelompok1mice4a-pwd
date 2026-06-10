<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showPaymentForm(Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        if ($booking->payment) {
            return redirect()->route('bookings.show', $booking)
                ->with('info', 'Pembayaran sudah dilakukan untuk booking ini.');
        }

        $booking->load('event');

        return view('payments.upload', compact('booking'));
    }

    public function uploadPayment(Request $request, Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'metode_pembayaran' => 'required|string|in:bank_transfer,e_wallet,cash',
            'bukti_transfer' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $buktiPath = $request->file('bukti_transfer')->store('bukti-transfer', 'public');

        Payment::create([
            'booking_id' => $booking->id,
            'metode_pembayaran' => $request->metode_pembayaran,
            'bukti_transfer' => $buktiPath,
            'jumlah_bayar' => $booking->total_harga,
            'status_payment' => 'pending',
        ]);

        return redirect()->route('bookings.show', $booking)
            ->with('success', 'Bukti pembayaran berhasil diupload! Menunggu verifikasi admin.');
    }
}
