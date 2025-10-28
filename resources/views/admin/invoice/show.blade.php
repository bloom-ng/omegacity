@extends("layouts.admin-layout")

@section("content")
    <div class="w-full px-4">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 space-y-3 sm:space-y-0">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Invoice: INV-{{ $invoice->created_at->format('Ymd') }}{{ $invoice->id }}</h1>
                <div class="flex items-center">

                    <div class="ml-4 text-sm text-gray-500">
                        Created on {{ $invoice->created_at->format("M d, Y") }}
                    </div>
                </div>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route("admin.invoices.pdf", $invoice) }}" target="_blank"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black">
                    <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    Download PDF
                </a>
                <a href="{{ route("admin.invoices.edit", $invoice) }}"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-gray-700 hover:scale-105 transition-transform duration-200">
                    Edit Invoice
                </a>
            </div>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-6">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Invoice Information
                </h3>
            </div>
            <div class="px-4 py-5 sm:p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Client Details</h4>
                        <div class="mt-1 text-sm font-bold text-gray-900">
                            {{ $invoice->client->first_name }} {{ $invoice->client->last_name }}<br>
                            {{ $invoice->client->address }}<br>
                            {{ $invoice->client->email }}<br>
                            {{ $invoice->client->phone }}

                        </div>
                    </div>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-500">Invoice #</span>
                             <span class="text-sm font-medium text-gray-500">Date</span>

                        </div>
                        <div class="flex justify-between">

                            <span class="text-sm text-gray-900 font-bold">INV-{{ $invoice->created_at->format('Ymd') }}{{ $invoice->id }}</span>
                            <span class="text-sm text-gray-900 font-bold">{{ $invoice->date->format("M d, Y") }}</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        @php
            $items = json_decode($invoice->invoice_items, true);
            $subtotal = collect($items)->sum(fn($item) => $item["price"] * $item["quantity"]);
            $taxAmount = $subtotal * ($invoice->tax / 100);
            $total = $subtotal + $taxAmount - $invoice->discount;
        @endphp

        <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-6">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Items
                </h3>
            </div>

            <div class="px-4 py-5 sm:p-0">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Item Description
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Quantity
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Unit Price (₦)
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Amount (₦)
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($items as $item)
                                <tr>
                                    <td class="px-6 py-4 text-sm font-bold text-gray-900">
                                        {{ $item["description"] }}
                                    </td>
                                    <td class="px-6 py-4 text-sm font-bold text-gray-500 text-right">
                                        {{ $item["quantity"] }}
                                    </td>
                                    <td class="px-6 py-4 text-sm font-bold text-gray-500 text-right">
                                        ₦{{ number_format($item["price"], 2) }}
                                    </td>
                                    <td class="px-6 py-4 text-sm font-bold text-gray-900 text-right">
                                        ₦{{ number_format($item["price"] * $item["quantity"], 2) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="border-t border-gray-200 px-4 py-5 sm:p-6">
                <div class="flex justify-end">
                    <div class="w-64">
                        

                        @if ($invoice->tax > 0)
                            <div class="flex justify-between py-2 text-sm text-gray-600">
                                <span>Tax ({{ $invoice->tax }}%)</span>
                                <span>₦{{ number_format($taxAmount, 2) }}</span>
                            </div>
                        @endif

                        @if ($invoice->discount > 0)
                            <div class="flex justify-between py-2 text-sm text-gray-600">
                                <span>Discount</span>
                                <span>-₦{{ number_format($invoice->discount, 2) }}</span>
                            </div>
                        @endif

                        <div
                            class="flex justify-between pt-4 mt-4 border-t border-gray-200 text-base font-medium text-gray-900">
                            <span>Total</span>
                            <span>₦{{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
