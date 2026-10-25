<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    public function store(Request $request)
    {
        // Validate data (optional, can add more rules)
        $request->validate([
            'class_name' => 'required',
            'trainer_name' => 'required',
            'class_date' => 'required|date',
            'class_time' => 'required',
        ]);

        // Save attendance
        Attendance::create([
            'class_name' => $request->class_name,
            'trainer_name' => $request->trainer_name,
            'class_date' => $request->class_date,
            'class_time' => $request->class_time,
        ]);

        return response()->json(['message' => 'Attendance marked successfully.']);
    }
}
