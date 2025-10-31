@extends("layouts.admin-layout")

@section("content")
    <div class="w-full">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Settings</h1>
            <a href="{{ route("admin.contacts.create") }}"
                class="bg-black shadow-md hover:scale-110 transition-transform duration-200 text-white font-medium py-2 px-4 rounded-lg">
                <i class="fas fa-plus"></i> Create a value
            </a>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <form method="GET" action="{{ route("admin.contacts.index") }}" class="relative max-w-xs w-full">
                        <input type="text" name="search" value="{{ request("search") }}"
                            class="form-input w-full pl-10 pr-4 py-2 border rounded-lg" placeholder="Search contacts...">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </form>
                    @if (request("search"))
                        <a href="{{ route("admin.contacts.index") }}" class="text-sm text-blue-600 hover:underline">
                            Clear
                        </a>
                    @endif
                </div>
            </div>


            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <tr>
                            <th class="py-3 px-6 text-left">#</th>
                            <th class="py-3 px-6 text-left">Name</th>
                            <th class="py-3 px-6 text-left">Value</th>
                            <th class="px-6 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                   
                </table>
            </div>

            <div class="px-6 py-4 border-t border-gray-200">
                {{-- {{ $contacts->links() }} --}}
            </div>
        </div>
    </div>
@endsection
