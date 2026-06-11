<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class HomeController extends Controller
{
    public function index()
    {
        $upcomingEvents = Event::where('status', 'upcoming')
            ->where('tanggal', '>=', now())
            ->orderBy('tanggal', 'asc')
            ->take(6)
            ->get();

        $popularEvents = Event::where('status', 'upcoming')
            ->withCount(['bookings' => function ($q) {
                $q->where('status_booking', 'confirmed');
            }])
            ->orderBy('bookings_count', 'desc')
            ->take(4)
            ->get();

        return view('home', compact('upcomingEvents', 'popularEvents'));
    }
}
