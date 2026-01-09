<!DOCTYPE html>
<html lang="en">
@include("users.header")

<body class="bg-[#F3F3F3] font-just text-[#010504]">

    <!-- Navbar -->
    @include("users.nav")


    <!-- Blog Single Page -->
    <section class="md:px-12 lg:px-20 px-4 py-10">

        <div class="max-w-4xl mx-auto">

            <!-- Blog Thumbnail -->
            @if ($blog->thumbnail)
                <img src="{{ asset("storage/" . $blog->thumbnail) }}" alt="{{ $blog->title }}"
                    class="w-full h-72 md:h-96 object-cover rounded-lg shadow-md mb-8">
            @endif

            <!-- Blog Title -->
            <h1 class="font-extrabold text-2xl md:text-4xl mb-4">
                {{ $blog->title }}
            </h1>

            <!-- Meta -->
            <div class="flex items-center gap-4 text-[#676968] text-sm mb-6">
                <p>By <span class="font-semibold">{{ $blog->author ?? "Admin" }}</span></p>
                <span>•</span>
                <p>{{ $blog->created_at->format("F j, Y") }}</p>
            </div>

            <!-- Blog Content -->
            <article class="prose prose-lg max-w-none text-[#010504] leading-relaxed">
               {!! $blog->body !!}
            </article>

            <!-- Back Button -->
            <div class="mt-10">
                <a href="{{ route("blog") }}"
                    class="inline-block px-6 py-3 bg-[#010504] text-white rounded-lg hover:bg-[#232323] transition">
                    ← Back to Blogs
                </a>
            </div>

        </div>

    </section>

    <!-- Footer -->
    @include("users.footer")

</body>

</html>
