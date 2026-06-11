<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::where('status', 'upcoming');

        if ($request->filled('search')) {
            $query->where('nama_event', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'terbaru':
                    $query->orderBy('tanggal', 'desc');
                    break;
                case 'terlama':
                    $query->orderBy('tanggal', 'asc');
                    break;
                case 'termurah':
                    $query->orderBy('harga', 'asc');
                    break;
                case 'termahal':
                    $query->orderBy('harga', 'desc');
                    break;
            }
        } else {
            $query->orderBy('tanggal', 'asc');
        }

        $events = $query->paginate(9);
        $kategoris = ['conference', 'seminar', 'workshop', 'exhibition', 'webinar', 'other'];

        return view('events.index', compact('events', 'kategoris'));
    }

    public function show(Event $event)
    {
        $event->load(['bookings' => function ($q) {
            $q->where('status_booking', 'confirmed');
        }]);

        return view('events.show', compact('event'));
    }
}
