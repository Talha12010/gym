<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Facades\Log;
use App\Models\ClassModel;
use App\Models\Feedback;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Equipment;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Subscription;
use App\Models\Schedule;
use App\Models\Payment;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class DashboardController extends Controller


{
      public function index()
      {

    return view('admin.dashboard');
}

public function addCustomer(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role'  => 'required|string|max:255',
]);
        // Create new user
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'role'     => $request->role,
            'password' => Hash::make('password123'), // Set a default password or generate one
        ]);

        if ($user) {
            return response()->json(['success' => 'Customer added successfully!'], 201);
        } else {
            return response()->json(['error' => 'Failed to add customer'], 500);
        }
    }


    public function deleteCustomer(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        try {
            // Find and delete the user
            $user = User::where('email', $request->email)->first();

            if ($user) {
                $user->delete();
                return response()->json(['success' => 'Customer deleted successfully!'], 200);
            } else {
                return response()->json(['error' => 'Customer not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete customer: ' . $e->getMessage()], 500);
        }
    }


    public function editCustomer(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255'
        ]);

        try {
            // Find and update the user
            $user = User::where('email', $request->email)->first();

            if ($user) {
                $user->update([
                    'name' => $request->name,
                    'role' => $request->role
                ]);
                return response()->json(['success' => 'Customer updated successfully!'], 200);
            } else {
                return response()->json(['error' => 'Customer not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update customer: ' . $e->getMessage()], 500);
        }
    }


    public function viewCustomer(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        try {
            // Find the user
            $user = User::where('email', $request->email)->first();

            if ($user) {
                return response()->json([
                    'success' => true,
                    'customer' => [
                        'name' => $user->name,
                        'email' => $user->email,
                        'role' => $user->role,
                        'created_at' => $user->created_at->toDateTimeString()
                    ]
                ], 200);
            } else {
                return response()->json(['error' => 'Customer not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve customer: ' . $e->getMessage()], 500);
        }
    }

    public function updateCustomer(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255'
        ]);

        try {
            // Find and update the user
            $user = User::where('email', $request->email)->first();

            if ($user) {
                $user->update([
                    'name' => $request->name,
                    'role' => $request->role
                ]);
                return response()->json(['success' => 'Customer updated successfully!'], 200);
            } else {
                return response()->json(['error' => 'Customer not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update customer: ' . $e->getMessage()], 500);
        }
    }


    public function viewAllCustomers(Request $request)
    {
        try {
            // Get all users
            $customers = User::all()->map(function ($user) {
                return [
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role,
                    'created_at' => $user->created_at->toDateTimeString()
                ];
            });

            return response()->json([
                'success' => true,
                'customers' => $customers
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve customers: ' . $e->getMessage()], 500);
        }
    }


    //eqipments


/*
    public function addEquipment(Request $request)
    {
        dd('Controller method hit!');
        $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'maintenance_day' => 'required|date',
        ]);

        // Create new equipment
        $equipment = Equipment::create([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'maintenance_day' => $request->maintenance_day,
        ]);

        if ($equipment) {
            return response()->json(['success' => 'Equipment added successfully!'], 201);
        } else {
            return response()->json(['error' => 'Failed to add equipment'], 500);
        }
    }

    // Optionally add other equipment methods (e.g., delete, edit, view) if needed
   /* public function deleteEquipment(Request $request)
    {
        $request->validate([
            'equipment_id' => 'required|exists:equipment_table,equipment_id',
        ]);

        try {
            $equipment = Equipment::find($request->equipment_id);
            if ($equipment) {
                $equipment->delete();
                return response()->json(['success' => 'Equipment deleted successfully!'], 200);
            }
            return response()->json(['error' => 'Equipment not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete equipment: ' . $e->getMessage()], 500);
        }
    }
      */


      public function editEquipment(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'maintenance_day' => 'required|date',
        ]);

        $equipment = Equipment::where('name', $request->name)->first();
        if ($equipment) {
            $equipment->update([
                'quantity' => $request->quantity,
                'maintenance_day' => $request->maintenance_day,
            ]);
            return response()->json(['success' => 'Equipment edited successfully!']);
        }
        return response()->json(['error' => 'Equipment not found'], 404);
    }

    public function deleteEquipment(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $equipment = Equipment::where('name', $request->name)->first();
        if ($equipment) {
            $equipment->delete();
            return response()->json(['success' => 'Equipment deleted successfully!']);
        }
        return response()->json(['error' => 'Equipment not found'], 404);
    }

    public function viewEquipment(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $equipment = Equipment::where('name', $request->name)->first();
        if ($equipment) {
            return response()->json(['success' => true, 'equipment' => $equipment]);
        }
        return response()->json(['error' => 'Equipment not found'], 404);
    }

    public function updateEquipment(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'maintenance_day' => 'required|date',
        ]);

        $equipment = Equipment::where('name', $request->name)->first();
        if ($equipment) {
            $equipment->update([
                'quantity' => $request->quantity,
                'maintenance_day' => $request->maintenance_day,
            ]);
            return response()->json(['success' => 'Equipment updated successfully!']);
        }
        return response()->json(['error' => 'Equipment not found'], 404);
    }

    public function searchEquipment(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $equipment = Equipment::where('name', 'LIKE', "%{$request->name}%")->first();
        if ($equipment) {
            return response()->json(['success' => true, 'equipment' => $equipment]);
        }
        return response()->json(['success' => true, 'equipment' => null]);
    }


















    // trainer


    // Add Trainer
