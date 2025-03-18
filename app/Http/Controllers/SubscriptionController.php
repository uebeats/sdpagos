<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\Client;
use App\Models\Service;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = Subscription::with(['client', 'service'])->latest()->paginate(10);
        return view('subscriptions.index', compact('subscriptions'));
        // return response()->json($subscriptions);
    }

    public function create()
    {
        $clients = Client::orderBy('name')->get();
        $services = Service::orderBy('name')->get();
        return view('subscriptions.create', compact('clients', 'services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'service_id' => 'required|exists:services,id',
            'start_date' => 'required|date',
            'next_billing_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:pending,paid,overdue',
        ]);

        Subscription::create($request->all());

        return redirect()->route('subscriptions.index')->with('success', 'Suscripción creada correctamente.');
    }

    public function edit(Subscription $subscription)
    {
        $clients = Client::orderBy('name')->get();
        $services = Service::orderBy('name')->get();
        return view('subscriptions.edit', compact('subscription', 'clients', 'services'));
    }

    public function update(Request $request, Subscription $subscription)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'service_id' => 'required|exists:services,id',
            'start_date' => 'required|date',
            'next_billing_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:pending,paid,overdue',
        ]);

        $subscription->update($request->all());

        return redirect()->route('subscriptions.index')->with('success', 'Suscripción actualizada correctamente.');
    }

    public function destroy(Subscription $subscription)
    {
        $subscription->delete();
        return redirect()->route('subscriptions.index')->with('success', 'Suscripción eliminada correctamente.');
    }
}