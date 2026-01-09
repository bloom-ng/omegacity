@extends("layouts.admin-layout")

@section("content")
    <div class="w-full px-4">

        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 space-y-3 sm:space-y-0">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">{{ $blog->title }}</h1>

                <div class="flex items-center space-x-4 mt-1">
                    <div class="text-sm text-gray-500">
                        Published on {{ $blog->published_at ? $blog->published_at->format("M d, Y") : "Not Published" }}
                    </div>

                    <div class="text-sm text-gray-500">
                        Author: <span class="font-bold">{{ $blog->author }}</span>
                    </div>
                </div>
            </div>

            <div class="flex space-x-2">
                <!-- Edit Button -->
                <a href="{{ route('admin.blogs.edit', $blog->id) }}"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-gray-700 hover:scale-105 transition-transform duration-200">
                    Edit Blog
                </a>

                <!-- Back -->
                <a href="{{ route('admin.blogs.index') }}"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    Back to Blogs
                </a>
            </div>
        </div>

        <!-- Thumbnail Section -->
        @if ($blog->thumbnail)
            <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-6">
                <div class="p-4">
                    <img src="{{ asset('storage/' . $blog->thumbnail) }}"
                         class="w-full max-w-lg rounded-md shadow-md object-cover"
                         alt="Blog Thumbnail">
                </div>
            </div>
        @endif

        <!-- Blog Details -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-6">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Blog Details
                </h3>
            </div>

            <div class="px-4 py-5 sm:p-6 space-y-6">
                <!-- Body -->
                <div>
                    <h4 class="text-sm font-medium text-gray-500 mb-1">Content</h4>

                    <div class="prose prose-gray max-w-none">
                        {!! $blog->body !!}
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
