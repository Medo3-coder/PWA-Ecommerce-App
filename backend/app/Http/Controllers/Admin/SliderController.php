<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Sliders\StoreRequest;
use App\Http\Requests\Admin\Sliders\UpdateRequest;

class SliderController extends Controller
{
    public function sliders()
    {
        $sliders = Slider::limit(3)->get();

        if($sliders->isEmpty()){
            return response()->json(['message'=> 'No sliders available now'] , 404);
        }

        return response()->json(['sliders' => $sliders], 200);
    }

    // Display a listing of the sliders.
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.sliders.index', compact('sliders'));
    }

    // Show the form for creating a new slider.
    public function create()
    {
        return view('admin.sliders.create');
    }

    // Store a newly created slider in storage.
    public function store(StoreRequest $request)
    {
        $validated = $request->validated();
        $slider = new Slider();
        $slider->is_active = $validated['is_active'] ?? true;
        if (isset($validated['image'])) {
            $slider->image = $validated['image'];
        }
        $slider->save();
        return redirect()->route('admin.sliders.index')->with('success', 'Slider created successfully.');
    }

    // Display the specified slider.
    public function show(Slider $slider)
    {
        return view('admin.sliders.show', compact('slider'));
    }

    // Show the form for editing the specified slider.
    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    // Update the specified slider in storage.
    public function update(UpdateRequest $request, Slider $slider)
    {
        $slider->is_active = $request->input('is_active', $slider->is_active);
        if ($request->hasFile('image')) {
            $slider->image = $request->file('image');
        }
        $slider->save();
        return redirect()->route('admin.sliders.index')->with('success', 'Slider updated successfully.');
    }

    // Remove the specified slider from storage.
    public function destroy(Slider $slider)
    {
        $slider->delete();
        return response()->json(['message' => 'Slider deleted successfully']);
    }
}
