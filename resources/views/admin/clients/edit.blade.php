@extends("layouts.admin-layout")

@section("title", "Edit Client")

@section("content")
    <div class="w-full">

        <div class="flex justify-between items-center mb-6">
            <h4 class="text-2xl font-medium text-gray-800">Edit Client: {{ $client->first_name }} {{ $client->last_name }}</h4>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-8">
                <form action="{{ route('admin.clients.update', $client->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- First Name -->
                        <div>
                            <label for="first_name" class="block text-lg font-semibold text-gray-700">
                                First Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="first_name" id="first_name"
                                class="shadow-sm focus:ring-black focus:border-black block w-full border-gray-300 rounded-md @error('first_name') border-red-500 @enderror"
                                value="{{ old('first_name', $client->first_name) }}" required>
                            @error('first_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Last Name -->
                        <div>
                            <label for="last_name" class="block text-lg font-semibold text-gray-700">
                                Last Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="last_name" id="last_name"
                                class="shadow-sm focus:ring-black focus:border-black block w-full border-gray-300 rounded-md @error('last_name') border-red-500 @enderror"
                                value="{{ old('last_name', $client->last_name) }}" required>
                            @error('last_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-lg font-semibold text-gray-700">
                                Email
                            </label>
                            <input type="email" name="email" id="email"
                                class="shadow-sm focus:ring-black focus:border-black block w-full border-gray-300 rounded-md @error('email') border-red-500 @enderror"
                                value="{{ old('email', $client->email) }}">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-lg font-semibold text-gray-700">
                                Phone
                            </label>
                            <input type="text" name="phone" id="phone"
                                class="shadow-sm focus:ring-black focus:border-black block w-full border-gray-300 rounded-md @error('phone') border-red-500 @enderror"
                                value="{{ old('phone', $client->phone) }}">
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div class="col-span-1 md:col-span-2">
                            <label for="address" class="block text-lg font-semibold text-gray-700">
                                Address
                            </label>
                            <textarea name="address" id="address" rows="2"
                                class="shadow-sm focus:ring-black focus:border-black block w-full border-gray-300 rounded-md @error('address') border-red-500 @enderror">{{ old('address', $client->address) }}</textarea>
                            @error('address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Source -->
                        <div>
                            <label for="source" class="block text-lg font-semibold text-gray-700">
                                Source
                            </label>
                            <input type="text" name="source" id="source"
                                class="shadow-sm focus:ring-black focus:border-black block w-full border-gray-300 rounded-md @error('source') border-red-500 @enderror"
                                value="{{ old('source', $client->source) }}">
                            @error('source')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Budget Range -->
                        <div>
                            <label for="budget_range" class="block text-lg font-semibold text-gray-700">
                                Budget Range
                            </label>
                            <input type="text" name="budget_range" id="budget_range"
                                class="shadow-sm focus:ring-black focus:border-black block w-full border-gray-300 rounded-md @error('budget_range') border-red-500 @enderror"
                                value="{{ old('budget_range', $client->budget_range) }}">
                            @error('budget_range')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Interested Land -->
                        <div>
                            <label for="interested_land_id" class="block text-lg font-semibold text-gray-700">
                                Interested Land
                            </label>
                            <select name="interested_land_id" id="interested_land_id"
                                class="shadow-sm focus:ring-black focus:border-black block w-full border-gray-300 rounded-md @error('interested_land_id') border-red-500 @enderror">
                                <option value="">-- Select Land --</option>
                                @foreach ($land_listings as $land)
                                    <option value="{{ $land->id }}"
                                        {{ old('interested_land_id', $client->interested_land_id) == $land->id ? 'selected' : '' }}>
                                        {{ $land->property_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('interested_land_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Follow-up Date -->
                        <div>
                            <label for="follow_up_date" class="block text-lg font-semibold text-gray-700">
                                Follow-up Date
                            </label>
                            <input type="date" name="follow_up_date" id="follow_up_date"
                                class="shadow-sm focus:ring-black focus:border-black block w-full border-gray-300 rounded-md @error('follow_up_date') border-red-500 @enderror"
                               value="{{ old('follow_up_date', $client->follow_up_date ? \Carbon\Carbon::parse($client->follow_up_date)->format('Y-m-d') : '') }}">
                            @error('follow_up_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Remark -->
                        <div class="col-span-1 md:col-span-2">
                            <label for="remark" class="block text-lg font-semibold text-gray-700">
                                Remark
                            </label>
                            <textarea name="remark" id="remark" rows="3"
                                class="shadow-sm focus:ring-black focus:border-black block w-full border-gray-300 rounded-md @error('remark') border-red-500 @enderror">{{ old('remark', $client->remark) }}</textarea>
                            @error('remark')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-lg font-semibold text-gray-700">
                                Status <span class="text-red-500">*</span>
                            </label>
                            <select name="status" id="status"
                                class="shadow-sm focus:ring-black focus:border-black block w-full border-gray-300 rounded-md @error('status') border-red-500 @enderror" required>
                                <option value="prospect" {{ old('status', $client->status) == 'prospect' ? 'selected' : '' }}>Prospect</option>
                                <option value="active" {{ old('status', $client->status) == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="closed" {{ old('status', $client->status) == 'closed' ? 'selected' : '' }}>Closed</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200 mt-6">
                        <a href="{{ route('admin.clients.index') }}"
                            class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300">
                            Cancel
                        </a>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-black hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800">
                            <i class="fas fa-save mr-2"></i> Update Client
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
