<!DOCTYPE html>
<html lang="en">
@include("users.header")

<body class="bg-[#F3F3F3] font-just text-[#010504]">

    <!-- Navbar -->
    @include("users.nav")

    <!-- Carousel Section -->
    <section class="relative bg-[#F3F3F3] md:pb-1">
        <div class="relative w-full overflow-hidden">
            <!-- Slides -->
            @php
                $photos = $landlisting->photos ?? [];
                $photos = is_array($photos) ? $photos : [];
                if (count($photos) === 0) {
                    $photos = ['default'];
                }
            @endphp
            <div id="carousel" class="flex transition-transform duration-700 ease-in-out">
                @foreach ($photos as $idx => $photo)
                    @php
                        if ($photo === 'default') {
                            $src = asset('assets/images/landImage.png');
                        } elseif (\Illuminate\Support\Str::startsWith($photo, ['http://', 'https://'])) {
                            $src = $photo;
                        } else {
                            $src = asset('storage/' . $photo);
                        }
                    @endphp
                    <div class="w-full flex-shrink-0">
                        <img src="{{ $src }}" class="w-full h-[90vh] object-cover" alt="Slide {{ $idx + 1 }}">
                    </div>
                @endforeach
            </div>

            <!-- Arrows -->
            @if(count($photos) > 1)
            <button id="prev"
                class="absolute top-1/2 left-6 transform -translate-y-1/2 w-12 h-12 flex items-center justify-center
                        bg-white rounded-full shadow-lg hover:bg-gray-100 transition duration-300 border border-gray-200">
                &#10094;
            </button>

            <button id="next"
                class="absolute top-1/2 right-6 transform -translate-y-1/2 w-12 h-12 flex items-center justify-center
                        bg-white rounded-full shadow-lg hover:bg-gray-100 transition duration-300 border border-gray-200">
                &#10095;
            </button>
            @endif

        </div>

        <!-- Text & Indicators -->
        <div class="flex flex-col items-center mt-6 space-y-3">
            <div class="flex gap-2">
                @foreach ($photos as $i => $photo)
                    <span class="dot w-4 h-4 rounded-full {{ $i === 0 ? 'bg-gray-500' : 'bg-gray-300' }}"></span>
                @endforeach
            </div>
        </div>
    </section>

    <section class="flex flex-col px-4 md:px-12 lg:px-20 py-10 gap-2">
        <h1 class="text-lg font-just font-extrabold">{{ $landlisting->property_name }}</h1>
        <div class="flex flex-row flex-wrap md:flex-nowrap gap-8 w-full">
            <div class="w-full text-sm md:text-base md:w-1/2 md:pr-12">{{ $landlisting->description }}</div>
            <div class="grid grid-cols-1 md:grid-cols-2 grid-rows-2 w-full md:w-1/2 gap-y-5 -mt-3.5">
                <div class="flex flex-col">
                    <div class="flex flex-col gap-1.5">
                        <div class="flex flex-row gap-1.5">
                            <img src="{{ asset("assets/images/tag.svg") }}" class="w-3" alt="">
                            <p>Selling price</p>
                        </div>
                        <p class="font-extrabold">NGN {{ number_format($landlisting->selling_price) }}</p>
                    </div>
                </div>
                <div class="flex flex-col">
                    <p>Plot size</p>
                    <p class="font-extrabold">{{ $landlisting->plot_size }} </p>
                </div>
                <div class="flex flex-col">
                    <div class="flex flex-col gap-1.5">
                        <div class="flex flex-row gap-1.5">
                            <img src="{{ asset("assets/images/location-outline.svg") }}" class="w-3" alt="">
                            <p>Location</p>
                        </div>
                        <p class="font-extrabold">{{ $landlisting->location }}</p>
                    </div>
                </div>
                <div class="flex flex-col">
                    <p>Status</p>
                    <p class="font-extrabold">{{ ucfirst($landlisting->status) }}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="flex flex-row flex-wrap md:flex-nowrap  md:px-12 lg:px-20 md:py-10 py-0 sm:py-6 w-full gap-12 mb-18">
        <div class="flex flex-col w-full text-sm md:text-base px-4 md:w-2/7 gap-8 sm:gap-12 md:gap-24">
            <div class="flex flex-col gap-3">
                <h1 class="text-lg font-extrabold">Agent details</h1>
                <p>{{ optional($landlisting->agent)->name ?? '—' }}</p>
                <p class="pb-3">{{ optional($landlisting->agent)->email ?? 'No email available' }}</p>
                <div class="w-full flex justify-center block md:hidden">
                    @if(optional($landlisting->agent)->email)
                        <a href="mailto:{{ $landlisting->agent->email }}?subject=Inquiry about {{ $landlisting->property_name }}" class="bg-[#FACF07] rounded-full text-base w-full py-3 text-center block">Contact agent</a>
                    @else
                        <button class="bg-gray-300 rounded-full text-base w-full py-3 cursor-not-allowed" disabled>No contact available</button>
                    @endif
                </div>
                <span class="hidden md:block">
                    @if(optional($landlisting->agent)->email)
                        <a href="mailto:{{ $landlisting->agent->email }}?subject=Inquiry about {{ $landlisting->property_name }}" class="bg-[#FACF07] rounded-full text-sm px-6 py-3 md:py-2 inline-block">Contact agent</a>
                    @else
                        <button class="bg-gray-300 rounded-full text-sm px-6 py-3 md:py-2 cursor-not-allowed" disabled>No contact available</button>
                    @endif
                </span>
            </div>
            <div class="flex flex-col gap-2.5 md:gap-4">
                <h1 class="text-lg font-extrabold">Inspection information</h1>
                <p>You can inspect the land once you contact the agent and have fixed a time and date.</p>
            </div>
        </div>
        <div class="w-full md:w-5/7">
            @php
                $link = $landlisting->map_link ?? '';
                $isEmbedUrl = strpos($link, '/maps/embed') !== false;
            @endphp
            @if($isEmbedUrl)
                <iframe
                    src="{{ $link }}"
                    class="w-full h-[70vh] border-0 rounded-lg"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            @else
                <div class="w-full h-[70vh] border border-gray-300 rounded-lg flex flex-col items-center justify-center bg-gray-50 gap-4">
                    <p class="text-gray-600">Map preview not available</p>
                    @if($link)
                        <a href="{{ $link }}" target="_blank" class="bg-[#FACF07] rounded-full text-sm px-6 py-3 hover:bg-yellow-500 transition">
                            View on Google Maps
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </section>

    <!-- Footer Section -->
    @include("users.footer")


