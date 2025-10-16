@extends('layouts.admin-layout')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Invoice #{{ $invoice->invoice_number }}</h1>
        <div class="flex space-x-2">
            <a href="{{ route('admin.invoices.show', $invoice) }}" 
               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Cancel
            </a>
            <button type="submit" form="edit-invoice-form" 
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Save Changes
            </button>
        </div>
    </div>

    <form id="edit-invoice-form" action="{{ route('admin.invoices.update', $invoice) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-6">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Invoice Details
                </h3>
            </div>
            <div class="px-4 py-5 sm:p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="invoice_number" class="block text-sm font-medium text-gray-700">Invoice Number</label>
                        <input type="text" name="invoice_number" id="invoice_number" 
                               value="{{ old('invoice_number', $invoice->invoice_number) }}"
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('invoice_number')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select id="status" name="status" 
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            <option value="draft" {{ old('status', $invoice->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="pending" {{ old('status', $invoice->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="paid" {{ old('status', $invoice->status) === 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="overdue" {{ old('status', $invoice->status) === 'overdue' ? 'selected' : '' }}>Overdue</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                        <input type="date" name="date" id="date" 
                               value="{{ old('date', $invoice->date->format('Y-m-d')) }}"
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="due_date" class="block text-sm font-medium text-gray-700">Due Date</label>
                        <input type="date" name="due_date" id="due_date" 
                               value="{{ old('due_date', $invoice->due_date->format('Y-m-d')) }}"
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('due_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="md:col-span-2">
                        <label for="client_id" class="block text-sm font-medium text-gray-700">Client</label>
                        <select id="client_id" name="client_id" 
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}" {{ old('client_id', $invoice->client_id) == $client->id ? 'selected' : '' }}>
                                    {{ $client->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('client_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-6">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Items
                    </h3>
                    <button type="button" onclick="addNewItem()" 
                            class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        + Add Item
                    </button>
                </div>
            </div>
            <div class="px-4 py-5 sm:p-6">
                <div id="items-container">
                    @foreach(old('items', $invoice->items) as $index => $item)
                        @php
                            $item = is_array($item) ? (object)$item : $item;
                        @endphp
                        <div class="item-row border-b border-gray-200 pb-4 mb-4">
                            <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                                <div class="md:col-span-5">
                                    <label class="block text-sm font-medium text-gray-700">Description</label>
                                    <input type="text" name="items[{{ $index }}][description]" 
                                           value="{{ old('items.' . $index . '.description', $item->description) }}"
                                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                                <div class="md:col-span-3">
                                    <label class="block text-sm font-medium text-gray-700">Details</label>
                                    <input type="text" name="items[{{ $index }}][details]" 
                                           value="{{ old('items.' . $index . '.details', $item->details ?? '') }}"
                                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Quantity</label>
                                    <input type="number" name="items[{{ $index }}][quantity]" min="1" step="1"
                                           value="{{ old('items.' . $index . '.quantity', $item->quantity) }}"
                                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Rate</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 sm:text-sm">$</span>
                                        </div>
                                        <input type="number" name="items[{{ $index }}][rate]" min="0" step="0.01"
                                               value="{{ old('items.' . $index . '.rate', $item->rate) }}"
                                               class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                </div>
                                <div class="flex items-end">
                                    <button type="button" onclick="removeItem(this)" 
                                            class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                        Remove
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-6">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Additional Information
                </h3>
            </div>
            <div class="px-4 py-5 sm:p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="tax_rate" class="block text-sm font-medium text-gray-700">Tax Rate (%)</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <input type="number" name="tax_rate" id="tax_rate" min="0" max="100" step="0.01"
                                   value="{{ old('tax_rate', $invoice->tax_rate) }}"
                                   class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pr-10 sm:text-sm border-gray-300 rounded-md">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm" id="percent">%</span>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <label for="discount" class="block text-sm font-medium text-gray-700">Discount</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">$</span>
                            </div>
                            <input type="number" name="discount" id="discount" min="0" step="0.01"
                                   value="{{ old('discount', $invoice->discount) }}"
                                   class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>
                </div>
                
                <div class="mt-6">
                    <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                    <div class="mt-1">
                        <textarea id="notes" name="notes" rows="3" 
                                 class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md">{{ old('notes', $invoice->notes) }}</textarea>
                    </div>
                    <p class="mt-2 text-sm text-gray-500">Any additional information or special instructions for this invoice.</p>
                </div>
            </div>
        </div>
        
        <div class="flex justify-end space-x-3 mt-6">
            <button type="button" onclick="window.history.back()" 
                    class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Cancel
            </button>
            <button type="submit" 
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Update Invoice
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    let itemCount = {{ count(old('items', $invoice->items)) }};
    
    function addNewItem() {
        const container = document.getElementById('items-container');
        const newItem = `
            <div class="item-row border-b border-gray-200 pb-4 mb-4">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                    <div class="md:col-span-5">
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <input type="text" name="items[${itemCount}][description]" 
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>
                    <div class="md:col-span-3">
                        <label class="block text-sm font-medium text-gray-700">Details</label>
                        <input type="text" name="items[${itemCount}][details]" 
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Quantity</label>
                        <input type="number" name="items[${itemCount}][quantity]" min="1" step="1" value="1"
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Rate</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">$</span>
                            </div>
                            <input type="number" name="items[${itemCount}][rate]" min="0" step="0.01" value="0.00"
                                   class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md" required>
                        </div>
                    </div>
                    <div class="flex items-end">
                        <button type="button" onclick="removeItem(this)" 
                                class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Remove
                        </button>
                    </div>
                </div>
            </div>
        `;
        
        container.insertAdjacentHTML('beforeend', newItem);
        itemCount++;
    }
    
    function removeItem(button) {
        const itemRow = button.closest('.item-row');
        if (itemRow) {
            itemRow.remove();
        }
    }
</script>
@endpush
@endsection
