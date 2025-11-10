<!DOCTYPE html>
<html lang="en">
@include("users.header")
<style>
    @media (max-width: 640px) {
        section .max-w-lg {
            text-align: left !important;
            /* padding-left: 2rem !important; */
            /* around Tailwind’s px-6 */
            /* padding-right: 1.5rem !important; */
        }
    }

    @media (max-width: 640px) {
        .phone {
            text-align: left !important;
            padding-left: 3rem !important;
            padding-bottom: 2rem !important;
        }

        .phone span {
            padding: 5px !important;
            font-size: 0.875rem;
            /* slightly smaller text */
        }

        .phone p {
            font-size: 1.25rem !important;
            /* reduce heading size */
        }
    }
</style>


<body class="bg-[#F3F3F3] font-just text-[#010504]">

    <!-- Navbar -->
    
    @include("users.nav")

    <!-- Hero Section -->
    <section
        class="relative flex flex-col items-center justify-center min-h-[120vh] opacity-90  z-0 md:bg-cover bg-cover bg-center bg-bottom text-center"
        style="background-image: url('{{ asset("assets/images/analog-landscape-city-with-buildings.png") }}');">
        <!-- Main content -->
        <div class="max-w-6xl px-3 sm:px-0 sm:max-w-2xl md:max-w-lg lg:max-w-3xl -mt-[400px] md:-mt-[120px] z-20 lg:-mt-[160px]">
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-just mb-6 sm:leading-12 lg:leading-16"> Secure a land you can afford with
                Omega city & properties </h1> 
                <a href="/contact-us"><button
                class="bg-black text-white px-16 py-3 rounded-full font-just hover:bg-gray-800 transition duration-300">
                Contact Us </button></a>
        </div>

        <!-- Bottom black bar -->
        <div class="absolute bottom-0 w-full bg-[#F3F3F3] text-sm sm:text-lg md:text-xl lg:text-2xl pt-8 md:py-12 px-6">
            <div
                class="grid grid-cols-2 grid-rows-2 md:flex md:flex-nowrap items-center justify-center gap-5.5 max-w-5xl mx-auto text-center">
                <!-- Text -->
                <p
                    class="col-span-2 md:col-span-1 font-just font-extrabold mb-2 md:mb-0 md:mr-6 whitespace-nowrap">
                    Building wealth the smart way
                </p>


                <!-- Tags -->
                <div class="hidden md:block">
                    <span class="font-light  text-sm text-center">
                        Land
                    </span>
                    <span class="font-light  text-sm text-center">
                        Real estate
                    </span>
                    <span class="font-light  text-sm text-center">
                        Investment
                    </span>
                </div>
                <div class="block md:hidden flex flex-row items-center justify-center gap-6 w-[90vw] -mt-12 mx-auto">
                    <span class="font-light  text-sm text-center">
                        Land
                    </span>
                    <span class="font-light  text-sm text-center">
                        Real estate
                    </span>
                    <span class="font-light  text-sm text-center">
                        Investment
                    </span>
                </div>
                
            </div>
        </div>

    </section>

    <!-- About Section -->
    <section class="bg-[#F3F3F3] pt-6 md:py-16">
        <div class="w-full px-4 sm:px-6 md:px-10 lg:px-20">
            <h2
                class="text-2xl sm:pr-1 pr-[50px] sm:text-3xl md:text-5xl font-just leading-snug sm:leading-[3.5rem] tracking-wide mb-8 text-gray-900
                text-left text-justify md:text-left md:px-16">
                Omega City &amp; Properties
                <img src="{{ asset("assets/images/OmegaCityBlack.png") }}" alt="Omega Icon"
                    class="inline w-7 sm:w-10 md:w-12 h-7 sm:h-10 md:h-14 align-middle"> <br class="hidden sm:block">
                is your go-to brand in Nigeria <br class="hidden sm:block">
                when it comes to purchasing<br class="hidden sm:block">
                affordable land in Abuja
                <img src="{{ asset("assets/images/imageland.png") }}" alt="Land Image"
                    class="inline-block w-[55px] sm:w-24 md:w-32 lg:w-40 h-8 -mt-1.5 sm:h-16 md:h-16 object-none sm:object-cover rounded-md align-middle md:mt-2">
            </h2>

            <div
                class="font-just block mt-4 text-gray-700 text-base sm:text-lg md:text-xl md:px-16 tracking-wide leading-6 md:leading-relaxed text-left">
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
    <section class="relative bg-[#F3F3F3] py-10">
        <div class="relative w-full overflow-hidden">
            <!-- Slides -->
            <div id="carousel" class="flex transition-transform duration-700 ease-in-out">
                <div class="w-full flex-shrink-0">
                    <img src="{{ asset("assets/images/modern-country-houses-construction.png") }}" class="w-full h-[500px] lg:h-[600px] object-cover"
                        alt="Omega Land 1">
                </div>
                <div class="w-full flex-shrink-0">
                    <img src="{{ asset("assets/images/carousel-img-2.png") }}"
                        class="w-full h-[500px] lg:h-[600px] object-cover" alt="Omega Land 2">
                </div>
                <div class="w-full flex-shrink-0">
                    <img src="{{ asset("assets/images/carousel-img-3.png") }}"
                        class="w-full h-[500px] lg:h-[600px] object-cover" alt="Omega Land 2">
                </div>
                <div class="w-full flex-shrink-0">
                    <img src="{{ asset("assets/images/carousel-img-4.png") }}"
                        class="w-full h-[500px] lg:h-[600px] object-cover" alt="Omega Land 2">
                </div>
                <div class="w-full flex-shrink-0">
                    <img src="{{ asset("assets/images/carousel-img-5.png") }}"
                        class="w-full h-[500px] lg:h-[600px] object-cover" alt="Omega Land 2">
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
            <p class="text-sm sm:text-lg px-3 sm:px-0 font-just text-gray-800">
                <span class="font-bold text-sm sm:text-lg">Now selling</span> — A plot of land in Omega City 350Sq.ft
            </p>
            <div class="flex gap-2">
                <span class="dot w-4 h-4 rounded-full bg-gray-300"></span>
                <span class="dot w-4 h-4 rounded-full bg-gray-500"></span>
                <span class="dot w-4 h-4 rounded-full bg-gray-300"></span>
                <span class="dot w-4 h-4 rounded-full bg-gray-300"></span>
                <span class="dot w-4 h-4 rounded-full bg-gray-300"></span>
            </div>
        </div>
    </section>


    <section class="relative bg-[#F3F3F3] py-10">
        <div class='mb-5'>
            <p class="text-4xl text-center md:text-7xl font-just text-gray-900 leading-tight">
                One land, many <br>
                possibilities
            </p>
        </div>

        <div class="relative w-full overflow-hidden">
            <!-- Slides -->
            <div id="carouselTwo" class="flex transition-transform duration-700 ease-in-out">
                <div class="w-full flex-shrink-0">
                    <img src="{{ asset("assets/images/2nd-carousel-img-1.png") }}" class="w-full h-[500px] lg:h-[600px] object-cover"
                        alt="Omega Land 1">
                </div>
                <div class="w-full flex-shrink-0">
                    <img src="{{ asset("assets/images/2nd-carousel-img-2.png") }}" class="w-full h-[500px] lg:h-[600px] object-cover"
                        alt="Omega Land 2">
                </div>
                <div class="w-full flex-shrink-0">
                    <img src="{{ asset("assets/images/2nd-carousel-img-3.png") }}" class="w-full h-[500px] lg:h-[600px] object-cover"
                        alt="Omega Land 3">
                </div>
                <div class="w-full flex-shrink-0">
                    <img src="{{ asset("assets/images/2nd-carousel-img-4.png") }}" class="w-full h-[500px] lg:h-[600px] object-cover"
                        alt="Omega Land 4">
                </div>
                <div class="w-full flex-shrink-0">
                    <img src="{{ asset("assets/images/2nd-carousel-img-5.png") }}" class="w-full h-[500px] lg:h-[600px] object-cover"
                        alt="Omega Land 5">
                </div>
            </div>

            <!-- Arrows -->
            <button id="prevTwo"
                class="absolute hidden md:block top-1/2 left-6 transform -translate-y-1/2 w-12 h-12 flex items-center justify-center
                         bg-white rounded-full shadow-lg hover:bg-gray-100 transition duration-300 border border-gray-200">
                &#10094;
            </button>

            <button id="nextTwo"
                class="absolute hidden md:block top-1/2 right-6 transform -translate-y-1/2 w-12 h-12 flex items-center justify-center
                         bg-white rounded-full shadow-lg hover:bg-gray-100 transition duration-300 border border-gray-200">
                &#10095;
            </button>
        </div>

        <!-- Text & Indicators -->
        <div class="flex flex-col items-center mt-6 space-y-3">
            <p id="carouselTextTwo" class="text-sm sm:text-lg px-2 lg:px-0 md:text-lg font-just text-gray-800 text-center">
                Beautiful green landscape perfect for building your dream home.
            </p>
            <!-- <p id="carouselPriceTwo" class="text-center">
                350sq.ft going for <span class="font-bold text-lg">N1.58 million</span>
            </p> -->
            <div class="flex gap-2">
                <span class="dotTwo w-4 h-4 rounded-full bg-gray-500"></span>
                <span class="dotTwo w-4 h-4 rounded-full bg-gray-300"></span>
                <span class="dotTwo w-4 h-4 rounded-full bg-gray-300"></span>
                <span class="dotTwo w-4 h-4 rounded-full bg-gray-500"></span>
                <span class="dotTwo w-4 h-4 rounded-full bg-gray-300"></span>
            </div>
        </div>
    </section>

    <!-- Section: Own a Land in Omega City -->
    <section class="w-11/12 md:w-10/12 mx-auto sm:py-16 space-y-8 md:space-y-20">
        <!-- First Row -->
        <div class="grid md:grid-cols-2 gap-6 sm:gap-10 items-start">
            <!-- Left Text -->
            <div>
                <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl text-gray-900 leading-tight pb-5 sm:pb-0 sm:mt-8">
                    <span class="block md:hidden">
                        You too can own a <br>
                        land in Omega city
                    </span>
                    <span class="hidden md:block">
                        You too can <br>
                        own a land in <br>
                        Omega city
                    </span>
                </h2>
            </div>

            <!-- Features 1 & 2 -->
            <div class="grid sm:grid-cols-2 gap-8 sm:gap-6">
                <!-- Feature 1 -->
                <div>
                    <div class="flex items-center mb-2">
                        <span
                            class="border border-gray-400 text-gray-700 rounded-md px-4 py-2 mr-2 text-sm font-semibold">1</span>
                    </div>
                    <h3 class="text-2xl text-black">Secure land</h3>
                    <p class="text-gray-600 text-sm mb-6">
                        We offer you land in a highly secured area and environment.
                    </p>
                    <img src="{{ asset("assets/images/securelandimg1.png") }}" alt="Secure Land"
                        class="rounded-xl shadow object-cover">
                </div>

                <!-- Feature 2 -->
                <div>
                    <div class="flex items-center mb-2">
                        <span
                            class="border border-gray-400 text-gray-700 rounded-md px-4 py-2 mr-2 text-sm font-semibold">2</span>
                    </div>
                    <h3 class="text-2xl text-black">Affordable</h3>
                    <p class="text-gray-600 text-sm mb-6">
                        Become a landowner at an affordable price.
                    </p>
                    <img src="{{ asset("assets/images/securelandimg2.png") }}" alt="Affordable Land"
                        class="rounded-xl shadow object-cover">
                </div>
            </div>
        </div>

        <!-- Second Row -->
        <div class="grid md:grid-cols-2 gap-10 items-start">
            <!-- Features 3 & 4 -->
            <div class="grid sm:grid-cols-2 gap-8 sm:gap-6">
                <!-- Feature 3 -->
                <div>
                    <div class="flex items-center mb-2">
                        <span
                            class="border border-gray-400 text-gray-700 rounded-md px-4 py-2 mr-2 text-sm font-semibold">3</span>
                    </div>
                    <h3 class="text-2xl text-black">Spacious</h3>
                    <p class="text-gray-600 text-sm mb-6">
                        Wide expanse of land for your dream property.
                    </p>
                    <img src="{{ asset("assets/images/securelandimg3.png") }}" alt="Spacious Land"
                        class="rounded-xl shadow object-cover">
                </div>

                <!-- Feature 4 -->
                <div>
                    <div class="flex items-center mb-2">
                        <span
                            class="border border-gray-400 text-gray-700 rounded-md px-4 py-2 mr-2 text-sm font-semibold">4</span>
                    </div>
                    <h3 class="text-2xl text-black">Prime Location</h3>
                    <p class="text-gray-600 text-sm mb-6">
                        Strategically located in fast-developing areas.
                    </p>
                    <img src="{{ asset("assets/images/securelandimg4.png") }}" alt="Prime Land"
                        class="rounded-xl shadow object-cover">
                </div>
            </div>

            <!-- CTA Section (Bottom-Aligned) -->
            <div class="flex flex-col items-start justify-end gap-4 text-left h-full">
                <p class="text-xl sm:text-3xl font-just text-gray-800">Let’s get you started today!</p>
                <div class="flex gap-8">
                    <a href="#"
                        class="bg-yellow-400 text-gray-900 text-xl font-just px-14 py-2 rounded-full hover:bg-yellow-500 transition">
                        Buy a land
                    </a>

                    <a href="/contact-us"
                        class="text-gray-900 text-lg sm:text-base underline underline-offset-8 hover:text-yellow-500 transition mt-2">
                        Contact us
                    </a>
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
        "Secure environment with road access and full documentation.",
        "Beautiful green landscape perfect for building your dream home.",
        "Secure environment with road access and full documentation.",
        "Secure environment with road access and full documentation.",
        "Secure environment with road access and full documentation.",
    ];
    const pricesTwo = [
        // "350sq.ft going for <span class='font-bold text-lg'>N1.58 million</span>",
        // "500sq.ft going for <span class='font-bold text-lg'>N2.10 million</span>",
        // "1 plot going for <span class='font-bold text-lg'>N3.50 million</span>",
        // "350sq.ft going for <span class='font-bold text-lg'>N1.58 million</span>",
        // "500sq.ft going for <span class='font-bold text-lg'>N2.10 million</span>",
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