public function addTrainer(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
    ]);

    $trainer = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'role' => 'trainer', // Hardcode role as 'trainer'
        'password' => Hash::make('trainer123'), // Default password, you can customize this
    ]);

    if ($trainer) {
        return response()->json(['success' => 'Trainer added successfully!'], 201);
    } else {
        return response()->json(['error' => 'Failed to add trainer'], 500);
    }
}

// Edit Trainer
public function editTrainer(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users,email',
        'name' => 'required|string|max:255',
    ]);

    $trainer = User::where('email', $request->email)->where('role', 'trainer')->first();
    if ($trainer) {
        $trainer->update([
            'name' => $request->name,
        ]);
        return response()->json(['success' => 'Trainer updated successfully!'], 200);
    }
    return response()->json(['error' => 'Trainer not found'], 404);
}

// Delete Trainer
public function deleteTrainer(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users,email',
    ]);

    $trainer = User::where('email', $request->email)->where('role', 'trainer')->first();
    if ($trainer) {
        $trainer->delete();
        return response()->json(['success' => 'Trainer deleted successfully!'], 200);
    }
    return response()->json(['error' => 'Trainer not found'], 404);
}

// View Trainer
public function viewTrainer(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users,email',
    ]);

    $trainer = User::where('email', $request->email)->where('role', 'trainer')->first();
    if ($trainer) {
        return response()->json([
            'success' => true,
            'trainer' => [
                'name' => $trainer->name,
                'email' => $trainer->email,
                'role' => $trainer->role,
                'created_at' => $trainer->created_at->toDateTimeString()
            ]
        ], 200);
    }
    return response()->json(['error' => 'Trainer not found'], 404);
}

// Update Trainer
public function updateTrainer(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users,email',
        'name' => 'required|string|max:255',
    ]);

    $trainer = User::where('email', $request->email)->where('role', 'trainer')->first();
    if ($trainer) {
        $trainer->update([
            'name' => $request->name,
        ]);
        return response()->json(['success' => 'Trainer updated successfully!'], 200);
    }
    return response()->json(['error' => 'Trainer not found'], 404);
}

// Search Trainer
public function searchTrainer(Request $request)
{
    $request->validate([
        'email' => 'required|email',
    ]);

    $trainer = User::where('email', $request->email)->where('role', 'trainer')->first();
    if ($trainer) {
        return response()->json([
            'success' => true,
            'trainer' => [
                'name' => $trainer->name,
                'email' => $trainer->email,
                'role' => $trainer->role,
                'created_at' => $trainer->created_at->toDateTimeString()
            ]
        ], 200);
    }
    return response()->json(['success' => true, 'trainer' => null], 200);
}









// Add Feedback
public function addFeedback(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'feedback_text' => 'required|string',
    ]);

    Log::info('Attempting to use Feedback class');
    if (class_exists('App\Models\Feedback')) {
        Log::info('Feedback class exists');
    } else {
        Log::error('Feedback class does not exist');
    }

    $feedback = \App\Models\Feedback::create([
        'user_id' => $request->user_id,
        'feedback_text' => $request->feedback_text,
    ]);

    if ($feedback) {
        return response()->json(['success' => 'Feedback added successfully!'], 201);
    } else {
        return response()->json(['error' => 'Failed to add feedback'], 500);
    }
}

// Edit Feedback
public function editFeedback(Request $request)
{
    $request->validate([
        'feedback_id' => 'required|exists:feedback,feedback_id',
        'feedback_text' => 'required|string',
    ]);

    $feedback = Feedback::find($request->feedback_id);
    if ($feedback) {
        $feedback->update([
            'feedback_text' => $request->feedback_text,
        ]);
        return response()->json(['success' => 'Feedback updated successfully!'], 200);
    }
    return response()->json(['error' => 'Feedback not found'], 404);
}

