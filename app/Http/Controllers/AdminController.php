<?php

namespace App\Http\Controllers;

use App\Models\Slot;
use App\Models\Booking;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function slots()
    {
        return view('admin.slots');
    }

    public function bookedSlots()
    {
        return view('admin.booked-slots');
    }

    public function getBookedSlotsByDate(Request $request)
    {
        $request->validate([
            'date' => 'required|date'
        ]);

        $date = $request->input('date');
        
        $bookedSlots = Slot::where('date', $date)
            ->whereHas('bookings')
            ->with(['bookings' => function($query) {
                $query->select('id', 'slot_id', 'customer_name', 'customer_email', 'booking_date', 'created_at');
            }])
            ->get()
            ->filter(function($slot) {
                return $slot->bookings->isNotEmpty();
            })
            ->map(function($slot) {
                $booking = $slot->bookings->first();
                if (!$booking) {
                    return null;
                }
                
                return [
                    'id' => $slot->id,
                    'date' => $slot->date,
                    'start_time' => $slot->start_time,
                    'end_time' => $slot->end_time,
                    'formatted_start_time' => \Carbon\Carbon::parse($slot->start_time)->format('g:i A'),
                    'formatted_end_time' => \Carbon\Carbon::parse($slot->end_time)->format('g:i A'),
                    'price' => $slot->price,
                    'customer_name' => $booking->customer_name,
                    'customer_email' => $booking->customer_email,
                    'booking_date' => $booking->booking_date,
                    'booked_at' => $booking->created_at ? $booking->created_at->format('M j, Y g:i A') : 'N/A'
                ];
            })
            ->filter(function($slot) {
                return $slot !== null;
            })
            ->values();

        return response()->json($bookedSlots);
    }

    public function createSlots()
    {
        return view('admin.create-slots');
    }

    public function viewBookings()
    {
        $bookings = Booking::with('slot')->orderBy('created_at', 'desc')->paginate(5);
        return view('admin.view-bookings', compact('bookings'));
    }

    public function storeSlots(Request $request)
    {

        $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'duration' => 'required|integer|min:30|max:120',
            'price' => 'required|integer|min:0',
        ]);


        $date = $request->input('date');
        $startTime = $request->input('start_time');
        $endTime = $request->input('end_time');
        $duration = $request->input('duration');
        $price = $request->input('price');

        $start = Carbon::parse($startTime);
        $end = Carbon::parse($endTime);
        $slotsCreated = 0;


        while ($start->addMinutes($duration) <= $end) {
            Slot::create([
                'date' => $date,
                'start_time' => $start->subMinutes($duration)->format('H:i:s'),
                'end_time' => $start->addMinutes($duration)->format('H:i:s'),
                'is_available' => true,
                'price' => $price
            ]);
            $slotsCreated++;
        }

        return redirect()->back()->with('success', "Successfully created {$slotsCreated} slots!");
    }
} 