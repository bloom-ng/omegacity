@extends("layouts.admin-layout")

@section("title", "Create Land Listing")

@section("content")
    <div class="w-full">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Create New Land Listing</h1>
            <a href="{{ route("admin.landlistings.index") }}"
                class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-lg transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i> Back to Listings
            </a>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-8">
                <form action="{{ route("admin.landlistings.store") }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Property Name -->
                        <div>
                            <label for="property_name" class="block text-lg font-semibold text-gray-700">
                                Property Name <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-2">
                                <input type="text" name="property_name" id="property_name"
                                    class="shadow-sm focus:ring-black focus:border-black block w-full sm:text-sm text-sm border-gray-300 rounded-md @error("property_name") border-red-500 @enderror"
                                    value="{{ old("property_name") }}" required>
                                @error("property_name")
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Location -->
                        <div>
                            <label for="location" class="block text-lg font-semibold text-gray-700">
                                Location <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-2">
                                <input type="text" name="location" id="location"
                                    class="shadow-sm focus:ring-black focus:border-black block w-full sm:text-sm text-sm border-gray-300 rounded-md @error("location") border-red-500 @enderror"
                                    value="{{ old("location") }}" required>
                                @error("location")
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Plot Size -->
                        <div>
                            <label for="plot_size" class="block text-lg font-semibold text-gray-700">
                                Plot Size <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-2">
                                <input type="text" name="plot_size" id="plot_size"
                                    class="shadow-sm focus:ring-black focus:border-black block w-full sm:text-sm text-sm border-gray-300 rounded-md @error("plot_size") border-red-500 @enderror"
                                    value="{{ old("plot_size") }}" required>
                                @error("plot_size")
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Selling Price -->
                        <div>
                            <label for="selling_price" class="block text-lg font-semibold text-gray-700">
                                Selling Price (₦) <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-2">
                                <input type="number" step="0.01" name="selling_price" id="selling_price"
                                    class="shadow-sm focus:ring-black focus:border-black block w-full sm:text-sm text-sm border-gray-300 rounded-md @error("selling_price") border-red-500 @enderror"
                                    value="{{ old("selling_price") }}" required>
                                @error("selling_price")
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-lg font-semibold text-gray-700">
                                Status <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-2">
                                <select name="status" id="status"
                                    class="shadow-sm focus:ring-black focus:border-black block w-full sm:text-sm text-sm border-gray-300 rounded-md @error("status") border-red-500 @enderror"
                                    required>
                                    <option value="" disabled selected>Select Status</option>
                                    <option value="available" {{ old("status") == "available" ? "selected" : "" }}>
                                        Available</option>
                                    <option value="sold" {{ old("status") == "sold" ? "selected" : "" }}>Sold</option>
                                    <option value="reserved" {{ old("status") == "reserved" ? "selected" : "" }}>Reserved
                                    </option>
                                </select>
                                @error("status")
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Sales Agent -->
                        <div>
                            <label for="sales_agent_id" class="block text-lg font-semibold text-gray-700">
                                Sales Agent
                            </label>
                            <div class="mt-2">
                                <select name="sales_agent_id" id="sales_agent_id"
                                    class="shadow-sm focus:ring-black focus:border-black block w-full sm:text-sm text-sm border-gray-300 rounded-md @error("sales_agent_id") border-red-500 @enderror"
                                    >
                                    <option value="" disabled selected>Select Agent</option>
                                    @foreach ($agents as $agent)
                                        <option value="{{ $agent->id }}"
                                            {{ old("sales_agent_id") == $agent->id ? "selected" : "" }}>
                                            {{ $agent->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error("sales_agent_id")
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Photos -->
                        <div>
                            <label for="photos" class="block text-lg font-semibold text-gray-700">Photos</label>
                            <div class="mt-2">
                                <input type="file" name="photos[]" id="photos" multiple accept="image/*"
                                    class="shadow-sm focus:ring-black focus:border-black block w-full sm:text-sm text-sm border-gray-300 rounded-md @error("photos.*") border-red-500 @enderror">
                                <p class="text-sm text-gray-500 mt-1">You can select multiple images (max 5MB each).</p>
                                @error("photos.*")
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Map Link -->
                        <div>
                            <label for="map_link" class="block text-lg font-semibold text-gray-700">Google Maps Link</label>
                            <div class="mt-2">
                                <input type="text" name="map_link" id="map_link"
                                    class="shadow-sm focus:ring-black focus:border-black block w-full sm:text-sm text-sm border-gray-300 rounded-md @error("map_link") border-red-500 @enderror"
                                    value="{{ old("map_link") }}" placeholder="Paste any Google Maps link here">
                                @error("map_link")
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Inspection Date -->
                        <div>
                            <label for="inspection_date" class="block text-lg font-semibold text-gray-700">
                                Inspection Date
                            </label>
                            <div class="mt-2">
                                <input type="date" name="inspection_date" id="inspection_date"
                                    class="shadow-sm focus:ring-black focus:border-black block w-full sm:text-sm text-sm border-gray-300
            rounded-md @error("inspection_date") border-red-500 @enderror"
                                    value="{{ old("inspection_date") }}">
                                @error("inspection_date")
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Inspection Time -->
                        <div>
                            <label for="inspection_time" class="block text-lg font-semibold text-gray-700">
                                Inspection Time
                            </label>
                            <div class="mt-2">
                                <input type="time" name="inspection_time" id="inspection_time"
                                    class="shadow-sm focus:ring-black focus:border-black block w-full sm:text-sm text-sm border-gray-300
            rounded-md @error("inspection_time") border-red-500 @enderror"
                                    value="{{ old("inspection_time") }}">
                                @error("inspection_time")
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>


                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-lg font-semibold text-gray-700">Description</label>
                        <div class="mt-2">
                            <textarea name="description" id="description" rows="3"
                                class="shadow-sm focus:ring-black focus:border-black block w-full sm:text-sm text-sm border-gray-300 rounded-md @error("description") border-red-500 @enderror">{{ old("description") }}</textarea>
                            @error("description")
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-200">
                        <a href="{{ route("admin.landlistings.index") }}"
                            class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white">
                            Cancel
                        </a>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-black hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white">
                            <i class="fas fa-plus mr-2"></i> Create Listing
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
