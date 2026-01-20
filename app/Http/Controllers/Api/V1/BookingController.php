<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use App\Models\Booking;
use App\Models\BookingLog;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // List bookings with pagination
    public function index()
    {
        return Booking::paginate(10);
    }

    // Create a new booking
    public function store(BookingRequest $request)
    {
        $booking = Booking::create($request->validated());

        // Log the booking creation in analytics DB
        BookingLog::create([
            'booking_id' => $booking->id,
            'action' => 'created'
        ]);

        return response()->json($booking, 201);
    }

    // Get booking details
    public function show($id)
    {
        $booking = Booking::findOrFail($id);
        return response()->json($booking);
    }

    // Update a booking
    public function update(BookingRequest $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update($request->validated());

        // Log the update in analytics DB
        BookingLog::create([
            'booking_id' => $booking->id,
            'action' => 'updated'
        ]);

        return response()->json($booking);
    }

    // Cancel a booking
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => 'cancelled']);

        // Log the cancellation in analytics DB
        BookingLog::create([
            'booking_id' => $booking->id,
            'action' => 'cancelled'
        ]);

        return response()->json(['message' => 'Booking cancelled']);
    }
}
