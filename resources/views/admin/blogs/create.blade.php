@extends("layouts.admin-layout")

@section("title", "Create New Blog")

@section("content")
    <div class="w-full">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Create New Blog</h1>
            <a href="{{ route("admin.blogs.index") }}"
                class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-lg transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i> Back to Blogs
            </a>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-8">
                <form action="{{ route("admin.blogs.store") }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- Title -->
                        <div class="md:col-span-2">
                            <label for="title" class="block text-lg font-semibold text-gray-700">
                                Blog Title <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-2">
                                <input type="text" name="title" id="title"
                                    class="shadow-sm focus:ring-black focus:border-black block w-full sm:text-xl text-xl border-gray-300 rounded-md @error("title") border-red-500 @enderror"
                                    value="{{ old("title") }}" required>
                                @error("title")
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Thumbnail -->
                        <div class="md:col-span-2">
                            <label for="thumbnail" class="block text-lg font-semibold text-gray-700">
                                Thumbnail Image
                            </label>
                            <div class="mt-2">
                                <input type="file" name="thumbnail" id="thumbnail"
                                    class="shadow-sm focus:ring-black focus:border-black block w-full sm:text-sm text-sm border-gray-300 rounded-md @error("thumbnail") border-red-500 @enderror">
                                @error("thumbnail")
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Publish Date -->
                        <div>
                            <label for="published_at" class="block text-lg font-semibold text-gray-700">
                                Publish Date
                            </label>
                            <div class="mt-1">
                                <input type="date" name="published_at" id="published_at"
                                    class="shadow-sm focus:ring-black focus:border-black block w-full sm:text-sm text-sm border-gray-300 rounded-md @error("published_at") border-red-500 @enderror"
                                    value="{{ old("published_at") }}">
                                @error("published_at")
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Blog Body -->
                        <div class="md:col-span-2">
                            <label for="body" class="block text-lg font-semibold text-gray-700">
                                Blog Content <span class="text-red-500">*</span>
                            </label>

                            <div class="mt-2">
                                <textarea name="body" id="body"
                                    class="shadow-sm focus:ring-black focus:border-black block w-full h-96 sm:text-sm border-gray-300 rounded-md @error("body") border-red-500 @enderror"
                                    >{{ old("body") }}</textarea>

                                @error("body")
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-200">
                        <a href="{{ route("admin.blogs.index") }}"
                            class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                            Cancel
                        </a>

                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-black hover:bg-gray-700">
                            <i class="fas fa-plus mr-2"></i> Create Blog
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>


   <script src="https://cdn.ckeditor.com/ckeditor5/41.2.0/classic/ckeditor.js"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#body'), {
                toolbar: [
                    'heading', '|',
                    'bold', 'italic', 'underline', 'strikethrough', '|',
                    'fontFamily', 'fontSize', 'fontColor', 'fontBackgroundColor', '|',
                    'bulletedList', 'numberedList', '|',
                    'alignment', '|',
                    'link', 'insertTable', 'blockQuote', '|',
                    'undo', 'redo'
                ]
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
