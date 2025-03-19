<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\Subscription;
use App\Models\Payment;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard', [
            'totalClients' => Client::count(),
            'totalInvoices' => Invoice::count(),
            'totalPaidInvoices' => Invoice::where('status', 'paid')->count(),
            'totalPendingInvoices' => Invoice::where('status', 'unpaid')->count(),
            'totalSubscriptions' => Subscription::count(),
            'totalPayments' => Payment::sum('amount'),
        ]);
    }
}
