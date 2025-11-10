<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\View;

class InvoiceController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');

        $invoices = Invoice::with('client')
            ->when($search, function ($query, $search) {
                $query->whereHas('client', function ($q) use ($search) {
                    $q->where('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%");
                })
                    ->orWhere('invoice_items', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->appends(['search' => $search]);

        return view('admin.invoice.index', compact('invoices', 'search'));
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
        return view('admin.invoice.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'date' => 'required|date',
            'discount' => 'nullable|numeric|min:0',
            'tax' => 'nullable|numeric|min:0',
            'items' => 'required|array|min:1',
            'items.*.description' => 'required|string',
            'items.*.quantity' => 'required|numeric|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ]);

        $subtotal = collect($data['items'])->sum(fn($item) => $item['price'] * $item['quantity']);
        $taxPercentage = $data['tax'] ?? 0;

        $taxValue = ($subtotal * $taxPercentage) / 100;
        $discount = $data['discount'] ?? 0;

        $total = ($subtotal + $taxValue) - $discount;

        $invoice = Invoice::create([
            'client_id' => $data['client_id'],
            'date' => $data['date'],
            'invoice_items' => json_encode($data['items']),
            'tax' => $taxPercentage,
            'discount' => $discount,
        ]);

        return redirect()
            ->route('admin.invoices.index')
            ->with('success', 'Invoice created successfully!')
            ->with('subtotal', $subtotal)
            ->with('total', $total);
    }






    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        $invoice->load('client');
        return view('admin.invoice.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        $clients = Client::all();
        return view('admin.invoice.edit', compact('invoice', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        $data = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'date' => 'required|date',
            'discount' => 'nullable|numeric|min:0',
            'items' => 'required|array|min:1',
            'items.*.description' => 'required|string',
            'items.*.quantity' => 'required|numeric|min:1',
            'items.*.price' => 'required|numeric|min:0',
            'items.*.tax' => 'nullable|numeric|min:0|max:100',
        ]);

        $subtotal = collect($data['items'])->sum(fn($item) => $item['price'] * $item['quantity']);
        $totalTax = collect($data['items'])->sum(
            fn($item) => ($item['price'] * $item['quantity']) * (($item['tax'] ?? 0) / 100)
        );
        $discount = $data['discount'] ?? 0;
        $total = ($subtotal + $totalTax) - $discount;

        $invoice->update([
            'client_id' => $data['client_id'],
            'date' => $data['date'],
            'invoice_items' => json_encode($data['items']),
            'tax' => $totalTax,
            'discount' => $discount,
        ]);

        return redirect()
            ->route('admin.invoices.index')
            ->with('success', 'Invoice updated successfully!')
            ->with('subtotal', $subtotal)
            ->with('total', $total);
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return redirect()->route('admin.invoices.index')
            ->with('success', 'Invoice deleted successfully!');
    }

    /**
     * Generate PDF for the specified invoice.
     */
    public function generatePDF(Invoice $invoice)
    {
        $invoice->load('client');

        $pdf = PDF::loadView('admin.invoice.pdf', compact('invoice'));

        return $pdf->stream('invoice-' . $invoice->created_at->format('Ymd') . $invoice->id . '.pdf');
    }
}
