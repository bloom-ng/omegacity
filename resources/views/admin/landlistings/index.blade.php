@extends("layouts.admin-layout")

@section("title", "Land Listings")

@section("content")
    <div class="w-full">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Land Listings</h1>
            <a href="{{ route("admin.landlistings.create") }}"
                class="bg-black shadow-md hover:scale-110 transition-transform duration-200 text-white font-medium py-2 px-4 rounded-lg">
                <i class="fas fa-plus"></i> Add New Listing
            </a>
        </div>


        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex flex-col md:flex-row md:items-center md:justify-between">
                <form method="GET" action="{{ route("admin.landlistings.index") }}" class="relative max-w-xs">
                    <input type="text" name="search" value="{{ request("search") }}"
                        class="form-input w-full pl-10 pr-4 py-2 border rounded-lg" placeholder="Search listings...">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <tr>
                            <th class="py-3 px-6 text-left">#</th>
                            <th class="py-3 px-6 text-left">Property Name</th>
                            <th class="py-3 px-6 text-left">Location</th>
                            <th class="px-6 py-3 text-left ">Plot Size</th>
                            <th class="px-6 py-3 text-left ">Price</th>
                            <th class="px-6 py-3 text-left ">Status</th>
                            <th class="px-6 py-3 text-left">Agent Name</th>
                            <th class="px-6 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($listings as $listing)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $loop->iteration }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $listing->property_name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $listing->location }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $listing->plot_size }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    ₦{{ number_format($listing->selling_price, 2) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $statusColor = match ($listing->status) {
                                            "available" => "bg-green-100 text-green-800",
                                            "sold" => "bg-red-100 text-red-800",
                                            "reserved" => "bg-yellow-100 text-yellow-800",
                                            default => "bg-gray-100 text-gray-800",
                                        };
                                    @endphp
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColor }}">
                                        {{ ucfirst($listing->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $listing->agent->name ?? "N/A" }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route("admin.landlistings.show", $listing) }}"
                                        class="text-blue-600 hover:text-blue-900 mr-2">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route("admin.landlistings.edit", $listing) }}"
                                        class="text-indigo-600 hover:text-indigo-900 mr-2">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route("admin.landlistings.destroy", $listing) }}" method="POST"
                                        class="inline-block"
                                        onsubmit="return confirm('Are you sure you want to delete this listing?')">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-6 text-gray-500">No land listings found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 border-t border-gray-200">
                {{ $listings->links() }}
            </div>
        </div>
    </div>
@endsection
