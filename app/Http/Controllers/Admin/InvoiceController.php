<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use App\Models\Invoice;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::paginate(10);
        return view('admin.invoice.index', compact('invoices'));
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
    public function store(StoreInvoiceRequest $request)
    {
        $data = $request->validated();

        // Calculate totals
        $subtotal = 0;
        $totalTax = 0;

        foreach ($data['items'] as $item) {
            $itemSubtotal = $item['quantity'] * $item['price'];
            $itemTax = $itemSubtotal * ($item['tax'] / 100);
            $subtotal += $itemSubtotal;
            $totalTax += $itemTax;
        }

        $discount = $data['discount'] ?? 0;
        $total = $subtotal + $totalTax - $discount;

        // Create invoice
        $invoice = Invoice::create([
            'client_id' => $data['client_id'],
            'date' => $data['date'],
            'discount' => $discount,
            'total' => $total,
            'description' => 'Invoice for ' . now()->format('F Y'),
            'quantity' => 0,
            'price' => 0,
            'tax' => $totalTax,
        ]);

        // Create items
        foreach ($data['items'] as $item) {
            $itemSubtotal = $item['quantity'] * $item['price'];
            $itemTax = $itemSubtotal * ($item['tax'] / 100);

            $invoice->items()->create([
                'description' => $item['description'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'tax' => $itemTax,
                'total' => $itemSubtotal + $itemTax,
            ]);
        }

        return redirect()->route('admin.invoices.index')
            ->with('success', 'Invoice created successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
