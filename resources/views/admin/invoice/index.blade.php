@extends("layouts.admin-layout")

@section("content")
    <div class="w-full">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Invoices</h1>
            <a href="{{ route("admin.invoices.create") }}"
                class="bg-black shadow-md hover:scale-110 transition-transform duration-200  text-white font-medium py-2 px-4 rounded-lg">
                Create New Invoice
            </a>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="flex items-center space-x-2">
                        <form method="GET" action="{{ route("admin.invoices.index") }}" class="relative max-w-xs w-full">
                            <input type="text" name="search" value="{{ request("search") }}"
                                class="form-input w-full pl-10 pr-4 py-2 border rounded-lg"
                                placeholder="Search invoices...">

                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </form>
                        @if (request("search"))
                            <a href="{{ route("admin.invoices.index") }}" class="text-sm text-blue-600 hover:underline">
                                Clear
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">

                        <tr>
                            <th class="py-3 px-6 text-left">
                                Invoice Number
                            </th>
                            <th class="py-3 px-6 text-left">
                                Client
                            </th>
                            <th class="py-3 px-6 text-left">
                                Plot Description
                            </th>
                            <th class="py-3 px-6 text-left">
                                Date
                            </th>
                            <th class="py-3 px-6 text-left">
                                Quantity
                            </th>

                            <th class="py-3 px-6 text-left">
                                Amount
                            </th>

                            <th class="px-6 py-3 text-right">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
    @foreach ($invoices as $invoice)
        @php
            $items = json_decode($invoice->invoice_items, true);
             $totalQuantity = collect($items)->sum(fn($item) => (int) $item["quantity"]);
                                $subtotal = collect($items)->sum(fn($item) => $item["price"] * $item["quantity"]);
                                $vatPercent = $invoice->tax ?? 0;
                                $taxValue = $subtotal * ($vatPercent / 100);
                                $discount = $invoice->discount ?? 0;
                                $total = $subtotal + $taxValue - $discount;
                            @endphp

        <tr class="hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                INV-{{ $invoice->created_at->format('Ymd') }}{{ $invoice->id }}
            </td>

            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                {{ $invoice->client->first_name }} {{ $invoice->client->last_name }}
            </td>

            <td class="px-6 py-4 text-sm text-gray-900">
                @foreach ($items as $item)
                    {{ $item['description'] }}.<br>
                @endforeach
            </td>

            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                {{ \Carbon\Carbon::parse($invoice->date)->format('M d, Y') }}
            </td>

            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                {{ $totalQuantity }}
            </td>

            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                ₦{{ number_format($total, 2) }}
            </td>

            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <a href="{{ route('admin.invoices.show', $invoice->id) }}"
                    class="text-blue-600 hover:text-blue-900 mr-2"><i class="fas fa-eye"></i></a>

                <a href="{{ route('admin.invoices.edit', $invoice->id) }}"
                    class="text-indigo-600 hover:text-indigo-900 mr-2"><i class="fas fa-edit"></i></a>

                <form action="{{ route('admin.invoices.destroy', $invoice->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-900 mr-2"
                        onclick="return confirm('Are you sure you want to delete this invoice?')">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>

                <a href="{{ route('admin.invoices.pdf', $invoice) }}"
                    class="text-green-600 hover:text-green-900 ml-2" title="View/Print PDF" target="_blank">
                    <i class="fas fa-file-pdf"></i>
                </a>
            </td>
        </tr>
    @endforeach
</tbody>

                </table>
            </div>

            <div class="px-6 py-4 border-t border-gray-200">
                {{ $invoices->links() }}
            </div>
        </div>
    </div>
@endsection
