<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\BookingLog;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function bookings()
    {
        $analytics = BookingLog::select('action', DB::raw('count(*) as total'))
            ->groupBy('action')->get();
        return response()->json($analytics);
    }
}
