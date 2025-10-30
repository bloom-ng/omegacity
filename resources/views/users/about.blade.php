<!DOCTYPE html>
<html lang="en">
@include("users.header")

<body class="bg-[#F3F3F3] font-just text-[#010504]">

    <!-- Navbar -->
    @include("users.nav")

    <!-- hero section -->
    <section class="relative flex flex-col items-center justify-center min-h-[120vh] z-0 md:bg-cover h-[90vh] bg-center text-center" 
            style="background-image: url('{{ asset("assets/images/analog-city.png") }}');">
        
        <!-- Main content -->
        <div class="max-w-6xl hidden md:block md:-mt-[120px] z-20 lg:-mt-[160px]">
            <img src="{{ asset("assets/images/Omega-City-White.svg") }}" alt="Omega City Logo" class="w-[900px]">
        </div>
        <div class="px-1 -mt-[150px] block md:hidden z-20">
            <img src="{{ asset("assets/images/Omega-City-White.png") }}" alt="Omega City Logo" class="w-[1500px]">
        </div>
        <div class="absolute inset-0 z-10 pointer-events-none bg-[#010504]/10"></div>
        <!-- Bottom black bar -->
        <div class="absolute z-20 bottom-0 w-full bg-[#F3F3F3] text-lg md:text-xl lg:text-2xl py-6 sm:py-10 md:py-12 px-6">
            <div
                class="grid grid-rows-2 h-12 sm:h-0 md:flex md:flex-nowrap items-center justify-center gap-3 sm:gap-5 max-w-5xl mx-auto text-center">
                <!-- Text -->
                <p
                    class="font-just  font-extrabold sm:mb-2 md:mb-0 whitespace-nowrap">
                    Omega city & properties
                </p>

                <!-- Tags -->
                <span class="font-[0.5rem] text-center">
                    Nigeria’s number 1 real estate brand
                </span>
            </div>
        </div>

    </section>

    <section class="flex flex-col gap-6 max-w-[980px] px-4 sm:px-6 md:px-12 lg:px-20 py-10">
        <h1 class="text-3xl text-left md:text-6xl font-just">Omega city & properties is a fast rising real estate brand that offers affordable land for sale in Abuja.</h1>
        <p class="text-lg max-w-[500px]">We’re here to help you become a landowner in Omega city, the finest city in Abuja. We’re here to help you become a landowner in Omega city, the finest city in</p>
    </section>

    <section class="flex flex-col md:flex-row w-full gap-6 px-4  sm:px-6 md:px-12 lg:px-20 py-4 md:py-10">
        <div class="flex flex-col md:flex-row w-full items-start md:items-center justify-between gap-8">
            <div class="flex flex-col gap-2">
                <h1 class="text-3xl md:text-6xl font-just">95%</h1>
                <p class="text-lg">Customer satisfaction</p>
            </div>
            <div class="flex flex-col gap-2">
                <h1 class="text-3xl md:text-6xl font-just">140+</h1>
                <p class="text-lg">Plots of land sold</p>
            </div>
            <div class="flex flex-col gap-2">
                <h1 class="text-3xl md:text-6xl font-just">120+</h1>
                <p class="text-lg">New land owners</p>
            </div>
        </div>
    </section>

    <h1 class="block md:hidden px-4 pt-4 -mb-4 text-2xl font-just max-w-[450px]">You too can own a property in Omega city</h1>
    <section class="h-screen px-4 sm:px-6 md:px-12 lg:px-20 py-10">
        <div class="flex flex-col md:flex-row sm:border-[0.5px] sm:border-[#676968] w-full h-full rounded-xl">
            <div class="relative md:w-1/2">
                <div class="hidden md:block absolute top-1/2 left-8 z-20 bg-[#F3F3F3] p-3 px-3.5 rounded-full">
                    <img src="{{ asset("assets/images/arrow-left.svg") }}" alt="Arrow Left" class="w-2">
                </div>
                <img src="{{ asset("assets/images/panoramic-houses.png") }}" alt="Panoramic Houses" class="z-10 hidden md:block rounded-l-xl h-full w-full object-cover">
                <img src="{{ asset("assets/images/analog-city-mobile.png") }}" alt="Panoramic Houses" class="z-10 block md:hidden h-full w-full object-cover">
                <div class="hidden md:block absolute top-1/2 right-8 z-20 bg-[#F3F3F3] p-3 px-3.5 rounded-full">
                    <img src="{{ asset("assets/images/arrow-right.svg") }}" alt="Arrow Right" class="w-2">
                </div>
            </div>
            <div class="md:w-1/2 h-full pt-10 md:pt-8 md:p-8 flex flex-col justify-between">
                <h1 class="hidden md:block text-lg sm:text-4xl md:text-5xl lg:text-6xl font-just max-w-[450px]">You too can own a property in Omega city</h1>
                <div class="flex flex-col gap-5">
                    <h1 class="text-2xl pb-4 md:pb-0">Let’s get you started today!</h1>
                    <div class="flex flex-row items-center gap-5">
                        <a href="/land">
                            <div class="flex justify-center">
                                <button class="bg-[#FACF07] rounded-full text-xl md:text-sm px-16 md:px-10 py-3 md:py-2">Buy a land</button>
                            </div>
                        </a>
                        <a href="/contact-us">
                            <p class="border-b-[0.5px] border-[#010504] text-xl md:text-base pb-1 md:pb-0 mb-1 mt-1 px-1">Contact Us</p>
                        </a>
                    </div>
                </div>  
            </div>
        </div>
        
    </section>

    <!-- Footer Section -->
    @include("users.footer")


</body>

</html>
