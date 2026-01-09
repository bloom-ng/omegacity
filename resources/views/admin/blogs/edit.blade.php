@extends("layouts.admin-layout")

@section("title", "Edit Blog")

@section("content")
    <div class="w-full">

        <div class="flex justify-between items-center mb-6">
            <h4 class="text-2xl font-medium text-gray-800">Edit Blog: {{ $blog->title }}</h4>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-8">
                <form action="{{ route("admin.blogs.update", $blog->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- Title -->
                        <div class="md:col-span-2">
                            <label for="title" class="block text-lg font-semibold text-gray-700">
                                Blog Title <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="title" id="title"
                                class="shadow-sm focus:ring-black focus:border-black block w-full border-gray-300 rounded-md @error("title") border-red-500 @enderror"
                                value="{{ old("title", $blog->title) }}" required>
                            @error("title")
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Thumbnail -->
                        <div>
                            <label class="block text-lg font-semibold text-gray-700">Image</label>

                            <!-- Old Thumbnail Preview -->
                            @if ($blog->thumbnail)
                                <img src="{{ asset("storage/" . $blog->thumbnail) }}" alt="Thumbnail"
                                    class="h-24 w-24 object-cover rounded-md mb-3 border">
                            @endif

                            <input type="file" name="thumbnail"
                                class="shadow-sm focus:ring-black focus:border-black block w-full border-gray-300 rounded-md @error("thumbnail") border-red-500 @enderror">
                            @error("thumbnail")
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Published At -->
                        <div>
                            <label for="published_at" class="block text-lg font-semibold text-gray-700">
                                Published Date
                            </label>
                            <input type="date" name="published_at" id="published_at"
                                class="shadow-sm focus:ring-black focus:border-black block w-full border-gray-300 rounded-md @error("published_at") border-red-500 @enderror"
                                value="{{ old("published_at", $blog->published_at ? \Carbon\Carbon::parse($blog->published_at)->format("Y-m-d") : "") }}">
                            @error("published_at")
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Body -->
                        <div class="md:col-span-2">
                            <label for="body" class="block text-lg font-semibold text-gray-700">
                                Body Content <span class="text-red-500">*</span>
                            </label>

                            <textarea name="body" id="body"
                                class="shadow-sm focus:ring-black focus:border-black block w-full h-96 sm:text-base border-gray-300 rounded-md @error("body") border-red-500 @enderror">{{ old("body", $blog->body) }}</textarea>

                            @error("body")
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>


                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200 mt-6">
                        <a href="{{ route("admin.blogs.index") }}"
                            class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300">
                            Cancel
                        </a>

                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-black hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800">
                            <i class="fas fa-save mr-2"></i> Update Blog
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>


     <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

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
