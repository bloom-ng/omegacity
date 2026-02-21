<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use App\Models\UpdateReceipt;
use App\Services\AgentTargetService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UpdateReceiptController extends Controller
{
    public function __construct(AgentTargetService $targetService)
    {
        $this->targetService = $targetService;
    }
    public function index(Request $request)
    {
        $search = $request->input('search');

        $update_receipts = UpdateReceipt::with('client')
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

        return view('admin.update-receipt.index', compact('update_receipts', 'search'));
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
        return view('admin.update-receipt.create', compact('clients'));
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
            'payment_type' => 'required|in:full_payment,installment',
            'items' => 'required|array|min:1',
            'items.*.description' => 'required|string',
            'items.*.quantity' => 'required|numeric|min:1',
            'items.*.price' => 'required|numeric|min:0',
            'grand_total' => 'required|numeric|min:0',
        ]);

        $receipt = UpdateReceipt::create([
            'client_id' => $data['client_id'],
            'date' => $data['date'],
            'receipt_items' => $data['items'],
            'tax' => $data['tax'] ?? 0,
            'discount' => $data['discount'] ?? 0,
            'payment_type' => $data['payment_type'],
            'grand_total' => $data['grand_total'],
        ]);

        // Update agent target
        $client = Client::find($data['client_id']);
        if ($client && $client->assigned_agent_id) {
            $receiptDate = \Carbon\Carbon::parse($data['date']);
            $this->targetService->updateTargetProgress(
                $client->assigned_agent_id,
                $receiptDate->year,
                $receiptDate->month
            );
        }

        return redirect()
            ->route('admin.update-receipts.index')
            ->with('success', 'Receipt created successfully!');
    }







    /**
     * Display the specified resource.
     */
    public function show(UpdateReceipt $update_receipt)
    {
        $update_receipt->load('client');

        return view('admin.update-receipt.show', [
            'update_receipt' => $update_receipt
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UpdateReceipt $update_receipt)
    {
        $clients = Client::all();
        return view('admin.update-receipt.edit', compact('update_receipt', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UpdateReceipt $update_receipt)
    {
        $data = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'date' => 'required|date',
            'discount' => 'nullable|numeric|min:0',
            'tax' => 'nullable|numeric|min:0',
            'payment_type' => 'required|in:full_payment,installment',
            'items' => 'required|array|min:1',
            'items.*.description' => 'required|string',
            'items.*.quantity' => 'required|numeric|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ]);

        // Keep grand_total unchanged
        $update_receipt->update([
            'client_id' => $data['client_id'],
            'date' => $data['date'],
            'receipt_items' => $data['items'],
            'tax' => $data['tax'] ?? 0,
            'discount' => $data['discount'] ?? 0,
            'payment_type' => $data['payment_type'],
        ]);

        // Update agent target if needed
        $client = Client::find($data['client_id']);
        if ($client && $client->assigned_agent_id) {
            $receiptDate = \Carbon\Carbon::parse($data['date']);
            $this->targetService->updateTargetProgress(
                $client->assigned_agent_id,
                $receiptDate->year,
                $receiptDate->month
            );
        }

        return redirect()
            ->route('admin.update-receipts.index')
            ->with('success', 'Receipt updated successfully!');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UpdateReceipt $update_receipt)
    {
        // Get client and date before deleting
        $client = $update_receipt->client;
        $receiptDate = $update_receipt->date;

        $update_receipt->delete();

        // Update agent's target progress automatically
        if ($client && $client->assigned_agent_id) {
            $this->targetService->updateTargetProgress(
                $client->assigned_agent_id,
                $receiptDate->year,
                $receiptDate->month
            );
        }

        return redirect()->route('admin.update-receipts.index')
            ->with('success', 'Updated Receipt deleted successfully!');
    }

    /**
     * Generate PDF for the specified receipt.
     */
    public function generatereceiptPDF(UpdateReceipt $update_receipt)
    {
        $update_receipt->load('client');

        $pdf = PDF::loadView('admin.update-receipt.pdf', compact('update_receipt'));
        return $pdf->stream('receipt-' . $update_receipt->created_at->format("Ymd") . $update_receipt->id . '.pdf');
    }
}