// Delete Feedback
public function deleteFeedback(Request $request)
{
    $request->validate([
        'feedback_id' => 'required|exists:feedback,feedback_id',
    ]);

    $feedback = Feedback::find($request->feedback_id);
    if ($feedback) {
        $feedback->delete();
        return response()->json(['success' => 'Feedback deleted successfully!'], 200);
    }
    return response()->json(['error' => 'Feedback not found'], 404);
}

// View All Feedback
public function viewAllFeedback(Request $request)
{
    try {
        $feedback = Feedback::all()->map(function ($item) {
            return [
                'feedback_id' => $item->feedback_id,
                'user_id' => $item->user_id,
                'feedback_text' => $item->feedback_text,
                'created_at' => $item->created_at->toDateTimeString(),
            ];
        });

        return response()->json([
            'success' => true,
            'feedback' => $feedback
        ], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Failed to retrieve feedback: ' . $e->getMessage()], 500);
    }
}

// Update Feedback
public function updateFeedback(Request $request)
{
    $request->validate([
        'feedback_id' => 'required|exists:feedback,feedback_id',
        'feedback_text' => 'required|string',
    ]);

    $feedback = Feedback::find($request->feedback_id);
    if ($feedback) {
        $feedback->update([
            'feedback_text' => $request->feedback_text,
        ]);
        return response()->json(['success' => 'Feedback updated successfully!'], 200);
    }
    return response()->json(['error' => 'Feedback not found'], 404);
}

// Search Feedback
public function searchFeedback(Request $request)
{
    $request->validate([
        'feedback_id' => 'required|exists:feedback,feedback_id',
    ]);

    $feedback = Feedback::find($request->feedback_id);
    if ($feedback) {
        return response()->json([
            'success' => true,
            'feedback' => [
                'feedback_id' => $feedback->feedback_id,
                'user_id' => $feedback->user_id,
                'feedback_text' => $feedback->feedback_text,
                'created_at' => $feedback->created_at->toDateTimeString(),
            ]
        ], 200);
    }
    return response()->json(['success' => true, 'feedback' => null], 200);
}






















public function storeClass(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'class_name' => 'required|string|max:255',
            'max_capacity' => 'required|integer|min:1',
            'T_id' => 'required|exists:users,id',
        ]);

        // Create new class
        $class = ClassModel::create([
            'class_name' => $request->class_name,
            'max_capacity' => $request->max_capacity,
            'T_id' => $request->T_id,
        ]);

        if ($class) {
            return response()->json(['success' => 'Class added successfully!'], 201);
        } else {
            return response()->json(['error' => 'Failed to add class'], 500);
        }
    }
