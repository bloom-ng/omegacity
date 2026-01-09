@extends("layouts.admin-layout")

@section("content")
    <div class="w-full">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Blogs</h1>
            <a href="{{ route('admin.blogs.create') }}"
                class="bg-black shadow-md hover:scale-110 transition-transform duration-200 text-white font-medium py-2 px-4 rounded-lg">
                <i class="fas fa-plus"></i> Add New Blog
            </a>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <form method="GET" action="{{ route('admin.blogs.index') }}" class="relative max-w-xs w-full">
                        <input type="text" name="search" value="{{ request('search') }}"
                            class="form-input w-full pl-10 pr-4 py-2 border rounded-lg"
                            placeholder="Search blogs...">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </form>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <tr>
                            <th class="py-3 px-6 text-left">#</th>
                            <th class="py-3 px-6 text-left">Title</th>
                            <th class="py-3 px-6 text-left">Contents</th>
                            <th class="py-3 px-6 text-left">Published Date</th>
                            <th class="px-6 py-3 text-right">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($blogs as $blog)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $loop->iteration }}</td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $blog->title }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                  {{ \Illuminate\Support\Str::words(strip_tags($blog->body), 7, '...') }}

                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $blog->published_at ? $blog->published_at->format("d M Y") : "N/A" }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('admin.blogs.show', $blog->id) }}"
                                        class="text-blue-600 hover:text-blue-900 mr-2">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <a href="{{ route('admin.blogs.edit', $blog->id) }}"
                                        class="text-indigo-600 hover:text-indigo-900 mr-2">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST"
                                        class="inline-block"
                                        onsubmit="return confirm('Are you sure you want to delete this blog?')">
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
                                <td colspan="6" class="text-center py-4 text-gray-500">No blogs found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 border-t border-gray-200">
                {{ $blogs->links() }}
            </div>
        </div>
    </div>
@endsection
