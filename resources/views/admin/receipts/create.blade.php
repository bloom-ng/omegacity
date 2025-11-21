@extends("layouts.admin-layout")

@section("content")
    <div class="w-full">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Create New Receipt</h1>
        </div>

        <form action="{{ route("admin.receipts.store") }}" method="POST" class="bg-white rounded-lg shadow-md p-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Client Information -->
                <div>
                    <label for="client_id" class="block text-sm font-medium text-gray-700 mb-1">Client</label>
                    <select name="client_id" id="client_id" required
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent">
                        <option value="">Select Client</option>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}" @if (old("client_id") == $client->id) selected @endif>
                                {{ $client->first_name }} {{ $client->last_name }}</option>
                        @endforeach
                    </select>
                    @error("client_id")
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const select = document.querySelector('#client_id');
                            new window.Choices(select, {
                                searchEnabled: true,
                                callbackOnCreate: function() {
                                    select.classList.add('choices-single-no-scroll');
                                }
                            });
                        });
                    </script>
                </div>

                <!-- receipt Date -->
                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                    <input type="date" name="date" id="date" required
                        value="{{ old("date", now()->format("Y-m-d")) }}"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent">
                    @error("date")
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- receipt Items -->
            <div class="mb-8">

                <div id="receipt-items" class="space-y-4">
                    <!-- Item Row Template -->
                    <div class="grid grid-cols-12 gap-4 items-end">
                        <div class="col-span-5">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <input type="text" name="items[0][description]" required
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent">
                        </div>
                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Quantity</label>
                            <input type="number" name="items[0][quantity]" min="1" value="1" required
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent">
                        </div>
                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Price</label>
                            <div class="relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">

                                </div>
                                <input type="number" name="items[0][price]" required
                                    class="w-full border border-gray-300 rounded-md pl-7 pr-3 py-2 focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent">
                            </div>
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
                </div>

                <div class="mt-4">
                    <button type="button" onclick="addNewItem()"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-black hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black">
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




            <!-- Totals -->
            <div class="bg-gray-50 p-6 rounded-lg mb-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="discount" class="block text-sm font-medium text-gray-700 mb-1">Discount (%)</label>
                        <input type="number" name="discount" id="discount" min="0" step="0.01" value="0"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent">
                    </div>
                    <div>
                        <label for="tax_percentage" class="block text-sm font-medium text-gray-700 mb-1">VAT (%)</label>
                        <input type="number" name="tax" id="tax_percentage" value="0" min="0"
                            step="0.01"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black">
                    </div>
                    <div>
                        <label for="commission_percentage" class="block text-sm font-medium text-gray-700 mb-1">Commission
                            (%)</label>
                        <input type="number" name="commission_percentage" id="commission_percentage" value="0"
                            min="0" step="0.01"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black">
                    </div>

                    <div class="flex flex-col justify-end">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-gray-700">Subtotal:</span>
                            <span id="subtotalDisplay" class="font-medium">0.00</span>
                        </div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-gray-700">Tax:</span>
                            <span id="vatDisplay" class="font-medium">0.00</span>
                        </div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-gray-700">Discount:</span>
                            <span id="discountDisplay" class="font-medium">0.00</span>
                        </div>
                        <div class="flex justify-between items-center pt-2 mt-2 border-t border-gray-200">
                            <span class="text-lg font-bold">Total:</span>
                            <span id="totalDisplay" class="text-xl font-bold">0.00</span>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Form Actions -->
            <div class="flex justify-end space-x-3">
                <a href="{{ route("admin.receipts.index") }}"
                    class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black">
                    Cancel
                </a>
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-black hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black">
                    Save Receipt
                </button>
            </div>
        </form>
    </div>

    @push("scripts")
        <script>
            let itemCount = 1;

            function addNewItem() {
                const container = document.getElementById('receipt-items');
                const newItem = document.createElement('div');
                newItem.className = 'grid grid-cols-12 gap-4 items-end';
                newItem.innerHTML = `
            <div class="col-span-5">
                <input type="text" name="items[${itemCount}][description]" required
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent">
            </div>
            <div class="col-span-2">
                <input type="number" name="items[${itemCount}][quantity]" min="1" value="1" required
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent">
            </div>
            <div class="col-span-2">
                <div class="relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">

                    </div>
                    <input type="number" name="items[${itemCount}][price]" min="0" step="0.01" required
                        class="w-full border border-gray-300 rounded-md pl-7 pr-3 py-2 focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent">
                </div>
            </div>

            <div class="col-span-1 flex items-end">
                <button type="button" onclick="removeItem(this)"
                    class="text-red-600 hover:text-red-800 focus:outline-none">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            </div>
        `;
                container.appendChild(newItem);
                itemCount++;
                attachEventListeners();
            }

            function removeItem(button) {
                const itemsContainer = document.getElementById('receipt-items');
                if (itemsContainer.children.length > 1) {
                    button.closest('.grid').remove();
                    calculateTotals();
                }
            }

            function calculateTotals() {
                let subtotal = 0;

                document.querySelectorAll('#receipt-items .grid').forEach(row => {
                    const price = parseFloat(row.querySelector('input[name*="[price]"]').value) || 0;
                    const qty = parseFloat(row.querySelector('input[name*="[quantity]"]').value) || 0;
                    subtotal += price * qty;
                });

                const vatPercent = parseFloat(document.getElementById('tax_percentage').value) || 0;
                const discountPercent = parseFloat(document.getElementById('discount').value) || 0;

                const vatValue = (subtotal * vatPercent) / 100;
                const discountValue = (subtotal * discountPercent) / 100;
                const total = subtotal + vatValue - discountValue;

                document.getElementById('subtotalDisplay').textContent = subtotal.toFixed(2);
                document.getElementById('vatDisplay').textContent = vatValue.toFixed(2);
                document.getElementById('discountDisplay').textContent = discountValue.toFixed(2);
                document.getElementById('totalDisplay').textContent = total.toFixed(2);
            }

            function attachEventListeners() {
                // Add event listeners to all quantity, price, and tax inputs
                document.querySelectorAll('input[name*="[quantity]"], input[name*="[price]"]').forEach(
                    input => {
                        input.removeEventListener('input', calculateTotals);
                        input.addEventListener('input', calculateTotals);
                    });
            }

            // Initialize
            document.addEventListener('DOMContentLoaded', function() {
                attachEventListeners();
                document.getElementById('discount').addEventListener('input', calculateTotals);
                document.getElementById('tax_percentage').addEventListener('input', calculateTotals);
            });
        </script>
    @endpush
@endsection
