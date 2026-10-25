<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sub; // ← updated to use the Sub model
use App\Models\FeedbackNew;

class SubscriptionController extends Controller
{
    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'payment' => 'required|string',
            'contact' => 'required|string|max:255',
        ]);

        // Save to 'sub' table using the Sub model
        Sub::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'contact' => $validated['contact'],
            'payment' => $validated['payment'],
            'plan_name' => $request->input('plan'),
            'price' => $request->input('price'),

            'duration' => 1,

            'feature' => $validated['payment'] . ' payment by ' . $validated['name'],
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Subscription successful! You will receive an email shortly.');
    }
   public function showMembers()
{
    $members = Sub::all();
    $feedbacks = FeedbackNew::latest()->get();

    return view('trainer.dashboard', compact('members', 'feedbacks'));
}
}
