<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use App\Models\Receipt;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReceiptController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $receipts = Receipt::with('client')
            ->when($search, function ($query, $search) {
                $query->whereHas('client', function ($q) use ($search) {
                    $q->where('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%");
                })
                    ->orWhere('receipt_items', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->appends(['search' => $search]);

        return view('admin.receipts.index', compact('receipts', 'search'));
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
        return view('admin.receipts.create', compact('clients'));
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

        $receipt = Receipt::create([
            'client_id' => $data['client_id'],
            'date' => $data['date'],
            'receipt_items' => json_encode($data['items']),
            'tax' => $taxPercentage,
            'discount' => $discount,
        ]);

        return redirect()
            ->route('admin.receipts.index')
            ->with('success', 'Receipt created successfully!')
            ->with('subtotal', $subtotal)
            ->with('total', $total);
    }







    /**
     * Display the specified resource.
     */
    public function show(Receipt $receipt)
    {
        $receipt->load('client');
        return view('admin.receipts.show', compact('receipt'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Receipt $receipt)
    {
        $clients = Client::all();
        return view('admin.receipts.edit', compact('receipt', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Receipt $receipt)
{
    $data = $request->validate([
        'client_id' => 'required|exists:clients,id',
        'date' => 'required|date',
        'discount' => 'nullable|numeric|min:0',
        'items' => 'required|array|min:1',
        'items.*.description' => 'required|string',
        'items.*.quantity' => 'required|numeric|min:1',
        'items.*.price' => 'required|numeric|min:0',
        'tax' => 'nullable|numeric|min:0|max:100',
    ]);


    $subtotal = collect($data['items'])
        ->sum(fn($item) => $item['price'] * $item['quantity']);

    $vatPercent = $data['tax'] ?? 0;
    $vatAmount = ($subtotal * $vatPercent) / 100;

    $discount = $data['discount'] ?? 0;

    $total = ($subtotal + $vatAmount) - $discount;


    $receipt->update([
        'client_id' => $data['client_id'],
        'date' => $data['date'],
        'receipt_items' => json_encode($data['items']),
        'tax' => $vatPercent,
        'discount' => $discount,
    ]);

    return redirect()
        ->route('admin.receipts.index')
        ->with('success', 'Receipt updated successfully!')
        ->with('subtotal', $subtotal)
        ->with('vat_amount', $vatAmount)
        ->with('total', $total);
}





    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Receipt $receipt)
    {
        $receipt->delete();

        return redirect()->route('admin.receipts.index')
            ->with('success', 'Receipt deleted successfully!');
    }

    /**
     * Generate PDF for the specified receipt.
     */
    public function generatePDF(Receipt $receipt)
    {
        $receipt->load('client');

        $pdf = PDF::loadView('admin.receipts.pdf', compact('receipt'));

        return $pdf->stream('receipt-' . $receipt->created_at->format('Ymd') . $receipt->id . '.pdf');
    }
}
