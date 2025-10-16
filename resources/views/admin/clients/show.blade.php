@extends("layouts.admin-layout")

@section("title", "Client Details: " . $client->name)

@section("content")
<div class="w-full px-4">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 space-y-3 sm:space-y-0">
        <h1 class="text-2xl font-bold text-gray-800">
            <i class="fas fa-user-tie me-2"></i>Client Details
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
                <i class="fas fa-info-circle me-2"></i>Client Information
            </h5>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Column 1 -->
                <div>
                    <h6 class="text-gray-500 mb-1">Name</h6>
                    <p class="mb-3 font-medium text-gray-800">{{ $client->name }}</p>

                    <h6 class="text-gray-500 mb-1">Email</h6>
                    <p class="mb-3">
                        <a href="mailto:{{ $client->email }}" class="hover:underline">
                            <i class="fas fa-envelope me-2"></i>{{ $client->email }}
                        </a>
                    </p>
                </div>

                <!-- Column 2 -->
                <div>
                    <h6 class="text-gray-500 mb-1">Phone</h6>
                    <p class="mb-3">
                        <a href="tel:{{ $client->phone }}" class=" hover:underline">
                            <i class="fas fa-phone me-2"></i>{{ $client->phone }}
                        </a>
                    </p>

                    <h6 class="text-gray-500 mb-1">Address Information</h6>
                    <p class="font-medium text-gray-800">
                        <i class="fas fa-map-marker-alt me-2"></i>{{ $client->address }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Invoices Section -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="flex justify-between items-center bg-gray-100 px-6 py-3 border-b">
            <h5 class="font-semibold text-primary flex items-center">
                <i class="fas fa-file-invoice me-2"></i>Invoices
            </h5>
           
        </div>

        <div class="p-0">
            @if ($client->invoices->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Invoice #</th>
                                <th>Date</th>

                                <th class="text-end">Total</th>

                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($client->invoices as $invoice)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a href="{{ route('admin.invoices.show', $invoice->id) }}" class="text-primary">
                                            {{ $invoice->invoice_number }}
                                        </a>
                                    </td>
                                    <td>{{ $invoice->date->format('M d, Y') }}</td>

                                    <td class="text-end">${{ number_format($invoice->total, 2) }}</td>

                                    <td class="text-end">
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('admin.invoices.show', $invoice->id) }}"
                                                class="btn btn-outline-primary" data-bs-toggle="tooltip" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.invoices.edit', $invoice->id) }}"
                                                class="btn btn-outline-secondary" data-bs-toggle="tooltip" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('admin.invoices.print', $invoice->id) }}" target="_blank"
                                                class="btn btn-outline-secondary" data-bs-toggle="tooltip" title="Print">
                                                <i class="fas fa-print"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-6">
                    <div class="mb-3">
                        <i class="fas fa-file-invoice fa-3x text-gray-400"></i>
                    </div>
                    <h5 class="text-gray-600 font-medium">No invoices found</h5>
                    <p class="text-gray-500">This client doesn’t have any invoices yet.</p>

                </div>
            @endif
        </div>
    </div>
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
