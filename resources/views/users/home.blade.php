<!DOCTYPE html>
<html lang="en">
@include("users.header")
<style>
    @media (max-width: 640px) {
        section .max-w-lg {
            text-align: left !important;
            padding-left: 1.5rem !important;
            /* around Tailwind’s px-6 */
            padding-right: 1.5rem !important;
        }
    }
</style>


<body class="bg-gray-50 text-gray-900">

    <!-- Navbar -->
    @include("users.nav")

    <!-- Hero Section -->
   <section
    class="flex flex-col justify-center min-h-[120vh] px-8 md:px-20 text-black bg-cover bg-center relative"
    style="background-image: url('{{ asset('assets/images/fieldbgimage.png') }}');">

    <!-- Main text -->
    <div class="max-w-lg -mt-72 md:px-16 px-6 text-center sm:text-left">
        <h1 class="text-4xl md:text-5xl font-[justregular] mb-4 leading-tight">
            Secure your future<br>with land you can<br>afford, today.
        </h1>
        <button class="bg-black text-white px-6 py-3 rounded-full font-[justregular] hover:bg-gray-800 transition">
            Get started
        </button>
    </div>

    <!-- Bottom text -->
    <div class="absolute bottom-10 right-10 text-right sm:">
        <p class="text-lg font-[justregular] mb-3 text-left">Building wealth the smart way</p>
        <div class="flex flex-wrap justify-start gap-2 max-w-sm">
            <span
                class="bg-white/20 backdrop-blur- px-2 py-2 rounded-full text-sm font-[justregular] w-[20%] text-center">
                Land
            </span>
            <span
                class="bg-white/20 backdrop-blur- px-6 py-2 rounded-full text-sm font-[justregular] w-[38%] text-center">
                Omega city
            </span>
            <span
                class="bg-white/20 backdrop-blur- px-5 py-2 rounded-full text-sm font-[justregular] w-[38%] text-center">
                Real estate
            </span>
            <span
                class="bg-white/20 backdrop-blur-sm px-6 py-2 rounded-full text-sm font-[justregular] w-[40%] text-center">
                Investment
            </span>
        </div>
    </div>

