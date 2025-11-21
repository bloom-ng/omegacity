@extends("layouts.admin-layout")

@section("title", "Edit Land Listing")

@section("content")
    <div class="w-full">
        <div class="flex justify-between items-center mb-6">
            <h4 class="text-2xl font-medium text-gray-800">
                Edit Land Listing: {{ $landlisting->property_name }}
            </h4>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-8">
                <form action="{{ route("admin.landlistings.update", $landlisting->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method("PUT")

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- Property Name -->
                        <div>
                            <label for="property_name" class="block text-xl font-bold text-gray-700">
                                Property Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="property_name" id="property_name"
                                value="{{ old("property_name", $landlisting->property_name) }}"
                                class="mt-2 shadow-sm focus:ring-black focus:border-black block w-full sm:text-xl text-xl border-gray-300 rounded-md @error("property_name") border-red-500 @enderror"
                                required>
                            @error("property_name")
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Location -->
                        <div>
                            <label for="location" class="block text-xl font-bold text-gray-700">
                                Location <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="location" id="location"
                                value="{{ old("location", $landlisting->location) }}"
                                class="mt-2 shadow-sm focus:ring-black focus:border-black block w-full sm:text-xl text-xl border-gray-300 rounded-md @error("location") border-red-500 @enderror"
                                required>
                            @error("location")
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Plot Size -->
                        <div>
                            <label for="plot_size" class="block text-xl font-bold text-gray-700">
                                Plot Size <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="plot_size" id="plot_size"
                                value="{{ old("plot_size", $landlisting->plot_size) }}"
                                class="mt-2 shadow-sm focus:ring-black focus:border-black block w-full sm:text-xl text-xl border-gray-300 rounded-md @error("plot_size") border-red-500 @enderror"
                                required>
                            @error("plot_size")
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Selling Price -->
                        <div>
                            <label for="selling_price" class="block text-xl font-bold text-gray-700">
                                Selling Price (₦) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" step="0.01" name="selling_price" id="selling_price"
                                value="{{ old("selling_price", $landlisting->selling_price) }}"
                                class="mt-2 shadow-sm focus:ring-black focus:border-black block w-full sm:text-xl text-xl border-gray-300 rounded-md @error("selling_price") border-red-500 @enderror"
                                required>
                            @error("selling_price")
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-xl font-bold text-gray-700">
                                Status <span class="text-red-500">*</span>
                            </label>
                            <select name="status" id="status"
                                class="mt-2 shadow-sm focus:ring-black focus:border-black block w-full sm:text-xl text-xl border-gray-300 rounded-md @error("status") border-red-500 @enderror"
                                required>
                                <option value="available"
                                    {{ old("status", $landlisting->status) == "available" ? "selected" : "" }}>Available
                                </option>
                                <option value="sold"
                                    {{ old("status", $landlisting->status) == "sold" ? "selected" : "" }}>Sold</option>
                                <option value="reserved"
                                    {{ old("status", $landlisting->status) == "reserved" ? "selected" : "" }}>Reserved
                                </option>
                            </select>
                            @error("status")
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Sales Agent -->
                        <div>
                            <label for="sales_agent_id" class="block text-xl font-bold text-gray-700">
                                Sales Agent <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-2">
                                <select name="sales_agent_id" id="sales_agent_id"
                                    class="mt-2 shadow-sm focus:ring-black focus:border-black block w-full sm:text-xl text-xl border-gray-300 rounded-md @error("sales_agent_id") border-red-500 @enderror"
                                    required>
                                    <option value="" disabled
                                        {{ old("sales_agent_id", $landlisting->sales_agent_id) ? "" : "selected" }}>
                                        Select Agent
                                    </option>
                                    @foreach ($agents as $agent)
                                        <option value="{{ $agent->id }}"
                                            {{ old("sales_agent_id", $landlisting->sales_agent_id) == $agent->id ? "selected" : "" }}>
                                            {{ $agent->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error("sales_agent_id")
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        <div>
                            <label for="inspection_date" class="block text-xl font-bold text-gray-700">
                                Inspection Date
                            </label>
                            <input type="date" name="inspection_date" id="inspection_date"
                                value="{{ old("inspection_date", $landlisting->inspection_date) }}"
                                class="mt-2 shadow-sm focus:ring-black focus:border-black block w-full sm:text-xl text-xl
               border-gray-300 rounded-md @error("inspection_date") border-red-500 @enderror">
                            @error("inspection_date")
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="inspection_time" class="block text-xl font-bold text-gray-700">
                                Inspection Time
                            </label>
                            <input type="time" name="inspection_time" id="inspection_time"
                                value="{{ old("inspection_time", $landlisting->inspection_time) }}"
                                class="mt-2 shadow-sm focus:ring-black focus:border-black block w-full sm:text-xl text-xl
               border-gray-300 rounded-md @error("inspection_time") border-red-500 @enderror">
                            @error("inspection_time")
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>



                        <!-- Map Link -->
                        <div>
                            <label for="map_link" class="block text-xl font-bold text-gray-700">
                                Google Maps Link
                            </label>
                            <input type="text" name="map_link" id="map_link"
                                value="{{ old("map_link", $landlisting->map_link) }}"
                                placeholder="Paste any Google Maps link here"
                                class="mt-2 shadow-sm focus:ring-black focus:border-black block w-full sm:text-xl text-xl border-gray-300 rounded-md @error("map_link") border-red-500 @enderror">
                            @error("map_link")
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Photos (full width) -->
                        <div class="col-span-1 md:col-span-2">
                            <label for="photos" class="block text-xl font-bold text-gray-700">Photos</label>
                            <input type="file" name="photos[]" id="photos" multiple accept="image/*"
                                class="mt-2 shadow-sm focus:ring-black focus:border-black block w-full sm:text-xl text-xl border-gray-300 rounded-md @error("photos.*") border-red-500 @enderror">
                            <p class="text-sm text-gray-500 mt-1">Leave empty to keep existing photos.</p>
                            @error("photos.*")
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror

                            @if ($landlisting->photos && count($landlisting->photos) > 0)
                                <div class="mt-3 flex flex-wrap gap-3">
                                    @foreach ($landlisting->photos as $photo)
                                        <img src="{{ asset("storage/" . $photo) }}" alt="Photo"
                                            class="w-20 h-16 rounded-md object-cover border">
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <!-- Description (full width) -->
                        <div class="col-span-1 md:col-span-2">
                            <label for="description" class="block text-xl font-bold text-gray-700">
                                Description
                            </label>
                            <textarea name="description" id="description" rows="4"
                                class="mt-2 shadow-sm focus:ring-black focus:border-black block w-full sm:text-xl text-xl border-gray-300 rounded-md @error("description") border-red-500 @enderror">{{ old("description", $landlisting->description) }}</textarea>
                            @error("description")
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <!-- Buttons -->
                    <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-200">
                        <a href="{{ route("admin.landlistings.index") }}"
                            class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                            Cancel
                        </a>
                        <a href="{{ route("admin.landlistings.show", $landlisting) }}"
                            class="px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-gray-600 hover:bg-gray-700">
                            <i class="fas fa-eye mr-2"></i> View
                        </a>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-black hover:bg-gray-700">
                            <i class="fas fa-save mr-2"></i> Update Listing
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
