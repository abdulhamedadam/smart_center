<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::latest()->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'meta_title' => 'nullable',
            'meta_description' => 'nullable',
            'status' => 'nullable|integer'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title['en']);

        Service::create($data);

        return redirect()->route('services.index')
            ->with('success', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'meta_title' => 'nullable',
            'meta_description' => 'nullable',
            'status' => 'nullable|integer'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title['en']);

        $service->update($data);

        return redirect()->route('services.index')
            ->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('services.index')
            ->with('success', 'Service deleted successfully.');
    }
} 