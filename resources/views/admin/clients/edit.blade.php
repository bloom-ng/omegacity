@extends("layouts.admin-layout")

@section("title", "Edit Client")

@section("content")
    <div class="w-full">

        <div class="flex justify-between items-center mb-6">
            <h4 class="text-2xl font-medium text-gray-800"> Edit Client: {{ $client->name }}</h4>
        </div>


        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-8">
                <form action="{{ route("admin.clients.update", $client->id) }}" method="POST">
                    @csrf
                    @method("PUT")
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-xl font-bold text-gray-700">
                                Name <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-2">
                                <input type="text" name="name" id="name"
                                    class="shadow-sm focus:ring-black focus:border-black block w-full sm:text-xl text-xl border-gray-300 rounded-md @error("name") border-red-500 @enderror"
                                    value="{{ old("name", $client->name ?? "") }}" required>
                                @error("name")
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-xl font-bold text-gray-700">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-1">
                                <input type="email" name="email" id="email"
                                    class="shadow-sm focus:ring-black focus:border-black block w-full sm:text-xl text-xl border-gray-300 rounded-md @error("email") border-red-500 @enderror"
                                    value="{{ old("email", $client->email ?? "") }}" required>
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
                                    value="{{ old("phone", $client->phone ?? "") }}">
                                @error("phone")
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
                                    class="shadow-sm focus:ring-black focus:border-black block w-full sm:text-xl text-xl border-gray-300 rounded-md @error("address") border-red-500 @enderror">{{ old("address", $client->address ?? "") }}</textarea>
                                @error("address")
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
    </div>
@endsection
