@extends("layouts.admin-layout")

@section("content")
    <div class="w-full">
        <div class="bg-white rounded-lg shadow overflow-hidden">

            {{-- Header + Search Bar --}}
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">

                    <!-- Search Form -->
                    <div class="flex items-center gap-3">
                        <form method="GET" action="" class="relative max-w-xs w-full">
                            <input type="text" name="search" value="{{ request("search") }}"
                                class="form-input w-full pl-10 pr-4 py-2 border rounded-lg"
                                placeholder="Search for marketers...">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </form>

                        @if (request("search"))
                            <a href="{{ route("admin.forms.marketer") }}"
                                class="text-sm text-blue-600 hover:underline">Clear</a>
                        @endif
                    </div>
                </div>
            </div>


            {{-- Table --}}
            <div class="">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <tr>
                            <th class="py-3 px-6 text-left">#</th>
                            <th class="py-3 px-6 text-left">Full Name</th>
                            <th class="py-3 px-6 text-left">Email</th>
                            <th class="py-3 px-6 text-left">Phone</th>
                            <th class="py-3 px-6 text-left">Occupation</th>
                            <th class="py-3 px-6 text-left">Registered On</th>
                            <th class="px-6 py-3 text-right">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($forms as $form)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 text-sm font-medium">{{ $form->full_name }}</td>
                                <td class="px-6 py-4 text-sm">{{ $form->email ?? "—" }}</td>
                                <td class="px-6 py-4 text-sm">{{ $form->phone }}</td>
                                <td class="px-6 py-4 text-sm">{{ $form->occupation }}</td>
                                <td class="px-6 py-4 text-sm">
                                    {{ $form->created_at->format("d M Y") }}
                                </td>

                                <td class="px-6 py-4 text-right text-sm space-x-3">

                                    {{-- View --}}
                                    <a href="{{ route('admin.marketers.show', $form->id) }}" class="text-blue-600 hover:text-blue-900">
                                        <i class="fas fa-eye"></i>
                                    </a>


                                    <form action="{{ route("admin.marketers.destroy", $form->id) }}" method="POST"
                                        class="inline-block"
                                        onsubmit="return confirm('Are you sure you want to delete this marketer?')">
                                        @csrf
                                        @method("DELETE")
                                        <button class="text-red-600 hover:text-red-900" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-gray-500">
                                    No marketers found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            {{-- Pagination --}}
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $forms->links() }}
            </div>
        </div>
    </div>
@endsection
