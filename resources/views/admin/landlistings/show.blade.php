@extends("layouts.admin-layout")

@section("title", "Land Listing: " . $landlisting->property_name)

@section("content")
    <div class="w-full px-4">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 space-y-3 sm:space-y-0">
            <h1 class="text-2xl font-bold text-gray-800">
                <i class="fas fa-landmark me-2"></i>Land Listing Details
            </h1>

            <div class="flex space-x-2">
                <a href="{{ route("admin.landlistings.edit", $landlisting) }}"
                    class="bg-black text-white py-2 px-4 rounded-lg shadow hover:scale-105 transition-transform duration-200">
                    <i class="fas fa-edit me-1"></i> Edit Listing
                </a>
                <a href="{{ route("admin.landlistings.index") }}"
                    class="bg-gray-700 text-white py-2 px-4 rounded-lg shadow hover:scale-105 transition-transform duration-200">
                    <i class="fas fa-arrow-left me-1"></i> Back to Listings
                </a>
            </div>
        </div>

        <!-- Land Info -->
        <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
            <div class="bg-gray-100 text-center py-3 border-b">
                <h5 class="m-0 font-semibold text-primary text-2xl">
                    <i class="fas fa-info-circle me-2"></i>{{ $landlisting->property_name }}
                </h5>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Column 1 -->
                    <div>
                        <h6 class="text-gray-500 mb-1">Location</h6>
                        <p class="mb-3 font-medium text-gray-800">{{ $landlisting->location }}</p>

                        <h6 class="text-gray-500 mb-1">Plot Size</h6>
                        <p class="mb-3 font-medium text-gray-800">{{ $landlisting->plot_size }} Hectares</p>

                        <h6 class="text-gray-500 mb-1">Status</h6>
                        <p class="mb-3">
                            <span
                                class="inline-block px-3 py-1 rounded-full text-sm font-semibold
                            @if ($landlisting->status === "available") bg-green-100 text-green-700
                            @elseif($landlisting->status === "sold") bg-red-100 text-red-700
                            @else bg-yellow-100 text-yellow-700 @endif">
                                {{ ucfirst($landlisting->status) }}
                            </span>
                        </p>
                    </div>

                    <!-- Column 2 -->
                    <div>
                        <h6 class="text-gray-500 mb-1">Selling Price</h6>
                        <p class="mb-3 font-medium text-gray-800">₦{{ number_format($landlisting->selling_price) }}</p>

                        <h6 class="text-gray-500 mb-1">Sales Agent</h6>
                        <p class="mb-3 font-medium text-gray-800">{{ $landlisting->agent->name ?? "N/A" }}</p>

                        <h6 class="text-gray-500 mb-1">Listed On</h6>
                        <p class="font-medium text-gray-800">{{ $landlisting->created_at->format("M d, Y") }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Description -->
        @if ($landlisting->description)
            <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
                <div class="bg-gray-100 text-center py-3 border-b">
                    <h5 class="m-0 font-semibold text-primary">
                        <i class="fas fa-align-left me-2"></i>Description
                    </h5>
                </div>
                <div class="p-6">
                    <p class="text-gray-700 leading-relaxed">{{ $landlisting->description }}</p>
                </div>
            </div>
        @endif

        <!-- Map -->
        @if ($landlisting->map_link)
            <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
                <div class="bg-gray-100 text-center py-3 border-b">
                    <h5 class="m-0 font-semibold text-primary">
                        <i class="fas fa-map-marker-alt me-2"></i>Location Map
                    </h5>

                </div>
                <div class="p-6">
                    <div class="aspect-w-16 aspect-h-9 rounded-lg overflow-hidden">
                        <iframe src="{{ $landlisting->map_link }}" class="w-full h-96 border-0 rounded-lg"
                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        @endif

        <!-- Gallery -->
        <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
            <div class="bg-gray-100 text-center py-3 border-b">
                <h5 class="m-0 font-semibold text-primary">
                    <i class="fas fa-images me-2"></i>Property Gallery
                </h5>
            </div>

            <div class="p-6">
                @php
                    $photos = is_array($landlisting->photos)
                        ? $landlisting->photos
                        : json_decode($landlisting->photos, true);
                @endphp

                @if (!empty($photos))
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach ($photos as $index => $photo)
                            <a href="{{ asset("storage/" . $photo) }}" data-lightbox="property-gallery"
                                data-title="Photo {{ $index + 1 }}">
                                <img src="{{ asset("storage/" . $photo) }}" alt="Property Photo {{ $index + 1 }}"
                                    class="rounded-lg shadow-sm hover:scale-105 transition-transform duration-200 object-cover w-50 h-60">
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-6">
                        <i class="fas fa-image fa-3x text-gray-400 mb-3"></i>
                        <h5 class="text-gray-600 font-medium">No photos available</h5>
                    </div>
                @endif
            </div>
        </div>


        <!-- Quick Actions -->
        <div class="bg-white rounded-lg shadow overflow-hidden mb-8">
            <div class="bg-gray-100 text-center py-3 border-b">
                <h5 class="m-0 font-semibold text-primary">
                    <i class="fas fa-tools me-2"></i> Quick Actions
                </h5>
            </div>
            <div class="flex divide-x">
                <a href="#" class="flex-1 px-6 py-4 hover:bg-gray-50 transition flex items-center justify-center">
                    Agent Name <br> {{ $landlisting->agent->name }}
                </a>
                <a href="#" class="flex-1 px-6 py-4 hover:bg-gray-50 transition flex items-center justify-center">
                    <i class="fas fa-calendar-alt me-2 text-gray-500"></i>
                    Inspection Date & Time <br>

                    {{ \Carbon\Carbon::parse($landlisting->inspection_date)->format("d M, Y") }}
                    {{ \Carbon\Carbon::parse($landlisting->inspection_time)->format("h:i A") }}
                </a>


                <form action="{{ route("admin.landlistings.destroy", $landlisting) }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this listing?')" class="flex-1">
                    @csrf
                    @method("DELETE")
                    <button type="submit"
                        class="w-full px-6 py-4 text-red-600 hover:bg-red-50 transition flex items-center justify-center">
                        <i class="fas fa-trash me-2"></i> Delete Listing
                    </button>
                </form>
            </div>
        </div>

    </div>

    @push("styles")
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
    @endpush

    @push("scripts")
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
        <script>
            lightbox.option({
                'resizeDuration': 200,
                'wrapAround': true,
                'showImageNumberLabel': true
            });
        </script>
    @endpush
@endsection
