<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedbacknew;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        Feedbacknew::create($validated);

        return redirect()->back()->with('success', 'Thank you for your feedback!');
    }




}