</section>




    <!-- About Section -->
    <section class="bg-gray-50 py-10 md:py-16">
        <div class="w-full px-4 sm:px-6 md:px-10 lg:px-20">
            <h2
                class="text-3xl sm:text-4xl md:text-5xl font-[justbold] leading-snug sm:leading-[3.5rem] tracking-wide mb-8 text-gray-900 text-center md:text-left md:px-16">
                Omega City &amp; Properties
                <img src="{{ asset("assets/images/OmegaCityBlack.png") }}" alt="Omega Icon"
                    class="inline w-8 sm:w-10 md:w-12 h-8 sm:h-10 md:h-12 align-middle"> <br>
                is your go-to brand in Nigeria<br class="hidden sm:block">
                when it comes to purchasing<br class="hidden sm:block">
                affordable land in Abuja
                <img src="{{ asset("assets/images/imageland.png") }}" alt="Land Image"
                    class="inline-block w-20 sm:w-24 md:w-28 h-14 sm:h-16 md:h-20 object-cover rounded-md align-middle mt-2">
            </h2>

            <div
                class="font-[justregular] block mt-4 text-gray-700 text-base sm:text-lg md:text-xl md:px-16 tracking-wide leading-relaxed text-center md:text-left">
                <p>
                    We’re here to help you become a landowner in <br class="hidden sm:block"> Omega City, the finest
                    city in Abuja.
                </p>
                <p class="mt-2">
                    Not in Abuja? <span class="font-bold">You can get a land with us</span>
                </p>
            </div>
        </div>
    </section>



    <!-- Carousel Section -->
    <section class="relative bg-gray-50 py-10">
        <div class="relative w-full overflow-hidden">
            <!-- Slides -->
            <div id="carousel" class="flex transition-transform duration-700 ease-in-out">
                <div class="w-full flex-shrink-0">
                    <img src="{{ asset("assets/images/carouselimage1.png") }}" class="w-full h-[500px] object-cover"
                        alt="Omega Land 1">
                </div>
                <div class="w-full flex-shrink-0">
                    <img src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1200&q=80"
                        class="w-full h-[500px] object-cover" alt="Omega Land 2">
                </div>
                <div class="w-full flex-shrink-0">
                    <img src="https://images.unsplash.com/photo-1599423300746-b62533397364?auto=format&fit=crop&w=1200&q=80"
                        class="w-full h-[500px] object-cover" alt="Omega Land 3">
                </div>
            </div>

            <!-- Arrows -->
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

        </div>

        <!-- Text & Indicators -->
        <div class="flex flex-col items-center mt-6 space-y-3">
            <p class=" font-[justregular] text-gray-800">
                <span class="font-bold text-lg">Now selling</span> — A plot of land in Omega City 350Sq.ft
            </p>
            <div class="flex gap-2">
                <span class="dot w-4 h-4 rounded-full bg-gray-300"></span>
                <span class="dot w-4 h-4 rounded-full bg-gray-500"></span>
                <span class="dot w-4 h-4 rounded-full bg-gray-300"></span>
            </div>
        </div>
    </section>


    <section class="relative bg-gray-50 py-10">
        <div class='mb-5'>
            <p class="text-4xl text-center md:text-7xl font-justbold text-gray-900 leading-tight">
                One land, many <br>
                possibilities
            </p>
        </div>

        <div class="relative w-full overflow-hidden">
            <!-- Slides -->
            <div id="carouselTwo" class="flex transition-transform duration-700 ease-in-out">
                <div class="w-full flex-shrink-0">
                    <img src="{{ asset("assets/images/locationland.png") }}" class="w-full h-[500px] object-cover"
                        alt="Omega Land 1">
                </div>
                <div class="w-full flex-shrink-0">
                    <img src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1200&q=80"
                        class="w-full h-[500px] object-cover" alt="Omega Land 2">
                </div>
                <div class="w-full flex-shrink-0">
                    <img src="https://images.unsplash.com/photo-1599423300746-b62533397364?auto=format&fit=crop&w=1200&q=80"
                        class="w-full h-[500px] object-cover" alt="Omega Land 3">
                </div>
            </div>

            <!-- Arrows -->
            <button id="prevTwo"
                class="absolute top-1/2 left-6 transform -translate-y-1/2 w-12 h-12 flex items-center justify-center
                         bg-white rounded-full shadow-lg hover:bg-gray-100 transition duration-300 border border-gray-200">
                &#10094;
            </button>

            <button id="nextTwo"
                class="absolute top-1/2 right-6 transform -translate-y-1/2 w-12 h-12 flex items-center justify-center
                         bg-white rounded-full shadow-lg hover:bg-gray-100 transition duration-300 border border-gray-200">
                &#10095;
            </button>
        </div>

        <!-- Text & Indicators -->
        <div class="flex flex-col items-center mt-6 space-y-3">
            <p id="carouselTextTwo" class="font-justregular text-gray-800 text-center">
                Land description goes here. Land description goes here. Land description goes here.
            </p>
            <p id="carouselPriceTwo" class="text-center">
                350sq.ft going for <span class="font-bold text-lg">N1.58 million</span>
            </p>
            <div class="flex gap-2">
                <span class="dotTwo w-4 h-4 rounded-full bg-gray-500"></span>
                <span class="dotTwo w-4 h-4 rounded-full bg-gray-300"></span>
                <span class="dotTwo w-4 h-4 rounded-full bg-gray-300"></span>
            </div>
        </div>
    </section>

    <!-- Section: Own a Land in Omega City -->
    <section class="w-11/12 md:w-10/12 mx-auto py-16 space-y-20">
        <!-- First Row -->
        <div class="grid md:grid-cols-2 gap-10 items-start">
            <!-- Left Text -->
            <div>
                <h2 class="text-5xl md:text-5xl font-[justsansexregular] text-gray-900 leading-tight mt-8">
                    You too can <br>
                    own a land in <br>
                    Omega city
                </h2>
            </div>

            <!-- Features 1 & 2 -->
            <div class="grid sm:grid-cols-2 gap-6">
                <!-- Feature 1 -->
                <div>
                    <div class="flex items-center mb-2">
                        <span
                            class="border border-gray-400 text-gray-700 rounded-md px-4 py-2 mr-2 text-sm font-semibold">1</span>
                    </div>
                    <h3 class="font-[justbold] text-xl text-black">Secure land</h3>
                    <p class="text-gray-600 text-sm mb-6">
                        We offer you land in a highly secured area and environment.
                    </p>
                    <img src="{{ asset("assets/images/securelandimg.png") }}" alt="Secure Land"
                        class="rounded-xl shadow object-cover">
                </div>

                <!-- Feature 2 -->
                <div>
                    <div class="flex items-center mb-2">
                        <span
                            class="border border-gray-400 text-gray-700 rounded-md px-4 py-2 mr-2 text-sm font-semibold">2</span>
                    </div>
                    <h3 class="font-[justbold] text-xl text-black">Affordable</h3>
                    <p class="text-gray-600 text-sm mb-6">
                        Become a landowner at an affordable price.
                    </p>
                    <img src="{{ asset("assets/images/landimg.png") }}" alt="Affordable Land"
                        class="rounded-xl shadow object-cover">
                </div>
            </div>
        </div>

        <!-- Second Row -->
        <div class="grid md:grid-cols-2 gap-10 items-start">
            <!-- Features 3 & 4 -->
            <div class="grid sm:grid-cols-2 gap-6">
                <!-- Feature 3 -->
                <div>
                    <div class="flex items-center mb-2">
                        <span
                            class="border border-gray-400 text-gray-700 rounded-md px-4 py-2 mr-2 text-sm font-semibold">3</span>
                    </div>
                    <h3 class="font-[justbold] text-xl text-black">Spacious</h3>
                    <p class="text-gray-600 text-sm mb-6">
                        Wide expanse of land for your dream property.
                    </p>
                    <img src="{{ asset("assets/images/affordimg.png") }}" alt="Spacious Land"
                        class="rounded-xl shadow object-cover">
                </div>

                <!-- Feature 4 -->
                <div>
                    <div class="flex items-center mb-2">
                        <span
                            class="border border-gray-400 text-gray-700 rounded-md px-4 py-2 mr-2 text-sm font-semibold">4</span>
                    </div>
                    <h3 class="font-[justbold] text-xl text-black">Prime Location</h3>
                    <p class="text-gray-600 text-sm mb-6">
                        Strategically located in fast-developing areas.
                    </p>
                    <img src="{{ asset("assets/images/affordlandimg.png") }}" alt="Prime Land"
                        class="rounded-xl shadow object-cover">
                </div>
            </div>

            <!-- CTA Section (Bottom-Aligned) -->
            <div class="flex flex-col items-start justify-end gap-4 text-left h-full">
                <p class="text-lg font-[justregular] text-gray-800">Let’s get you started today!</p>
                <div class="flex gap-4">
                    <a href="#"
                        class="bg-yellow-400 text-gray-900 font-semibold px-6 py-2 rounded-full hover:bg-yellow-500 transition">Buy
                        a land</a>
                    <a href="#"
                        class="border border-gray-800 text-gray-900 font-semibold px-6 py-2 rounded-full hover:bg-gray-100 transition">Contact
                        us</a>
                </div>
            </div>
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

    document.getElementById('next').onclick = () => showSlide(index + 1);
    document.getElementById('prev').onclick = () => showSlide(index - 1);

    // Auto slide every 5s
    setInterval(() => showSlide(index + 1), 50000);


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
