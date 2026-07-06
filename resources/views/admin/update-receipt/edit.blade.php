@extends("layouts.admin-layout")

@section("title", "Edit Receipt")

@section("content")
    <div class="w-full">
        <div class="flex justify-between items-center mb-6">
            <h4 class="text-2xl font-medium text-gray-800">
Edit Updated Receipt : {{ $update_receipt->receipt_number }}
            </h4>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden p-8">
            <form id="edit-receipt-form" action="{{ route("admin.update-receipts.update", $update_receipt->id) }}" method="POST">
                @csrf
                @method("PUT")

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Client -->
                    <div>
                        <label for="client_id" class="block text-sm font-medium text-gray-700 mb-1">Client</label>
                        <select name="client_id" id="client_id" required
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-black">
                            <option value="">Select Client</option>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}"
                                    {{ $update_receipt->client_id == $client->id ? "selected" : "" }}>
                                    {{ $client->first_name }} {{ $client->last_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Date -->
                    <div>
                        <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                        <input type="date" name="date" id="date" required
                            value="{{ old("date", $update_receipt->date->format("Y-m-d")) }}"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-black">
                    </div>
                </div>

                <!-- Receipt Items -->
                <div class="mb-8">
                    <h3 class="text-lg font-medium text-gray-700 mb-4">Receipt Items</h3>

                    <div id="receipt-items" class="space-y-4">
                       @php
    $items = $update_receipt->receipt_items ?? [];
@endphp
                        @foreach ($items as $index => $item)
                            <div class="grid grid-cols-12 gap-4 items-end">
                                <div class="col-span-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                    <textarea name="items[{{ $index }}][description]" rows="2" required
                                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-black">{{ $item["description"] }}</textarea>
                                </div>
                                <div class="col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Quantity</label>
                                    <input type="number" name="items[{{ $index }}][quantity]"
                                        value="{{ $item["quantity"] ?? 1 }}" min="1" required
                                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-black">
                                </div>
                                <div class="col-span-3">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Price</label>
                                    <input type="number" name="items[{{ $index }}][price]"
                                        value="{{ $item["price"] }}" min="0" step="0.01" required
                                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-black">
                                </div>

                                <div class="col-span-1 flex items-end">
                                    <button type="button" onclick="removeItem(this)"
                                        class="text-red-600 hover:text-red-800 focus:outline-none">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-4">
                        <button type="button" onclick="addNewItem()"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-black hover:bg-gray-800">
                            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            Add Item
                        </button>
                    </div>
                </div>

                <!-- Discount -->
                <div class="mb-6">
                    <label for="discount" class="block text-sm font-medium text-gray-700 mb-1">Discount (%)</label>
                    <input type="number" name="discount" id="discount" min="0" step="0.01"
                        value="{{ $update_receipt->discount ?? 0 }}"
                        class="w-full md:w-1/3 border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-black">
                </div>
                <div class="mb-6">
                    <label for="tax" class="block text-sm font-medium text-gray-700 mb-1">VAT (%)</label>
                    <input type="number" name="tax" id="tax" min="0" step="0.01"
                        value="{{ $update_receipt->tax ?? 0 }}"
                        class="w-full md:w-1/3 border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-black">
                </div>

                <div class="mb-6">
                    <label for="commission_percentage" class="block text-sm font-medium text-gray-700 mb-1">Commission
                        (%)</label>
                    <input type="number" name="commission_percentage" id="commission_percentage" min="0"
                        step="0.01" value="{{ $update_receipt->commission_percentage ?? 0 }}"
                        class="w-full md:w-1/3 border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-black">
                </div>

                 <div class="mb-6">
                    <label for="grand_total" class="block text-sm font-medium text-gray-700 mb-1">Grand Total</label>
                    <input type="number" id="grand_total" name="grand_total" step="0.01"
                        value="{{ $update_receipt->grand_total ?? 0 }}"
                        class="w-full md:w-1/3 border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black">
                    <p class="text-sm text-gray-500 mt-1">Enter the total manually.</p>
                </div>

                <div class="mb-6" id="amount_paid_wrapper">
                    <label for="amount_paid" class="block text-sm font-medium text-gray-700 mb-1">Amount Paid</label>
                    <input type="number" id="amount_paid" name="amount_paid" step="0.01"
                        value="{{ $update_receipt->amount_paid ?? $update_receipt->grand_total ?? 0 }}"
                        class="w-full md:w-1/3 border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black">
                    <p class="text-sm text-gray-500 mt-1">Enter the amount paid (especially for installments).</p>
                </div>

                <div class="mb-6" id="balance_due_wrapper">
                    <label for="balance_due" class="block text-sm font-medium text-gray-700 mb-1">Balance Due</label>
                    <input type="number" id="balance_due" name="balance_due" step="0.01"
                        value="{{ $update_receipt->balance_due ?? 0 }}" readonly
                        class="w-full md:w-1/3 border border-gray-300 rounded-md px-3 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-black">
                </div>

                <!-- Payment Information -->
                <div class="bg-gray-50 p-6 rounded-lg mb-8">
                    <h3 class="text-lg font-medium text-gray-700 mb-4">Payment Details</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Payment Type -->
                        <div>
    <label class="block text-sm font-medium text-gray-700 mb-1">Payment Type</label>
    <select name="payment_type" id="payment_type"
        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-black">
        <option value="full_payment"
            {{ $update_receipt->payment_type === 'full_payment' ? 'selected' : '' }}>
            Full Payment
        </option>
        <option value="installment"
            {{ $update_receipt->payment_type === 'installment' ? 'selected' : '' }}>
            Installment
        </option>
    </select>
</div>

                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="window.history.back()"
                        class="px-4 py-2 border border-gray-300 rounded-md bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Cancel
                    </button>
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-black hover:bg-gray-800">
                        <i class="fas fa-save mr-2"></i> Update Receipt
                    </button>
                </div>
            </form>
        </div>
    </div>

   @push("scripts")
<script>
   let itemCount = {{ count($items) }};

function addNewItem() {
    const container = document.getElementById('receipt-items');
    const newItem = document.createElement('div');
    newItem.className = 'grid grid-cols-12 gap-4 items-end';
    newItem.innerHTML = `
        <div class="col-span-6">
            <textarea name="items[${itemCount}][description]" rows="2" required
                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-black"></textarea>
        </div>
        <div class="col-span-2">
            <input type="number" name="items[${itemCount}][quantity]" value="1" min="1" required
                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-black">
        </div>
        <div class="col-span-3">
            <input type="number" name="items[${itemCount}][price]" min="0" step="0.01" required
                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-black">
        </div>
        <div class="col-span-1 flex items-end">
            <button type="button" onclick="removeItem(this)"
                class="text-red-600 hover:text-red-800 mb-2">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </button>
        </div>`;
    container.appendChild(newItem);
    itemCount++;
    calculateGrandTotal();
}

function removeItem(button) {
    if (document.querySelectorAll('#receipt-items > div').length > 1) {
        button.closest('.grid').remove();
        calculateGrandTotal();
    }
}

function calculateBalanceDue() {
    const grandTotalInput = document.getElementById('grand_total');
    let grandTotal = parseFloat(grandTotalInput.value);
    if (isNaN(grandTotal)) {
        grandTotal = 0;
    }

    const amountPaidInput = document.getElementById('amount_paid');
    let amountPaid = parseFloat(amountPaidInput.value);
    if (isNaN(amountPaid)) {
        amountPaid = 0;
    }

    const balanceDue = Math.max(0, grandTotal - amountPaid);
    document.getElementById('balance_due').value = balanceDue.toFixed(2);
}

document.addEventListener('input', function(e) {
    if (e.target.matches('#grand_total, #amount_paid')) {
        calculateBalanceDue();
    }
});

// Initial calculation
document.addEventListener('DOMContentLoaded', function() {
    calculateBalanceDue();
});

</script>
@endpush

@endsection
