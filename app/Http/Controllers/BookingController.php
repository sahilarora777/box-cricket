<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Slot;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function showBookingForm($slotId)
    {
        $slot = Slot::findOrFail($slotId);
        
        if ($slot->isBooked()) {
            return redirect()->back()->with('error', 'This slot is already booked!');
        }

        return view('bookings.create', compact('slot'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'slot_id' => 'required|exists:slots,id',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
        ]);

        $slot = Slot::findOrFail($request->slot_id);

        if ($slot->isBooked()) {
            if ($request->ajax()) {
                return response()->json(['error' => 'This slot is already booked!'], 422);
            }
            return redirect()->back()->with('error', 'This slot is already booked!');
        }

        Booking::create([
            'slot_id' => $request->slot_id,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'booking_date' => $slot->date,
        ]);

        if ($request->ajax()) {
            return response()->json(['success' => 'Booking confirmed successfully!']);
        }

        return redirect()->route('slots.index')->with('success', 'Booking confirmed successfully!');
    }

    public function index()
    {
        $bookings = Booking::with('slot')->orderBy('created_at', 'desc')->get();
        return view('bookings.index', compact('bookings'));
    }
} 