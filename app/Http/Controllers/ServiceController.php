<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::latest()->paginate(10);
        return view('services.index', compact('services'));
        // return response()->json($services);
    }

    public function create()
    {
        return view('services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'billing_cycle' => 'required|in:monthly,quarterly,semi-annually,annually',
            'description' => 'nullable|string',
        ]);

        Service::create($request->all());

        return redirect()->route('services.index')->with('success', 'Servicio creado correctamente.');
    }

    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'billing_cycle' => 'required|in:monthly,quarterly,semi-annually,annually',
            'description' => 'nullable|string',
        ]);

        $service->update($request->all());

        return redirect()->route('services.index')->with('success', 'Servicio actualizado correctamente.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success', 'Servicio eliminado correctamente.');
    }
}