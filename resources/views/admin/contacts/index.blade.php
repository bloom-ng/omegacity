@extends("layouts.admin-layout")

@section("content")
    <div class="w-full">
        {{-- <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">contacts</h1>
            <a href="{{ route("admin.contacts.create") }}"
                class="bg-black shadow-md hover:scale-110 transition-transform duration-200 text-white font-medium py-2 px-4 rounded-lg">
                <i class="fas fa-plus"></i> Add New contact
            </a>
        </div> --}}

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
                        <a href="{{ route("admin.contacts.index") }}" class="bg-black shadow-md hover:scale-110 transition-transform duration-200 text-white text-sm font-medium py-2 px-4 rounded-lg">Clear</a>
                    @endif
                </div>
            </div>


            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <tr>
                            <th class="py-3 px-6 text-left">#</th>
                            <th class="py-3 px-6 text-left">Email</th>
                            <th class="py-3 px-6 text-left">Message</th>
                            <th class="px-6 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($contacts as $contact)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $contact->email }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ \Illuminate\Support\Str::words($contact->message, 7, "...") }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route("admin.contacts.show", $contact->id) }}"
                                        class="text-blue-600 hover:text-blue-900 mr-2">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    {{-- <a href="{{ route("admin.contacts.edit", $contact->id) }}"
                                        class="text-indigo-600 hover:text-indigo-900 mr-2">
                                        <i class="fas fa-edit"></i>
                                    </a> --}}
                                    <form action="{{ route("admin.contacts.destroy", $contact->id) }}" method="POST"
                                        class="inline-block"
                                        onsubmit="return confirm('Are you sure you want to delete this contact?')">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center py-4 text-gray-500">No contacts found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 border-t border-gray-200">
                {{ $contacts->links() }}
            </div>
        </div>
    </div>
@endsection
