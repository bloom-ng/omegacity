@extends("layouts.admin-layout")

@section("title", "Client Details: " . $client->first_name . ' ' . $client->last_name)

@section("content")
<div class="w-full px-4">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 space-y-3 sm:space-y-0">
        <h1 class="text-2xl font-bold text-gray-800">
            <i class="fas fa-user-tie me-2"></i> Client Details
        </h1>

        <div class="flex space-x-2">
            <a href="{{ route('admin.clients.edit', $client->id) }}"
                class="bg-black text-white py-2 px-4 rounded-lg shadow hover:scale-105 transition-transform duration-200">
                <i class="fas fa-edit me-1"></i> Edit Client
            </a>
            <a href="{{ route('admin.clients.index') }}"
                class="bg-gray-700 text-white py-2 px-4 rounded-lg shadow hover:scale-105 transition-transform duration-200">
                <i class="fas fa-arrow-left me-1"></i> Back to Clients
            </a>
        </div>
    </div>

    <!-- Client Info -->
    <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
        <div class="bg-gray-100 text-center py-3 border-b">
            <h5 class="m-0 font-semibold text-primary">
                <i class="fas fa-info-circle me-2"></i> Client Information
            </h5>
        </div>

        <div class="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div>
                <h6 class="text-gray-500 mb-1">Full Name</h6>
                <p class="font-medium text-gray-800">{{ $client->first_name }} {{ $client->last_name }}</p>
            </div>

            <div>
                <h6 class="text-gray-500 mb-1">Email</h6>
                <p>
                    @if($client->email)
                        <a href="" class="text-blue-600 hover:underline">
                            <i class="fas fa-envelope me-2"></i>{{ $client->email }}
                        </a>
                    @else
                        <span class="text-gray-400">N/A</span>
                    @endif
                </p>
            </div>

            <div>
                <h6 class="text-gray-500 mb-1">Phone</h6>
                <p>
                    @if($client->phone)
                        <a href="" class="text-blue-600 hover:underline">
                            <i class="fas fa-phone me-2"></i>{{ $client->phone }}
                        </a>
                    @else
                        <span class="text-gray-400">N/A</span>
                    @endif
                </p>
            </div>

            <div>
                <h6 class="text-gray-500 mb-1">Address</h6>
                <p class="font-medium text-gray-800">
                    <i class="fas fa-map-marker-alt me-2"></i>{{ $client->address ?? 'N/A' }}
                </p>
            </div>

            <div>
                <h6 class="text-gray-500 mb-1">Source</h6>
                <p class="font-medium text-gray-800">{{ $client->source ?? 'N/A' }}</p>
            </div>

            <div>
                <h6 class="text-gray-500 mb-1">Budget Range</h6>
                <p class="font-medium text-gray-800">{{ $client->budget_range ?? 'N/A' }}</p>
            </div>

            <div>
                <h6 class="text-gray-500 mb-1">Interested Land</h6>
                <p class="font-medium text-gray-800">
                    {{ optional($client->interestedLand)->property_name ?? 'N/A' }} <br>
                    {{ optional($client->interestedLand)->location }}
                </p>
            </div>

            <div>
                <h6 class="text-gray-500 mb-1">Follow-Up Date</h6>
                <p class="font-medium text-gray-800">
                    {{ $client->follow_up_date ? \Carbon\Carbon::parse($client->follow_up_date)->format('M d, Y') : 'N/A' }}
                </p>
            </div>

            <div>
                <h6 class="text-gray-500 mb-1">Status</h6>
                <span class="px-3 py-1 rounded-full text-sm
                    @if($client->status === 'prospect') bg-yellow-100 text-yellow-700
                    @elseif($client->status === 'active') bg-green-100 text-green-700
                    @elseif($client->status === 'inactive') bg-gray-100 text-gray-600
                    @else bg-blue-100 text-blue-700 @endif">
                    {{ ucfirst($client->status) }}
                </span>
            </div>

            <div class="md:col-span-2 lg:col-span-3">
                <h6 class="text-gray-500 mb-1">Remark</h6>
                <p class="font-medium text-gray-800 whitespace-pre-line">
                    {{ $client->remark ?? 'No remarks yet.' }}
                </p>
            </div>
        </div>
    </div>

    <!-- Optional Invoices Section (if applicable) -->
    @if(isset($client->invoices))
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="flex justify-between items-center bg-gray-100 px-6 py-3 border-b">
                <h5 class="font-semibold text-primary flex items-center">
                    <i class="fas fa-file-invoice me-2"></i> Invoices
                </h5>
            </div>

            <div class="p-0">
                @if ($client->invoices->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Invoice #</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Total</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($client->invoices as $invoice)
                                    <tr>
                                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                        <td class="px-6 py-4 text-blue-600">
                                            <a href="{{ route('admin.invoices.show', $invoice->id) }}">
                                                {{ $invoice->invoice_number }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $invoice->date->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4 text-right">${{ number_format($invoice->total, 2) }}</td>
                                        <td class="px-6 py-4 text-right space-x-2">
                                            <a href="{{ route('admin.invoices.show', $invoice->id) }}" class="text-blue-600 hover:text-blue-800">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.invoices.edit', $invoice->id) }}" class="text-gray-600 hover:text-gray-800">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('admin.invoices.print', $invoice->id) }}" target="_blank" class="text-gray-600 hover:text-gray-800">
                                                <i class="fas fa-print"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-6">
                        <i class="fas fa-file-invoice fa-3x text-gray-400 mb-3"></i>
                        <h5 class="text-gray-600 font-medium">No invoices found</h5>
                        <p class="text-gray-500">This client doesn’t have any invoices yet.</p>
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(el => new bootstrap.Tooltip(el));
    });
</script>
@endpush
@endsection