</body>

<!-- Carousel Script -->
<script>
    const carousel = document.getElementById('carousel');
    const slides = carousel.children;
    const dots = document.querySelectorAll('.dot');
    let index = 0;

    function showSlide(i) {
        index = (i + slides.length) % slides.length;
        carousel.style.transform = `translateX(-${index * 100}%)`;
        dots.forEach((dot, dIndex) => {
            dot.classList.toggle('bg-gray-500', dIndex === index);
            dot.classList.toggle('bg-gray-300', dIndex !== index);
        });
    }

    if (slides.length > 1) {
        const nextBtn = document.getElementById('next');
        const prevBtn = document.getElementById('prev');
        if (nextBtn) nextBtn.onclick = () => showSlide(index + 1);
        if (prevBtn) prevBtn.onclick = () => showSlide(index - 1);
        // Auto slide every 50s (matches previous timing)
        setInterval(() => showSlide(index + 1), 50000);
    }


    const carouselTwo = document.getElementById('carouselTwo');
    const slidesTwo = carouselTwo.children;
    const dotsTwo = document.querySelectorAll('.dotTwo');
    const textsTwo = [
        "Land description goes here. Land description goes here. Land description goes here.",
        "Beautiful green landscape perfect for building your dream home.",
        "Secure environment with road access and full documentation."
    ];
    const pricesTwo = [
        "350sq.ft going for <span class='font-bold text-lg'>N1.58 million</span>",
        "500sq.ft going for <span class='font-bold text-lg'>N2.10 million</span>",
        "1 plot going for <span class='font-bold text-lg'>N3.50 million</span>"
    ];

    let indexTwo = 0;

    function showSlideTwo(i) {
        indexTwo = (i + slidesTwo.length) % slidesTwo.length;
        carouselTwo.style.transform = `translateX(-${indexTwo * 100}%)`;

        // Update dots
        dotsTwo.forEach((dot, dIndex) => {
            dot.classList.toggle('bg-gray-500', dIndex === indexTwo);
            dot.classList.toggle('bg-gray-300', dIndex !== indexTwo);
        });

        // Update text & price
        document.getElementById('carouselTextTwo').innerHTML = textsTwo[indexTwo];
        document.getElementById('carouselPriceTwo').innerHTML = pricesTwo[indexTwo];
    }

    document.getElementById('nextTwo').onclick = () => showSlideTwo(indexTwo + 1);
    document.getElementById('prevTwo').onclick = () => showSlideTwo(indexTwo - 1);

    // Auto-slide every 5 seconds
    setInterval(() => showSlideTwo(indexTwo + 1), 50000);
</script>

</html>
