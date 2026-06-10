<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\User;
use App\Models\Event;
use App\Models\Ticket;
use App\Models\Attendance;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BookingsExport;
use App\Exports\UsersExport;
use App\Exports\AttendanceExport;
use PDF;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.reports.index');
    }

    public function participantsReport(Request $request)
    {
        $query = Booking::with(['user', 'event', 'payment', 'tickets'])
            ->where('status_booking', 'confirmed');

        if ($request->filled('event_id')) {
            $query->where('event_id', $request->event_id);
        }

        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $bookings = $query->orderBy('created_at', 'desc')->get();
        $events = Event::orderBy('nama_event')->get();

        if ($request->filled('export') && $request->export === 'pdf') {
            $pdf = PDF::loadView('admin.reports.participants-pdf', compact('bookings'));
            return $pdf->download('laporan-peserta-' . now()->format('Y-m-d') . '.pdf');
        }

        if ($request->filled('export') && $request->export === 'excel') {
            return Excel::download(new BookingsExport($bookings), 'laporan-peserta-' . now()->format('Y-m-d') . '.xlsx');
        }

        return view('admin.reports.participants', compact('bookings', 'events'));
    }

    public function transactionsReport(Request $request)
    {
        $query = Payment::with(['booking.user', 'booking.event', 'verifier'])
            ->where('status_payment', 'verified');

        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $payments = $query->orderBy('created_at', 'desc')->get();
        $totalPendapatan = $payments->sum('jumlah_bayar');

        if ($request->filled('export') && $request->export === 'pdf') {
            $pdf = PDF::loadView('admin.reports.transactions-pdf', compact('payments', 'totalPendapatan'));
            return $pdf->download('laporan-transaksi-' . now()->format('Y-m-d') . '.pdf');
        }

        return view('admin.reports.transactions', compact('payments', 'totalPendapatan'));
    }

    public function attendanceReport(Request $request)
    {
        $query = Attendance::with(['user', 'event', 'ticket']);

        if ($request->filled('event_id')) {
            $query->where('event_id', $request->event_id);
        }

        $attendance = $query->orderBy('created_at', 'desc')->get();
        $events = Event::orderBy('nama_event')->get();

        if ($request->filled('export') && $request->export === 'excel') {
            return Excel::download(new AttendanceExport($attendance), 'laporan-kehadiran-' . now()->format('Y-m-d') . '.xlsx');
        }

        return view('admin.reports.attendance', compact('attendance', 'events'));
    }
}
