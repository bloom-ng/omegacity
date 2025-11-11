@extends("layouts.admin-layout")

@section("content")
<div class="w-full">
    <div class="bg-white rounded-lg shadow overflow-hidden">

        {{-- Header + Search Bar --}}
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <form method="GET" action="{{ route('admin.forms.guarantor') }}" class="relative max-w-xs w-full">
                    <input type="text" name="search" value="{{ request('search') }}"
                           class="form-input w-full pl-10 pr-4 py-2 border rounded-lg"
                           placeholder="Search guarantors...">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                  d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                  clip-rule="evenodd" />
                        </svg>
                    </div>
                </form>

                @if(request("search"))
                <a href="{{ route('admin.forms.guarantor') }}" class="text-sm text-blue-600 hover:underline">
                    Clear
                </a>
                @endif
            </div>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <tr>
                    <th class="py-3 px-6 text-left">#</th>
                    <th class="py-3 px-6 text-left">Guarantor</th>
                    <th class="py-3 px-6 text-left">Candidate</th>
                    <th class="py-3 px-6 text-left">Phone</th>
                    <th class="py-3 px-6 text-left">Occupation</th>
                    <th class="px-6 py-3 text-right">Actions</th>
                </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                @forelse($forms as $form)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $loop->iteration }}</td>

                    <td class="px-6 py-4 text-sm text-gray-900">
                        {{ $form->guarantor_title }} {{ $form->guarantor_name }}
                    </td>

                    <td class="px-6 py-4 text-sm text-gray-900">
                        {{ $form->candidate_title }} {{ $form->candidate_name }}
                    </td>

                    <td class="px-6 py-4 text-sm text-gray-900">{{ $form->phone }}</td>

                    <td class="px-6 py-4 text-sm text-gray-900">{{ $form->occupation }}</td>

                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">

                        <a href="{{ route('admin.forms.download', [$form->id, 'guarantor']) }}"
                           class="text-blue-600 hover:text-blue-900 mr-3" title="Download PDF">
                            <i class="fas fa-eye"></i>
                        </a>

                        {{-- Delete Form --}}
                        <form action=""
                              method="POST" class="inline-block"
                              onsubmit="return confirm('Delete this Guarantor submission?');">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="text-red-600 hover:text-red-900" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>

                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="11" class="text-center py-4 text-gray-500">No guarantor forms found.</td>
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

<!-- Loading Spinner Overlay -->
<div id="loading-overlay" class="fixed inset-0 bg-gray-100 bg-opacity-75 flex items-center justify-center z-50 hidden">
    <img src="{{ asset('assets/images/favicon-omega.png') }}"
         alt="Loading..."
         class="h-12 w-12 animate-spin">
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const downloadLinks = document.querySelectorAll('a[title="Download PDF"]');
    const overlay = document.getElementById('loading-overlay');

    downloadLinks.forEach(link => {
        link.addEventListener('click', function () {
            overlay.classList.remove('hidden');
        });
    });
});
</script>

@endsection
