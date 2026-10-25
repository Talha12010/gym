<?php

namespace App\Http\Controllers;
use App\Models\ClassModel;
use App\Http\Controllers\view;
use Illuminate\Http\Request;
use App\Models\Equipment; 
 class DashboardController extends Controller
{
    //
    public function  index(){
         return view('dashboard');
    }
    public function addEquipment(Request $request)
    {
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
  
    
}
