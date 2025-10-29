@extends("layouts.admin-layout")

@section("title", "Create New contact")

@section("content")
    <div class="w-full">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Create New Contact</h1>
            <a href="{{ route("admin.contacts.index") }}"
                class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-lg transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i> Back to Contacts
            </a>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-8">
                <form action="{{ route("admin.contacts.store") }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-lg font-semibold text-gray-700">
                                Email
                            </label>
                            <div class="mt-1">
                                <input type="email" name="email" id="email"
                                    class="shadow-sm focus:ring-black focus:border-black block w-full sm:text-sm text-sm border-gray-300 rounded-md @error("email") border-red-500 @enderror"
                                    value="{{ old("email", $contact->email ?? "") }}">
                                @error("email")
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- message (Full width) -->
                        <div class="col-span-1 md:col-span-2">
                            <label for="message" class="block text-lg font-semibold text-gray-700">
                                message
                            </label>
                            <div class="mt-1">
                                <textarea name="message" id="message" rows="3"
                                    class="shadow-sm focus:ring-black focus:border-black block w-full sm:text-sm text-sm border-gray-300 rounded-md @error("message") border-red-500 @enderror">{{ old("message", $contact->message ?? "") }}</textarea>
                                @error("message")
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                       
                    </div>

                    <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-200">
                        <a href="{{ route("admin.contacts.index") }}"
                            class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                            Cancel
                        </a>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-black hover:bg-gray-700">
                            <i class="fas fa-plus mr-2"></i> Create Contact
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
