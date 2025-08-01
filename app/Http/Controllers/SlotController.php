<?php

namespace App\Http\Controllers;

use App\Models\Slot;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SlotController extends Controller
{
    public function index()
    {   
        return view('slots.index');
    }

    public function getSlotsByDate(Request $request)
    {
        $date = $request->input('date');
        
        // Get slots for the date that are available and not booked
        $slots = Slot::where('date', $date)
                    ->where('is_available', true)
                    ->whereDoesntHave('bookings')
                    ->orderBy('start_time')
                    ->get()
                    ->map(function ($slot) {
                        // Format times to AM/PM
                        $slot->formatted_start_time = Carbon::parse($slot->start_time)->format('g:i A');
                        $slot->formatted_end_time = Carbon::parse($slot->end_time)->format('g:i A');
                        $slot->date = $slot->date->format('Y-m-d'); // Ensure date is included
                        // Include price in response
                        $slot->price = $slot->price;
                        return $slot;
                    });

        return response()->json($slots);
    }

    public function createSlots(Request $request)
    {
        $date = $request->input('date');
        $startTime = $request->input('start_time');
        $endTime = $request->input('end_time');
        $duration = $request->input('duration', 60); // Default 60 minutes
        $price = $request->input('price', 0); // Default price 0

        $start = Carbon::parse($startTime);
        $end = Carbon::parse($endTime);

        while ($start->addMinutes($duration) <= $end) {
            Slot::create([
                'date' => $date,
                'start_time' => $start->subMinutes($duration)->format('H:i:s'),
                'end_time' => $start->addMinutes($duration)->format('H:i:s'),
                'is_available' => true,
                'price' => $price
            ]);
        }

        return redirect()->back()->with('success', 'Slots created successfully!');
    }
} 