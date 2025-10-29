@extends("layouts.admin-layout")

@section("title", "Add New Client")

@section("content")
    <div class="w-full max-w-2xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Add New Client</h1>
            <a href="{{ route('agent.dashboard') }}"
                class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-lg transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i> Back to Dashboard
            </a>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-8">
                <form action="{{ route('agent.clients.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- First Name -->
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700">
                                First Name <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-1">
                                <input type="text" name="first_name" id="first_name"
                                    class="shadow-sm focus:ring-black focus:border-black block w-full sm:text-sm border-gray-300 rounded-md @error('first_name') border-red-500 @enderror"
                                    value="{{ old('first_name') }}" required>
                                @error('first_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Last Name -->
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700">
                                Last Name <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-1">
                                <input type="text" name="last_name" id="last_name"
                                    class="shadow-sm focus:ring-black focus:border-black block w-full sm:text-sm border-gray-300 rounded-md @error('last_name') border-red-500 @enderror"
                                    value="{{ old('last_name') }}" required>
                                @error('last_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">
                                Email
                            </label>
                            <div class="mt-1">
                                <input type="email" name="email" id="email"
                                    class="shadow-sm focus:ring-black focus:border-black block w-full sm:text-sm border-gray-300 rounded-md @error('email') border-red-500 @enderror"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700">
                                Phone
                            </label>
                            <div class="mt-1">
                                <input type="text" name="phone" id="phone"
                                    class="shadow-sm focus:ring-black focus:border-black block w-full sm:text-sm border-gray-300 rounded-md @error('phone') border-red-500 @enderror"
                                    value="{{ old('phone') }}">
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Budget Range -->
                        <div>
                            <label for="budget_range" class="block text-sm font-medium text-gray-700">
                                Budget Range
                            </label>
                            <div class="mt-1">
                                <input type="text" name="budget_range" id="budget_range"
                                    class="shadow-sm focus:ring-black focus:border-black block w-full sm:text-sm border-gray-300 rounded-md @error('budget_range') border-red-500 @enderror"
                                    value="{{ old('budget_range') }}" placeholder="₦1M - ₦5M">
                                @error('budget_range')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Source -->
                        <div>
                            <label for="source" class="block text-sm font-medium text-gray-700">
                                Source
                            </label>
                            <div class="mt-1">
                                <input type="text" name="source" id="source"
                                    class="shadow-sm focus:ring-black focus:border-black block w-full sm:text-sm border-gray-300 rounded-md @error('source') border-red-500 @enderror"
                                    value="{{ old('source') }}" placeholder="Website, Referral, etc.">
                                @error('source')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Interested Land -->
                        <div class="col-span-1 md:col-span-2">
                            <label for="interested_land_id" class="block text-sm font-medium text-gray-700">
                                Interested Property
                            </label>
                            <div class="mt-1">
                                <select name="interested_land_id" id="interested_land_id"
                                    class="shadow-sm focus:ring-black focus:border-black block w-full sm:text-sm border-gray-300 rounded-md @error('interested_land_id') border-red-500 @enderror">
                                    <option value="">-- Select Property --</option>
                                    @foreach($landListings as $listing)
                                        <option value="{{ $listing->id }}" {{ old('interested_land_id') == $listing->id ? 'selected' : '' }}>
                                            {{ $listing->property_name }} - {{ $listing->location }} ({{ $listing->formatted_price }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('interested_land_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="col-span-1 md:col-span-2">
                            <label for="address" class="block text-sm font-medium text-gray-700">
                                Address
                            </label>
                            <div class="mt-1">
                                <textarea name="address" id="address" rows="3"
                                    class="shadow-sm focus:ring-black focus:border-black block w-full sm:text-sm border-gray-300 rounded-md @error('address') border-red-500 @enderror">{{ old('address') }}</textarea>
                                @error('address')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Remark -->
                        <div class="col-span-1 md:col-span-2">
                            <label for="remark" class="block text-sm font-medium text-gray-700">
                                Notes/Remarks
                            </label>
                            <div class="mt-1">
                                <textarea name="remark" id="remark" rows="3"
                                    class="shadow-sm focus:ring-black focus:border-black block w-full sm:text-sm border-gray-300 rounded-md @error('remark') border-red-500 @enderror"
                                    placeholder="Any additional notes about this client...">{{ old('remark') }}</textarea>
                                @error('remark')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-200">
                        <a href="{{ route('agent.dashboard') }}"
                            class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                            Cancel
                        </a>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-black hover:bg-gray-700">
                            <i class="fas fa-plus mr-2"></i> Create Client
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="mt-6 bg-blue-50 border border-blue-200 rounded-md p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-info-circle text-blue-400"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-blue-800">
                        Auto-Assignment
                    </h3>
                    <div class="mt-2 text-sm text-blue-700">
                        <p>This client will be automatically assigned to you when created.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
