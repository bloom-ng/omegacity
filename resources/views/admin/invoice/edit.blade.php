@extends("layouts.admin-layout")

@section("title", "Edit Invoice")

@section("content")
<div class="w-full">
    <div class="flex justify-between items-center mb-6">
        <h4 class="text-2xl font-medium text-gray-800">
            Edit Invoice : {{ $invoice->invoice_number }}
        </h4>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden p-8">
        <form id="edit-invoice-form"
              action="{{ route('admin.invoices.update', $invoice->id) }}"
              method="POST">
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
                                {{ $invoice->client_id == $client->id ? 'selected' : '' }}>
                                {{ $client->first_name }} {{ $client->last_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Date -->
                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                    <input type="date" name="date" id="date" required
                        value="{{ old('date', $invoice->date->format('Y-m-d')) }}"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-black">
                </div>
            </div>

            <!-- Invoice Items -->
            <div class="mb-8">
                <h3 class="text-lg font-medium text-gray-700 mb-4">Invoice Items</h3>

                <div id="invoice-items" class="space-y-4">
                    @php
                        $items = is_array($invoice->invoice_items)
                            ? $invoice->invoice_items
                            : json_decode($invoice->invoice_items, true);
                    @endphp

                    @foreach ($items as $index => $item)
                        <div class="grid grid-cols-12 gap-4 items-end">
                            <div class="col-span-5">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                <textarea name="items[{{ $index }}][description]" rows="2" required
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-black">{{ $item['description'] }}</textarea>
                            </div>
                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Quantity</label>
                                <input type="number" name="items[{{ $index }}][quantity]" value="{{ $item['quantity'] }}" min="1" required
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-black">
                            </div>
                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Price</label>
                                <input type="number" name="items[{{ $index }}][price]" value="{{ $item['price'] }}" min="0" step="0.01" required
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-black">
                            </div>
                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tax (%)</label>
                                <input type="number" name="items[{{ $index }}][tax]" value="{{ $item['tax'] ?? 0 }}" min="0" max="100" step="0.01"
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
                    value="{{ $invoice->discount ?? 0 }}"
                    class="w-full md:w-1/3 border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-black">
            </div>

            <!-- Buttons -->
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="window.history.back()"
                    class="px-4 py-2 border border-gray-300 rounded-md bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                    Cancel
                </button>
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-black hover:bg-gray-800">
                    <i class="fas fa-save mr-2"></i> Update Invoice
                </button>
            </div>
        </form>
    </div>
</div>

@push("scripts")
<script>
let itemCount = {{ count($items) }};

function addNewItem() {
    const container = document.getElementById('invoice-items');
    const newItem = document.createElement('div');
    newItem.className = 'grid grid-cols-12 gap-4 items-end';
    newItem.innerHTML = `
        <div class="col-span-5">
            <textarea name="items[${itemCount}][description]" rows="2" required
                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-black"></textarea>
        </div>
        <div class="col-span-2">
            <input type="number" name="items[${itemCount}][quantity]" value="1" min="1" required
                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-black">
        </div>
        <div class="col-span-2">
            <input type="number" name="items[${itemCount}][price]" min="0" step="0.01" required
                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-black">
        </div>
        <div class="col-span-2">
            <input type="number" name="items[${itemCount}][tax]" value="0" min="0" max="100" step="0.01"
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
        </div>`;
    container.appendChild(newItem);
    itemCount++;
}

function removeItem(button) {
    if (document.querySelectorAll('#invoice-items > div').length > 1) {
        button.closest('.grid').remove();
    }
}
</script>
@endpush
@endsection
