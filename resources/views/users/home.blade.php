<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Omega Properties</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        justsansexbold: ['"just-sans-ex-bold"', 'sans-serif'],
                        justsansexregular: ['"just-sans-regular"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-50 text-gray-900">

    <!-- Navbar -->
    <nav x-data="{ open: false }"
        class="absolute top-5 left-1/2 transform -translate-x-1/2 w-11/12 md:w-4/5
                bg-white/20 backdrop-blur- border border-white/30 rounded-full px-10
                flex items-center justify-between z-50">

        <!-- Logo -->
        <div class="flex items-center space-x-2">
            <img src="{{ asset("assets/images/OmegaCityLogoYellow.png") }}" alt="Omega Logo">
        </div>

        <!-- Desktop Links -->
        <div class="hidden md:flex items-center space-x-8 text-black font-[justsansexregular]">
            <a href="#" class="hover:text-blue-600">About</a>
            <a href="#" class="hover:text-blue-600">Land</a>
            <a href="#" class="hover:text-blue-600">Contact us</a>
        </div>

        <!-- Buy button (desktop) -->
        <button
            class="hidden md:block bg-yellow-400 hover:bg-yellow-500 text-black font-[justsansexregular] px-5 py-2 rounded-full shadow-md">
            Buy a land
        </button>

        <!-- Hamburger Button -->
        <button @click="open = !open" class="md:hidden text-black focus:outline-none">
            <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- Mobile Menu -->
        <div x-show="open" x-transition
            class="absolute top-[70px] left-0 w-full bg-white/80 backdrop-blur-md rounded-xl shadow-lg md:hidden py-4">
            <div class="flex flex-col items-center space-y-4 text-black font-[justsansexregular]">
                <a href="#" class="hover:text-blue-600">About</a>
                <a href="#" class="hover:text-blue-600">Land</a>
                <a href="#" class="hover:text-blue-600">Contact us</a>
                <button
                    class="bg-yellow-400 hover:bg-yellow-500 text-black font-semibold px-5 py-2 rounded-full shadow-md">
                    Buy a land
                </button>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="flex flex-col justify-center h-screen px-6 md:px-20 text-black bg-cover bg-center relative"
        style="background-image: url('{{ asset("assets/images/fieldbgimage.png") }}');">
        <div class="max-w-lg -mt-40 px-16">
            <h1 class="text-4xl md:text-5xl font-[justsansexregular] mb-4 leading-tight">
                Secure your future<br>with land you can<br>afford, today.
            </h1>
            <button
                class="bg-black text-white px-6 py-3 rounded-full font-[justsansexregular] hover:bg-gray-800 transition">
                Get started
            </button>
        </div>

        <div class="absolute bottom-16 right-10 text-right">
            <p class="text-lg font-medium mb-3">Building wealth the smart way</p>
            <div class="flex flex-wrap justify-end gap-3">
                <span class="bg-white/30 backdrop-blur-md px-4 py-2 rounded-full text-sm font-medium">Land</span>
                <span class="bg-white/30 backdrop-blur-md px-4 py-2 rounded-full text-sm font-medium">Omega city</span>
                <span class="bg-white/30 backdrop-blur-md px-4 py-2 rounded-full text-sm font-medium">Real estate</span>
                <span class="bg-white/30 backdrop-blur-md px-4 py-2 rounded-full text-sm font-medium">Investment</span>
            </div>
        </div>
    </section>


    <!-- About Section -->
    <section class="bg-gray-50 py-16">
        <div class="w-full px-6 md:px-10 lg:px-20">
            <h2
                class="text-5xl md:text-5xl font-[justsansexbold] leading-[5] tracking-wide mb-8 text-gray-900 text-left px-16">
                Omega City &amp; Properties
                <img src="{{ asset("assets/images/OmegaCityBlack.png") }}" alt="Omega Icon"
                    class="inline w-12 h-12 align-middle"> <br>
                is your go to brand in Nigeria<br>
                when it comes to purchasing<br>
                affordable land in Abuja
                <img src="{{ asset("assets/images/imageland.png") }}" alt="Land Image"
                    class="inline-block w-30 h-20 object-cover rounded-md align-middle mt-2">
                <br> <!-- ensures break after image -->

            </h2>

            <div class="font-[justsansexregular] block mt-3 text-gray-700 text-xl px-16 tracking-wide leading-12">
                <p>
                    We’re here to help you become a landowner in Omega <br> City, the finest city in Abuja.
                </p>
                <p>
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
            <p class=" font-[justsansexregular] text-gray-800">
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
            <p class="text-4xl text-center md:text-7xl font-[justsansexbold] text-gray-900 leading-tight">
                One land, many <br>
                possibilities
            </p>
        </div>
        <div class="relative w-full overflow-hidden">
            <!-- Slides -->
            <div id="carousel" class="flex transition-transform duration-700 ease-in-out">
                <div class="w-full flex-shrink-0">
                    <img src="{{ asset("assets/images/locationland.png") }}" class="w-full h-[500px] object-cover"
                        alt="Omega Land 1">
                </div>
            </div>



        </div>

        <!-- Text & Indicators -->
        <div class="flex flex-col items-center mt-6 space-y-3">
            <p class=" font-[justsansexregular] text-gray-800">
                Land description goes here. Land description goes here. Land description goes here. Land description goes here. Land description goes here.
            </p>
            <p>
                350sq.ft going for  <span class="font-bold text-lg">N1.58 million </span>
            </p>
            <div class="flex gap-2">
                <span class="dot w-4 h-4 rounded-full bg-gray-300"></span>
                <span class="dot w-4 h-4 rounded-full bg-gray-500"></span>
                <span class="dot w-4 h-4 rounded-full bg-gray-300"></span>
            </div>
        </div>
    </section>


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
</script>

</html>
