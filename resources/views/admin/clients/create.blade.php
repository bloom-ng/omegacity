@extends("layouts.admin-layout")

@section("title", "Create New Client")

@section("content")
    <div class="w-full">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Create New Client</h1>
            <a href="{{ route("admin.clients.index") }}"
                class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-lg transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i> Back to Clients
            </a>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-8">
                <form action="{{ route("admin.clients.store") }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- First Name -->
                        <div>
                            <label for="first_name" class="block text-xl font-bold text-gray-700">
                                First Name <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-2">
                                <input type="text" name="first_name" id="first_name"
                                    class="shadow-sm focus:ring-black focus:border-black block w-full sm:text-xl text-xl border-gray-300 rounded-md @error("first_name") border-red-500 @enderror"
                                    value="{{ old("first_name") }}" required>
                                @error("first_name")
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Last Name -->
                        <div>
                            <label for="last_name" class="block text-xl font-bold text-gray-700">
                                Last Name <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-2">
                                <input type="text" name="last_name" id="last_name"
                                    class="shadow-sm focus:ring-black focus:border-black block w-full sm:text-xl text-xl border-gray-300 rounded-md @error("last_name") border-red-500 @enderror"
                                    value="{{ old("last_name") }}" required>
                                @error("last_name")
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-xl font-bold text-gray-700">
                                Email
                            </label>
                            <div class="mt-1">
                                <input type="email" name="email" id="email"
                                    class="shadow-sm focus:ring-black focus:border-black block w-full sm:text-xl text-xl border-gray-300 rounded-md @error("email") border-red-500 @enderror"
                                    value="{{ old("email") }}">
                                @error("email")
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-xl font-bold text-gray-700">
                                Phone
                            </label>
                            <div class="mt-1">
                                <input type="text" name="phone" id="phone"
                                    class="shadow-sm focus:ring-black focus:border-black block w-full sm:text-xl text-xl border-gray-300 rounded-md @error("phone") border-red-500 @enderror"
                                    value="{{ old("phone") }}">
                                @error("phone")
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Source -->
                        <div>
                            <label for="source" class="block text-xl font-bold text-gray-700">
                                Source
                            </label>
                            <div class="mt-1">
                                <input type="text" name="source" id="source"
                                    class="shadow-sm focus:ring-black focus:border-black block w-full sm:text-xl text-xl border-gray-300 rounded-md @error("source") border-red-500 @enderror"
                                    value="{{ old("source") }}" placeholder="Website, Referral, etc.">
                                @error("source")
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Budget Range -->
                        <div>
                            <label for="budget_range" class="block text-xl font-bold text-gray-700">
                                Budget Range
                            </label>
                            <div class="mt-1">
                                <input type="text" name="budget_range" id="budget_range"
                                    class="shadow-sm focus:ring-black focus:border-black block w-full sm:text-xl text-xl border-gray-300 rounded-md @error("budget_range") border-red-500 @enderror"
                                    value="{{ old("budget_range") }}" placeholder="₦1M - ₦5M">
                                @error("budget_range")
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Assigned Agent -->
                        <div>
                            <label for="assigned_agent_id" class="block text-xl font-bold text-gray-700">
                                Assign Agent
                            </label>
                            <div class="mt-1">
                                <select name="assigned_agent_id" id="assigned_agent_id"
                                    class="shadow-sm focus:ring-black focus:border-black block w-full sm:text-xl text-xl border-gray-300 rounded-md @error("assigned_agent_id") border-red-500 @enderror">
                                    <option value="">-- Select Agent --</option>
                                    @foreach(\App\Models\User::whereHas('role', function($q) { $q->where('name', 'Agent'); })->get() as $agent)
                                        <option value="{{ $agent->id }}" {{ old("assigned_agent_id") == $agent->id ? "selected" : "" }}>
                                            {{ $agent->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error("assigned_agent_id")
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-xl font-bold text-gray-700">
                                Status
                            </label>
                            <div class="mt-1">
                                <select name="status" id="status"
                                    class="shadow-sm focus:ring-black focus:border-black block w-full sm:text-xl text-xl border-gray-300 rounded-md @error("status") border-red-500 @enderror">
                                    <option value="prospect" {{ old("status", "prospect") === "prospect" ? "selected" : "" }}>Prospect</option>
                                    <option value="contacted" {{ old("status") === "contacted" ? "selected" : "" }}>Contacted</option>
                                    <option value="interested" {{ old("status") === "interested" ? "selected" : "" }}>Interested</option>
                                    <option value="converted" {{ old("status") === "converted" ? "selected" : "" }}>Converted</option>
                                    <option value="inactive" {{ old("status") === "inactive" ? "selected" : "" }}>Inactive</option>
                                </select>
                                @error("status")
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Address (full width) -->
                        <div class="col-span-1 md:col-span-2">
                            <label for="address" class="block text-xl font-bold text-gray-700">
                                Address
                            </label>
                            <div class="mt-1">
                                <textarea name="address" id="address" rows="3"
                                    class="shadow-sm focus:ring-black focus:border-black block w-full sm:text-xl text-xl border-gray-300 rounded-md @error("address") border-red-500 @enderror">{{ old("address") }}</textarea>
                                @error("address")
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Remark (full width) -->
                        <div class="col-span-1 md:col-span-2">
                            <label for="remark" class="block text-xl font-bold text-gray-700">
                                Remark/Notes
                            </label>
                            <div class="mt-1">
                                <textarea name="remark" id="remark" rows="3"
                                    class="shadow-sm focus:ring-black focus:border-black block w-full sm:text-xl text-xl border-gray-300 rounded-md @error("remark") border-red-500 @enderror"
                                    placeholder="Any additional notes about this client...">{{ old("remark") }}</textarea>
                                @error("remark")
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-200">
                        <a href="{{ route("admin.clients.index") }}"
                            class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white">
                            Cancel
                        </a>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-black hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white">
                            <i class="fas fa-plus mr-2"></i> Create Client
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
