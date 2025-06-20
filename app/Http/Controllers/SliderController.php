<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::latest()->get();
        return view('sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('sliders.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|array',
            'description' => 'nullable|array',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|url',
            'status' => 'nullable|integer'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('sliders', 'public');
        }

        Slider::create($validated);

        return redirect()->route('sliders.index')
            ->with('success', 'Slider created successfully.');
    }

    public function edit(Slider $slider)
    {
        return view('sliders.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $validated = $request->validate([
            'title' => 'required|array',
            'description' => 'nullable|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|url',
            'status' => 'nullable|integer'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($slider->image) {
                Storage::disk('public')->delete($slider->image);
            }
            $validated['image'] = $request->file('image')->store('sliders', 'public');
        }

        $slider->update($validated);

        return redirect()->route('sliders.index')
            ->with('success', 'Slider updated successfully.');
    }

    public function destroy(Slider $slider)
    {
        if ($slider->image) {
            Storage::disk('public')->delete($slider->image);
        }
        
        $slider->delete();

        return redirect()->route('sliders.index')
            ->with('success', 'Slider deleted successfully.');
    }
} 