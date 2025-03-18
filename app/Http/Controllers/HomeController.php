<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Payment;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function getPendingPayments(Request $request)
    {
        $request->validate([
            'rut' => 'required|string|exists:clients,rut',
        ]);

        $client = Client::where('rut', $request->rut)->first();

        if (!$client) {
            return response()->json(['error' => 'Cliente no encontrado.'], 404);
        }

        $payments = Payment::whereHas('subscription', function ($query) use ($client) {
            $query->where('client_id', $client->id);
        })->where('status', 'pending')->with('subscription.service')->get();

        return response()->json(['payments' => $payments]);
    }
}