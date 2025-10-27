<!DOCTYPE html>
<html lang="en">
@include("users.header")

<body class="bg-[#F3F3F3] font-just text-[#010504]">

    <!-- Navbar -->
    @include("users.nav")

    <!-- Carousel Section -->
    <section class="relative bg-[#F3F3F3] md:py-10">
        <div class="relative w-full overflow-hidden">
            <!-- Slides -->
            <div id="carousel" class="flex transition-transform duration-700 ease-in-out">
                <div class="w-full flex-shrink-0">
                    <img src="{{ asset("assets/images/carouselimage1.png") }}" class="w-full h-[90vh] object-cover"
                        alt="Omega Land 1">
                </div>
                <div class="w-full flex-shrink-0">
                    <img src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1200&q=80"
                        class="w-full h-[90vh] object-cover" alt="Omega Land 2">
                </div>
                <div class="w-full flex-shrink-0">
                    <img src="https://images.unsplash.com/photo-1599423300746-b62533397364?auto=format&fit=crop&w=1200&q=80"
                        class="w-full h-[90vh] object-cover" alt="Omega Land 3">
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
            <!-- <p class=" font-just text-gray-800">
                <span class="font-bold text-lg">Now selling</span> — A plot of land in Omega City 350Sq.ft
            </p> -->
            <div class="flex gap-2">
                <span class="dot w-4 h-4 rounded-full bg-gray-300"></span>
                <span class="dot w-4 h-4 rounded-full bg-gray-500"></span>
                <span class="dot w-4 h-4 rounded-full bg-gray-300"></span>
            </div>
        </div>
    </section>

    <section class="flex flex-col px-4 md:px-12 lg:px-20 py-10 gap-2">
        <h1 class="text-lg font-just font-extrabold">Land name</h1>
        <div class="flex flex-row flex-wrap md:flex-nowrap gap-8 w-full">
            <div class="w-full text-sm md:text-base md:w-1/2 md:pr-12">Land description goes here. Land description goes here. 
                Land description goes here. Land description goes here. 
                Land description goes here. Land description goes here. 
                Land description goes here. Land description goes here. 
                Land description goes here. Land description goes here. 
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 grid-rows-2 w-full md:w-1/2 gap-y-5 -mt-3.5">
                <div class="flex flex-col">
                    <div class="flex flex-col gap-1.5">
                        <div class="flex flex-row gap-1.5">
                            <img src="{{ asset("assets/images/tag.svg") }}" class="w-3" alt="">
                            <p>Selling price</p>
                        </div>
                        <p class="font-extrabold">NGN 1, 000,000</p>
                    </div>
                </div>
                <div class="flex flex-col">
                    <p>Plot size</p>
                    <p class="font-extrabold">350sq.ft</p>
                </div>
                <div class="flex flex-col">
                    <div class="flex flex-col gap-1.5">
                        <div class="flex flex-row gap-1.5">
                            <img src="{{ asset("assets/images/location-outline.svg") }}" class="w-3" alt="">
                            <p>Location</p>
                        </div>
                        <p class="font-extrabold">Omega city estate gate</p>
                    </div>
                </div>
                <div class="flex flex-col">
                    <p>Status</p>
                    <p class="font-extrabold">Available</p>
                </div>
            </div>
        </div>
    </section>

    <section class="flex flex-row flex-wrap md:flex-nowrap  md:px-12 lg:px-20 md:py-10 py-0 sm:py-6 w-full gap-12">
        <div class="flex flex-col w-full text-sm md:text-base px-4 md:w-2/7 gap-8 sm:gap-12 md:gap-24">
            <div class="flex flex-col gap-3">
                <h1 class="text-lg font-extrabold">Agent details</h1>
                <p>Name</p>
                <p class="pb-3">Sales agent ID</p>
                <div class="w-full flex justify-center block md:hidden">
                    <button class="bg-[#FACF07] rounded-full text-base w-full py-3">Contact agent</button>
                </div>
                <span class="hidden md:block">
                    <button class="bg-[#FACF07] rounded-full text-sm px-6 py-3 md:py-2">Contact agent</button>
                </span>
            </div>
            <div class="flex flex-col gap-2.5 md:gap-4">
                <h1 class="text-lg font-extrabold">Inspection information</h1>
                <p>You can inspect the land once you contact the agent and have fixed a time and date.</p>
            </div>
        </div>
        <div class="w-full md:w-5/7">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3939.8237284234666!2d7.409621!3d9.077751!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x104e0ba4c5815641%3A0x7d0b8c6d7ac9a2e6!2sApo%20Resettlement%2C%20Abuja!5e0!3m2!1sen!2sng!4v1234567890"
                class="w-full h-[70vh] border-0 rounded-lg" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </section>

    <section class="flex flex-col md:px-20 py-10 w-full gap-12 justify-center items-center">
        <h1 class="text-3xl lg:text-5xl">Other listings</h1>
        <!-- Extra Small Swiper (< 640px) - 1 slide -->
        <swiper-container slides-per-view="1" speed="500" loop="true" autoplay="true" css-mode="true"
            class="flex items-center justify-center flex-row sm:hidden w-full px-4">
            <swiper-slide>
            <div class="flex h-full w-72 flex-col rounded-b-lg border-[0.5px] rounded-lg border-[#676968]">
                <div class="h-[81%] w-full rounded-t-lg">
                    <img src="{{ asset("assets/images/landImage.png") }}" class="object-cover h-full w-full rounded-t-lg" alt="land image">
                </div>
                <div class="h-[19%] text-xs lg:text-base gap-2 rounded-b-lg p-2.5 ">
                    <p>2 plots of land 350sq.ft</p>
                    <div class="flex flex-row justify-between">
                        <p class="font-extrabold">NGN 1.58 million</p>
                        <p class="border-b-[0.5px] border-[#676968] px-1.5">View Land</p>
                    </div>
                </div>
            </div>
            </swiper-slide>
            <swiper-slide>
            <div class="flex h-full w-72 flex-col rounded-b-lg border-[0.5px] rounded-lg border-[#676968]">
                <div class="h-[81%] w-full rounded-t-lg">
                    <img src="{{ asset("assets/images/landImage.png") }}" class="object-cover h-full w-full rounded-t-lg" alt="land image">
                </div>
                <div class="h-[19%] text-xs lg:text-base gap-2 rounded-b-lg p-2.5 ">
                    <p>2 plots of land 350sq.ft</p>
                    <div class="flex flex-row justify-between">
                        <p class="font-extrabold">NGN 1.58 million</p>
                        <p class="border-b-[0.5px] border-[#676968] px-1.5">View Land</p>
                    </div>
                </div>
            </div>
            </swiper-slide>
            <swiper-slide>
            <div class="flex h-full w-72 flex-col rounded-b-lg border-[0.5px] rounded-lg border-[#676968]">
                <div class="h-[81%] w-full rounded-t-lg">
                    <img src="{{ asset("assets/images/landImage.png") }}" class="object-cover h-full w-full rounded-t-lg" alt="land image">
                </div>
                <div class="h-[19%] text-xs lg:text-base gap-2 rounded-b-lg p-2.5 ">
                    <p>2 plots of land 350sq.ft</p>
                    <div class="flex flex-row justify-between">
                        <p class="font-extrabold">NGN 1.58 million</p>
                        <p class="border-b-[0.5px] border-[#676968] px-1.5">View Land</p>
                    </div>
                </div>
            </div>
            </swiper-slide>
        </swiper-container>
        
        <!-- Small Swiper (640-767px) - 2 slides -->
        <swiper-container slides-per-view="2" speed="500" loop="true" autoplay="true" css-mode="true"
            class="hidden sm:flex md:hidden w-full px-4">
            <swiper-slide>
            <div class="flex h-full w-72 flex-col rounded-b-lg border-[0.5px] rounded-lg border-[#676968]">
                <div class="h-[81%] w-full rounded-t-lg">
                    <img src="{{ asset("assets/images/landImage.png") }}" class="object-cover h-full w-full rounded-t-lg" alt="land image">
                </div>
                <div class="h-[19%] text-xs lg:text-base gap-2 rounded-b-lg p-2.5 ">
                    <p>2 plots of land 350sq.ft</p>
                    <div class="flex flex-row justify-between">
                        <p class="font-extrabold">NGN 1.58 million</p>
                        <p class="border-b-[0.5px] border-[#676968] px-1.5">View Land</p>
                    </div>
                </div>
            </div>
            </swiper-slide>
            <swiper-slide>
            <div class="flex h-full w-72 flex-col rounded-b-lg border-[0.5px] rounded-lg border-[#676968]">
                <div class="h-[81%] w-full rounded-t-lg">
                    <img src="{{ asset("assets/images/landImage.png") }}" class="object-cover h-full w-full rounded-t-lg" alt="land image">
                </div>
                <div class="h-[19%] text-xs lg:text-base gap-2 rounded-b-lg p-2.5 ">
                    <p>2 plots of land 350sq.ft</p>
                    <div class="flex flex-row justify-between">
                        <p class="font-extrabold">NGN 1.58 million</p>
                        <p class="border-b-[0.5px] border-[#676968] px-1.5">View Land</p>
                    </div>
                </div>
            </div>
            </swiper-slide>
            <swiper-slide>
            <div class="flex h-full w-72 flex-col rounded-b-lg border-[0.5px] rounded-lg border-[#676968]">
                <div class="h-[81%] w-full rounded-t-lg">
                    <img src="{{ asset("assets/images/landImage.png") }}" class="object-cover h-full w-full rounded-t-lg" alt="land image">
                </div>
                <div class="h-[19%] text-xs lg:text-base gap-2 rounded-b-lg p-2.5 ">
                    <p>2 plots of land 350sq.ft</p>
                    <div class="flex flex-row justify-between">
                        <p class="font-extrabold">NGN 1.58 million</p>
                        <p class="border-b-[0.5px] border-[#676968] px-1.5">View Land</p>
                    </div>
                </div>
            </div>
            </swiper-slide>
        </swiper-container>
        
        <!-- Desktop Grid (≥ 768px) -->
        <div class="hidden md:grid grid-cols-3 md:h-[45vh] gap-3">
            <div class="flex h-full flex-col rounded-b-lg border-[0.5px] rounded-lg border-[#676968]">
                <div class="h-[81%] w-full rounded-t-lg">
                    <img src="{{ asset("assets/images/landImage.png") }}" class="object-cover h-full w-full rounded-t-lg" alt="land image">
                </div>
                <div class="h-[19%] text-xs lg:text-base gap-2 rounded-b-lg p-2.5 ">
                    <p>2 plots of land 350sq.ft</p>
                    <div class="flex flex-row justify-between">
                        <p class="font-extrabold">NGN 1.58 million</p>
                        <p class="border-b-[0.5px] border-[#676968] px-1.5">View Land</p>
                    </div>
                </div>
            </div>
            <div class="flex h-full flex-col rounded-b-lg border-[0.5px] rounded-lg border-[#676968]">
                <div class="h-[81%] w-full rounded-t-lg">
                    <img src="{{ asset("assets/images/landImage.png") }}" class="object-cover h-full w-full rounded-t-lg" alt="land image">
                </div>
                <div class="h-[19%] text-xs lg:text-base gap-2 rounded-b-lg p-2.5 ">
                    <p>2 plots of land 350sq.ft</p>
                    <div class="flex flex-row justify-between">
                        <p class="font-extrabold">NGN 1.58 million</p>
                        <p class="border-b-[0.5px] border-[#676968] px-1.5">View Land</p>
                    </div>
                </div>
            </div>
            <div class="flex h-full flex-col rounded-b-lg border-[0.5px] rounded-lg border-[#676968]">
                <div class="h-[81%] w-full rounded-t-lg">
                    <img src="{{ asset("assets/images/landImage.png") }}" class="object-cover h-full w-full rounded-t-lg" alt="land image">
                </div>
                <div class="h-[19%] text-xs lg:text-base gap-2 rounded-b-lg p-2.5 ">
                    <p>2 plots of land 350sq.ft</p>
                    <div class="flex flex-row justify-between">
                        <p class="font-extrabold">NGN 1.58 million</p>
                        <p class="border-b-[0.5px] border-[#676968] px-1.5">View Land</p>
                    </div>
                </div>
            </div>
        </div>
        <span class="flex justify-center pt-20">
            <button class="bg-[#FACF07] rounded-full text-sm px-12 py-2">View more</button>
        </span>
    </section>

    <!-- Footer Section -->
    @include("users.footer")


</body>

</html>
