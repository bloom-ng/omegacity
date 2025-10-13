@extends("layouts.admin-layout")

@section("content")
    <div class="w-full">
        <div class="bg-white shadow-md rounded-lg p-6">

            <!-- Top Two Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Card 1 -->
                <div class="bg-white rounded-lg p-6 shadow">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-gray-100">
                            <img src="{{ asset('assets/images/contacts.svg') }}"
                            class="w-8 h-8" alt="contacts-icon">
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600 font-sans">Contacts</p>
                            <p class="text-2xl font-semibold text-gray-900 font-sans">{{ $contactList->count() ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white rounded-lg p-6 shadow">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-gray-100">
                            <img src="{{ asset('assets/images/users.svg') }}"
                            class="w-8 h-8" alt="users-icon">
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600 font-sans">Users</p>
                            <p class="text-2xl font-semibold text-gray-900 font-sans">0</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Full Width Card Below -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800 font-sans">Recent Activities</h2>
                </div>
                <div class="p-6">
                    <h1 class="text-gray-700 font-sans">Listed Here</h1>
                </div>
            </div>

        </div>
    </div>
@endsection