public function editClass(Request $request)
    {
        $request->validate([
            'C_id' => 'required|exists:classes,C_id',
            'class_name' => 'required|string|max:255',
            'max_capacity' => 'required|integer|min:1',
            'T_id' => 'required|exists:users,id',
        ]);

        $class = ClassModel::find($request->C_id);
        if ($class) {
            $class->update([
                'class_name' => $request->class_name,
                'max_capacity' => $request->max_capacity,
                'T_id' => $request->T_id,
            ]);
            return response()->json(['success' => 'Class updated successfully!'], 200);
        }
        return response()->json(['error' => 'Class not found'], 404);
    }

    // Delete Class
    public function deleteClass(Request $request)
    {
        $request->validate([
            'C_id' => 'required|exists:classes,C_id',
        ]);

        $class = ClassModel::find($request->C_id);
        if ($class) {
            $class->delete();
            return response()->json(['success' => 'Class deleted successfully!'], 200);
        }
        return response()->json(['error' => 'Class not found'], 404);
    }

    // View All Classes
    public function viewClasses()
    {
        $classes = ClassModel::all();
        return response()->json(['classes' => $classes], 200);
    }

    // Update Class (similar to edit)
    public function updateClass(Request $request)
    {
        $request->validate([
            'C_id' => 'required|exists:classes,C_id',
            'class_name' => 'required|string|max:255',
            'max_capacity' => 'required|integer|min:1',
            'T_id' => 'required|exists:users,id',
        ]);

        $class = ClassModel::find($request->C_id);
        if ($class) {
            $class->update([
                'class_name' => $request->class_name,
                'max_capacity' => $request->max_capacity,
                'T_id' => $request->T_id,
            ]);
            return response()->json(['success' => 'Class updated successfully!'], 200);
        }
        return response()->json(['error' => 'Class not found'], 404);
    }

    // Search Classes
    public function searchClasses(Request $request)
    {
        $request->validate([
            'class_name' => 'required|string|max:255',
        ]);

        $classes = ClassModel::where('class_name', 'like', '%' . $request->class_name . '%')->get();
        return response()->json(['classes' => $classes], 200);
    }








    public function addSubscription(Request $request)
    {
        $request->validate([
            'Plan_name' => 'required|string|max:255',
            'Duration' => 'required|integer|min:1',
            'Price' => 'required|numeric|min:0',
            'Feature' => 'required|array',
        ]);

        $subscription = Subscription::create([
            'Plan_name' => $request->Plan_name,
            'Duration' => $request->Duration,
            'Price' => $request->Price,
            'Feature' => json_encode($request->Feature), // Store as JSON
        ]);

        return response()->json(['success' => 'Subscription plan added successfully']);
    }

    // Edit Subscription Plan
    public function editSubscription(Request $request)
    {
        $request->validate([
            'Sub_id' => 'required|exists:subscriptions,Sub_id',
            'Plan_name' => 'required|string|max:255',
            'Duration' => 'required|integer|min:1',
            'Price' => 'required|numeric|min:0',
            'Feature' => 'required|array',
        ]);

        $subscription = Subscription::find($request->Sub_id);
        if (!$subscription) {
            return response()->json(['error' => 'Subscription plan not found'], 404);
        }

        $subscription->update([
            'Plan_name' => $request->Plan_name,
            'Duration' => $request->Duration,
            'Price' => $request->Price,
            'Feature' => json_encode($request->Feature), // Store as JSON
        ]);

        return response()->json(['success' => 'Subscription plan updated successfully']);
    }

    // Delete Subscription Plan
    public function deleteSubscription(Request $request)
    {
        $request->validate([
            'Sub_id' => 'required|exists:subscriptions,Sub_id',
        ]);

        $subscription = Subscription::find($request->Sub_id);
        if (!$subscription) {
            return response()->json(['error' => 'Subscription plan not found'], 404);
        }

        $subscription->delete();
        return response()->json(['success' => 'Subscription plan deleted successfully']);
    }

    // View All Subscription Plans
    public function viewAllSubscriptions()
{
    $subscriptions = Subscription::all();

    $subscriptions->transform(function ($subscription) {
        $subscription->Feature = json_decode($subscription->Feature ?? '[]', true);
        if (!is_array($subscription->Feature)) {
            $subscription->Feature = []; // Ensure it's always an array
        }
        return $subscription;
    });

    return response()->json(['success' => true, 'subscriptions' => $subscriptions]);
}


    // Update Subscription Plan (similar to edit but kept separate as per your structure)
    public function updateSubscription(Request $request)
    {
        return $this->editSubscription($request); // Reuses editSubscription logic
    }

    // Search Subscription Plan
    public function searchSubscription(Request $request)
    {
        $request->validate([
            'Sub_id' => 'required|exists:subscriptions,Sub_id',
        ]);

        $subscription = Subscription::find($request->Sub_id);
        if (!$subscription) {
            return response()->json(['error' => 'Subscription plan not found'], 404);
        }

        // Decode Feature from JSON to array for display
        $subscription->Feature = json_decode($subscription->Feature, true) ?? [];

        return response()->json(['success' => true, 'subscription' => $subscription]);
    }







    public function addSchedule(Request $request)
    {
        $request->validate([
            'C_id' => 'required|exists:classes,C_id',
            'day' => 'required|string|max:20',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        $schedule = Schedule::create([
            'C_id' => $request->C_id,
            'day' => $request->day,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return response()->json(['success' => 'Schedule added successfully']);
    }

    // Edit Schedule


    // Delete Schedule
    public function deleteSchedule(Request $request)
    {
        $request->validate([
            'S_id' => 'required|exists:schedule,S_id',
        ]);

        $schedule = Schedule::find($request->S_id);
        if (!$schedule) {
            return response()->json(['error' => 'Schedule not found'], 404);
        }

        $schedule->delete();
        return response()->json(['success' => 'Schedule deleted successfully']);
    }

    // View All Schedules
    public function viewAllSchedules()
    {
        $schedules = Schedule::with('class')->get();
        return response()->json(['success' => true, 'schedules' => $schedules]);
    }

    // Update Schedule (similar to edit but kept separate as per your structure)



    // Search Schedule
    public function searchSchedule(Request $request)
    {
        $request->validate([
            'S_id' => 'required|exists:schedule,S_id',
        ]);

        $schedule = Schedule::with('class')->find($request->S_id);
        if (!$schedule) {
            return response()->json(['error' => 'Schedule not found'], 404);
        }

        return response()->json(['success' => true, 'schedule' => $schedule]);
    }



    public function addPayment(Request $request)
    {
        try {
            $request->validate([
                'member_id' => 'required|exists:users,id',
                'P_mode' => 'required|string|max:255',
                'P_date' => 'required|date',
                'amount' => 'required|numeric|min:0',
            ]);

            $payment = Payment::create([
                'member_id' => $request->member_id,
                'P_mode' => $request->P_mode,
                'P_date' => $request->P_date,
                'amount' => $request->amount,
            ]);

            return response()->json(['success' => 'Payment added successfully'], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error adding payment: ' . $e->getMessage());
            return response()->json(['error' => 'Server error: ' . $e->getMessage()], 500);
        }
    }

    public function editPayment(Request $request)

    {
        Log::info($request->all());
        try {
            $request->validate([
                'P_ID' => 'required|exists:payments,P_ID', // Ensure the payment ID exists
                'member_id' => 'required|exists:users,id',
                'P_mode' => 'required|string|max:255',
                'P_date' => 'required|date',
                'amount' => 'required|numeric|min:0',
            ]);

            $payment = Payment::find($request->P_ID);
            if (!$payment) {
                return response()->json(['error' => 'Payment not found'], 404);
            }

            $payment->update([
                'member_id' => $request->member_id,
                'P_mode' => $request->P_mode,
                'P_date' => $request->P_date,
                'amount' => $request->amount,
            ]);

            return response()->json(['success' => 'Payment updated successfully'], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error updating payment: ' . $e->getMessage());
            return response()->json(['error' => 'Server error: ' . $e->getMessage()], 500);
        }
    }

    public function deletePayment(Request $request)
    {
        try {
            $request->validate([
                'P_ID' => 'required|exists:payments,P_ID',
            ]);

            $payment = Payment::find($request->P_ID);
            if (!$payment) {
                return response()->json(['error' => 'Payment not found'], 404);
            }

            $payment->delete();
            return response()->json(['success' => 'Payment deleted successfully'], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error deleting payment: ' . $e->getMessage());
            return response()->json(['error' => 'Server error: ' . $e->getMessage()], 500);
        }
    }

    public function viewPayment(Request $request)
    {
        try {
            $request->validate([
                'P_ID' => 'required|exists:payments,P_ID',
            ]);

            $payment = Payment::find($request->P_ID);
            if (!$payment) {
                return response()->json(['error' => 'Payment not found'], 404);
            }

            return response()->json([
                'success' => true,
                'payment' => [
                    'P_ID' => $payment->P_ID,
                    'member_id' => $payment->member_id,
                    'P_mode' => $payment->P_mode,
                    'P_date' => $payment->P_date,
                    'amount' => $payment->amount,
                    'created_at' => $payment->created_at->toDateTimeString(),
                ]
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error viewing payment: ' . $e->getMessage());
            return response()->json(['error' => 'Server error: ' . $e->getMessage()], 500);
        }
    }

    public function updatePayment(Request $request)
    {
        return $this->editPayment($request); // Reuse editPayment logic
    }

    public function searchPayment(Request $request)
    {
        try {
            $request->validate([
                'P_ID' => 'required|exists:payments,P_ID',
            ]);

            $payment = Payment::find($request->P_ID);
            if (!$payment) {
                return response()->json(['success' => true, 'payment' => null], 200);
            }

            return response()->json([
                'success' => true,
                'payment' => [
                    'P_ID' => $payment->P_ID,
                    'member_id' => $payment->member_id,
                    'P_mode' => $payment->P_mode,
                    'P_date' => $payment->P_date,
                    'amount' => $payment->amount,
                    'created_at' => $payment->created_at->toDateTimeString(),
                ]
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error searching payment: ' . $e->getMessage());
            return response()->json(['error' => 'Server error: ' . $e->getMessage()], 500);
        }
    }

    public function showPendingUsers()
{
    $pendingUsers = User::where('status', 'pending')->get();
    return view('admin.pending-users', compact('pendingUsers'));
}

public function approveUser($id)
{
    $user = User::findOrFail($id);
    $user->status = 'approved';
    $user->save();

    return redirect()->route('admin.pendingUsers')->with('success', 'User approved successfully!');
}
public function deleteUser($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return redirect()->back()->with('success', 'User deleted successfully.');
}



public function showSubscriptions()
{
    $subscriptions = DB::table('sub')->orderBy('created_at', 'desc')->get();

    // Group by month-year like "June 2025"
    $grouped = $subscriptions->groupBy(function ($item) {
        return Carbon::parse($item->created_at)->format('F Y');
    });

    return view('admin.records', ['groupedSubscriptions' => $grouped]);
}


}
