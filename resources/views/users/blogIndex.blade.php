<!DOCTYPE html>
<html lang="en">
@include("users.header")

<body class="bg-[#F3F3F3] font-just text-[#010504]">

    <!-- Navbar -->
    @include("users.nav")

    <!-- HERO SECTION -->
    <section class="relative flex flex-col items-center justify-center min-h-[60vh] bg-center bg-cover text-center"
        style="background-image: url('{{ asset("assets/images/analog-city.png") }}');">

        <div class="absolute inset-0 bg-black/40"></div>

        <h1 class="relative z-20 text-4xl md:text-6xl font-just text-white">
            Omega City Blog
        </h1>

        <p class="relative z-20 text-lg md:text-xl text-white mt-4 max-w-2xl">
            Insights, announcements, and stories shaping the future of real estate.
        </p>
    </section>

    <!-- BLOG LISTING -->
    <section class="max-w-[1100px] px-4 sm:px-6 md:px-12 lg:px-20 py-16 mx-auto">

        <h2 class="text-3xl md:text-5xl font-just mb-10">Latest Articles</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">

            @foreach ($blogs as $blog)
                <div class="bg-white shadow rounded-lg p-4 hover:shadow-md transition">

                    <!-- Thumbnail -->
                    @if ($blog->thumbnail)
                        <img src="{{ asset('storage/' . $blog->thumbnail) }}"
                             class="w-full h-56 object-cover rounded-md mb-4">
                    @endif

                    <!-- Title -->
                    <h3 class="text-xl font-bold mb-2">
                        {{ $blog->title }}
                    </h3>

                    <!-- Excerpt -->
                    <p class="text-gray-600 mb-4 leading-relaxed text-sm">
                        {!! Str::limit(strip_tags($blog->body), 120) !!}
                    </p>

                    <!-- Read More -->
                    <a href="{{ route('blog.show', $blog->slug) }}"
                       class="text-[#010504] font-semibold underline hover:opacity-70">
                        Read More →
                    </a>

                </div>
            @endforeach

        </div>

        <!-- Pagination -->
        <div class="mt-10">
            {{ $blogs->links() }}
        </div>

    </section>

    @include("users.footer")

</body>
</html>
