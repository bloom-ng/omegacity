@extends('layouts.admin-layout')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Invoice #{{ $invoice->invoice_number }}</h1>
            <div class="flex items-center mt-2">
                @php
                    $statusClasses = [
                        'paid' => 'bg-green-100 text-green-800',
                        'pending' => 'bg-yellow-100 text-yellow-800',
                        'overdue' => 'bg-red-100 text-red-800',
                        'draft' => 'bg-gray-100 text-gray-800',
                    ][$invoice->status] ?? 'bg-gray-100 text-gray-800';
                @endphp
                <span class="px-3 py-1 text-sm font-medium rounded-full {{ $statusClasses }}">
                    {{ ucfirst($invoice->status) }}
                </span>
                <div class="ml-4 text-sm text-gray-500">
                    Created on {{ $invoice->created_at->format('M d, Y') }}
                </div>
            </div>
        </div>
        <div class="flex space-x-2">
            <a href="{{ route('admin.invoices.download', $invoice) }}" 
               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
                Download PDF
            </a>
            <a href="{{ route('admin.invoices.edit', $invoice) }}" 
               class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
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
                    <h4 class="text-sm font-medium text-gray-500">Bill To</h4>
                    <div class="mt-1 text-sm text-gray-900">
                        {{ $invoice->client->name }}<br>
                        {{ $invoice->client->address }}<br>
                        {{ $invoice->client->city }}, {{ $invoice->client->state }} {{ $invoice->client->zip_code }}<br>
                        {{ $invoice->client->country }}
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-500">Invoice #</span>
                        <span class="text-sm text-gray-900">{{ $invoice->invoice_number }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-500">Date</span>
                        <span class="text-sm text-gray-900">{{ $invoice->date->format('M d, Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-500">Due Date</span>
                        <span class="text-sm text-gray-900">{{ $invoice->due_date->format('M d, Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-500">Status</span>
                        <span class="text-sm text-gray-900">{{ ucfirst($invoice->status) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Item
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Quantity
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Rate
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Amount
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($invoice->items as $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $item->description }}
                                @if($item->details)
                                <p class="text-gray-500 text-xs mt-1">{{ $item->details }}</p>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">
                                {{ $item->quantity }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">
                                ${{ number_format($item->rate, 2) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-right">
                                ${{ number_format($item->quantity * $item->rate, 2) }}
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
                    <div class="flex justify-between py-2 text-sm text-gray-600">
                        <span>Subtotal</span>
                        <span>${{ number_format($invoice->subtotal, 2) }}</span>
                    </div>
                    @if($invoice->tax_rate > 0)
                    <div class="flex justify-between py-2 text-sm text-gray-600">
                        <span>Tax ({{ $invoice->tax_rate }}%)</span>
                        <span>${{ number_format($invoice->tax_amount, 2) }}</span>
                    </div>
                    @endif
                    @if($invoice->discount > 0)
                    <div class="flex justify-between py-2 text-sm text-gray-600">
                        <span>Discount</span>
                        <span>-${{ number_format($invoice->discount, 2) }}</span>
                    </div>
                    @endif
                    <div class="flex justify-between pt-4 mt-4 border-t border-gray-200 text-base font-medium text-gray-900">
                        <span>Total</span>
                        <span>${{ number_format($invoice->total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($invoice->notes)
    <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-6">
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Notes
            </h3>
        </div>
        <div class="px-4 py-5 sm:p-6">
            <p class="text-sm text-gray-700 whitespace-pre-line">{{ $invoice->notes }}</p>
        </div>
    </div>
    @endif

    <div class="flex justify-end space-x-3 mt-6">
        @if($invoice->status !== 'paid')
        <form action="{{ route('admin.invoices.markAsPaid', $invoice) }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                Mark as Paid
            </button>
        </form>
        @endif
        <a href="{{ route('admin.invoices.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Back to Invoices
        </a>
    </div>
</div>
@endsection
