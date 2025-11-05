@extends("layouts.admin-layout")

@section("content")
    <div class="w-full">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Settings</h1>
            {{-- <a href="{{ route("admin.settings.create") }}"
                class="bg-black shadow-md hover:scale-110 transition-transform duration-200 text-white font-medium py-2 px-4 rounded-lg">
                <i class="fas fa-plus"></i> Create a value
            </a> --}}
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            {{-- <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <form method="GET" action="{{ route("admin.settings.index") }}" class="relative max-w-xs w-full">
                        <input type="text" name="search" value="{{ request("search") }}"
                            class="form-input w-full pl-10 pr-4 py-2 border rounded-lg" placeholder="Search settings...">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </form>
                    @if (request("search"))
                        <a href="{{ route("admin.settings.index") }}" class="text-sm text-blue-600 hover:underline">
                            Clear
                        </a>
                    @endif
                </div>
            </div> --}}


            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <tr>
                            <th class="py-3 px-6 text-left">#</th>
                            <th class="py-3 px-6 text-left">Name</th>
                            <th class="py-3 px-6 text-left">Value</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($settings as $setting)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $setting->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <form action="{{ route("admin.settings.update", $setting->id) }}" method="POST"
                                        class="flex items-center gap-2">
                                        @csrf
                                        @method("PUT")

                                        <input type="text" name="value" value="{{ $setting->value }}"
                                            class="border border-gray-300 rounded px-2 py-1 text-sm hidden edit-input-{{ $setting->id }}">

                                        <span class="value-display-{{ $setting->id }}">{{ $setting->value }}</span>

                                        <button type="button" onclick="enableEdit({{ $setting->id }})"
                                            class="text-indigo-600 hover:text-indigo-900 edit-btn-{{ $setting->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <button type="submit"
                                            class="text-green-600 hover:text-green-900 hidden save-btn-{{ $setting->id }}">
                                           <i class="fa-solid fa-check"></i>
                                        </button>

                                        <button type="button" onclick="cancelEdit({{ $setting->id }})"
                                            class="text-gray-600 hover:text-gray-900 hidden cancel-btn-{{ $setting->id }}">
                                            ✕
                                        </button>
                                    </form>
                                </td>


                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center py-4 text-gray-500">No settings found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 border-t border-gray-200">
                {{ $settings->links() }}
            </div>
        </div>
    </div>


    <script>
        function enableEdit(id) {
            document.querySelector(`.value-display-${id}`).style.display = 'none';
            document.querySelector(`.edit-input-${id}`).classList.remove('hidden');

            document.querySelector(`.edit-btn-${id}`).classList.add('hidden');
            document.querySelector(`.save-btn-${id}`).classList.remove('hidden');
            document.querySelector(`.cancel-btn-${id}`).classList.remove('hidden');
        }

        function cancelEdit(id) {
            document.querySelector(`.value-display-${id}`).style.display = 'inline';
            document.querySelector(`.edit-input-${id}`).classList.add('hidden');

            document.querySelector(`.edit-btn-${id}`).classList.remove('hidden');
            document.querySelector(`.save-btn-${id}`).classList.add('hidden');
            document.querySelector(`.cancel-btn-${id}`).classList.add('hidden');
        }
    </script>
@endsection
