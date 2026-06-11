<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Booking;
use App\Models\User;
use App\Models\Payment;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalEvents = Event::count();
        $activeEvents = Event::where('status', 'upcoming')->count();
        $totalBookings = Booking::count();
        $totalTransactions = Payment::where('status_payment', 'verified')->sum('jumlah_bayar');
        $pendingPayments = Payment::where('status_payment', 'pending')->count();
        $totalTickets = Ticket::where('status', 'active')->count();

        // Statistik booking per bulan (6 bulan terakhir)
        $bookingStats = Booking::select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"),
                DB::raw('COUNT(*) as total')
            )
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Statistik penjualan tiket per event (top 5)
        $topEvents = Event::withCount(['bookings' => function ($q) {
                $q->where('status_booking', 'confirmed');
            }])
            ->orderBy('bookings_count', 'desc')
            ->take(5)
            ->get();

        // Recent bookings
        $recentBookings = Booking::with(['user', 'event', 'payment'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalEvents',
            'activeEvents',
            'totalBookings',
            'totalTransactions',
            'pendingPayments',
            'totalTickets',
            'bookingStats',
            'topEvents',
            'recentBookings'
        ));
    }
}
