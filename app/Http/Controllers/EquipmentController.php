<?php

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    // Show all equipment
  public function index()
{
    $equipments = Equipment::all();
    return view('dashboard', compact('equipments')); // You must return the dashboard view
}



    // Show form to add equipment
    public function create()
    {
        return view('create');
    }

    // Store equipment
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,avif|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images/equipments'), $imageName);

        Equipment::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => 'images/equipments/' . $imageName,
        ]);

        return redirect()->route('dashboard')->with('success', 'Equipment Added Successfully!');
    }
}
