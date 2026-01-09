<!DOCTYPE html>
<html lang="en">
@include("users.header")

<body class="bg-[#F3F3F3] font-just text-[#010504]">

    <!-- Navbar -->
    @include("users.nav")

    <!-- Hero Section -->
    <section class="relative flex flex-col items-center justify-center min-h-[80vh] z-0 md:bg-cover h-[70vh] bg-center text-center"
        style="background-image: url('{{ asset("assets/images/analog-city.png") }}');">

        <!-- Logo for Desktop -->
        <div class="max-w-6xl hidden md:block md:-mt-[120px] z-20 lg:-mt-[160px]">
            <img src="{{ asset("assets/images/Omega-City-White.svg") }}" alt="Omega City Logo" class="w-[900px]">
        </div>

        <!-- Logo for Mobile -->
        <div class="px-1 -mt-[150px] block md:hidden z-20">
            <img src="{{ asset("assets/images/Omega-City-White.png") }}" alt="Omega City Logo" class="w-[1500px]">
        </div>

        <!-- Overlay -->
        <div class="absolute inset-0 z-10 pointer-events-none bg-[#010504]/10"></div>

        <!-- Bottom tagline bar -->
        <div class="absolute z-20 bottom-0 w-full bg-[#F3F3F3] text-lg md:text-xl lg:text-2xl py-6 sm:py-10 md:py-12 px-6">
            <div class="grid grid-rows-2 h-12 sm:h-0 md:flex md:flex-nowrap items-center justify-center gap-3 sm:gap-5 max-w-5xl mx-auto text-center">
                <p class="font-just font-extrabold sm:mb-2 md:mb-0 whitespace-nowrap">
                    Omega City & Properties
                </p>

                <span class="text-center">
                    Nigeria’s number 1 real estate brand
                </span>
            </div>
        </div>

    </section>

    <!-- ABOUT US INTRO -->
    <section class="flex flex-col gap-6 max-w-[980px] px-4 sm:px-6 md:px-12 lg:px-20 py-10">
        <h1 class="text-3xl text-left md:text-6xl font-just">
            About Omega City & Properties
        </h1>
        <p class="text-lg leading-relaxed">
            For us at Omega City, our goal is simple: to make property ownership accessible, secure, and rewarding for every client and investor.
            We are committed to shaping how real estate is experienced—where comfort meets opportunity.
        </p>

        <p class="text-lg font-semibold">
            — John Ternenge Utim (Chief Executive Officer)
        </p>
    </section>

    <!-- WHAT REAL ESTATE SHOULD MEAN -->
    <section class="flex flex-col gap-6 max-w-[980px] px-4 sm:px-6 md:px-12 lg:px-20 pb-10">
        <h1 class="text-3xl md:text-5xl font-just">What Real Estate Should Mean to Our Clients & Investors</h1>

        <p class="text-lg leading-relaxed">
            Real estate should feel like a home for clients, and a growth vehicle for investors—one promises comfort, the other promises opportunity.
        </p>

        <p class="text-lg leading-relaxed">
            To our clients, real estate represents stability, a place to grow, and a legacy that strengthens with time. It offers security, pride of ownership, and the confidence that their future is anchored on solid ground.
        </p>

        <p class="text-lg leading-relaxed">
            To our investors, real estate is reliable wealth-building—an opportunity that appreciates, protects capital, and delivers sustainable long-term returns.
            It provides clarity, control, and a pathway to consistent growth.
        </p>

        <p class="text-lg leading-relaxed">
            At Omega City, our approach honors both journeys by creating developments that offer comfort, value, and enduring opportunity.
        </p>
    </section>

    <!-- MISSION, VISION, VALUES -->
    <section class="flex flex-col gap-10 max-w-[980px] px-4 sm:px-6 md:px-12 lg:px-20 py-10">

        <div>
            <h2 class="text-3xl md:text-5xl font-just mb-4">Our Mission</h2>
            <p class="text-lg leading-relaxed">
                To be Africa’s leading real estate brand—shaping cities and building enduring value.
            </p>
        </div>

        <div>
            <h2 class="text-3xl md:text-5xl font-just mb-4">Our Vision</h2>
            <p class="text-lg leading-relaxed">
                Delivering exceptional real estate solutions through innovation, integrity, and excellence.
                As we continue to grow toward becoming Africa’s leading real estate developer, we maintain the highest standards of professionalism, integrity, and reliability.
            </p>
        </div>

        <div>
            <h2 class="text-3xl md:text-5xl font-just mb-4">Our Values</h2>
            <p class="text-lg leading-relaxed">
                At Omega City, we prioritize innovation, excellence, and integrity in all our real estate solutions.
            </p>
        </div>

    </section>

    <!-- WHAT WE DO -->
    <section class="flex flex-col gap-6 max-w-[980px] px-4 sm:px-6 md:px-12 lg:px-20 py-10">

        <h1 class="text-3xl md:text-5xl font-just">What We Do</h1>

        <p class="text-lg leading-relaxed">
            At Omega City, we focus on real estate development by identifying industry challenges and providing strategic solutions tailored to the Nigerian property market.
        </p>

        <p class="text-lg leading-relaxed">
            Our services cover residential and commercial property development, sales & marketing, estate and facility management,
            investment advisory, land acquisition, and documentation—designed to meet evolving urban demands.
        </p>

        <p class="text-lg leading-relaxed">
            We also offer expert advisory services to help clients navigate the complexities of real estate investment and project execution—combining industry insight with client-centered strategies for profitable outcomes.
        </p>

        <h2 class="text-2xl md:text-3xl font-just mt-6">Investment Advisory</h2>
        <p class="text-lg leading-relaxed">
            We help clients make informed, profitable real estate decisions through expert guidance, tailored strategies, and strong partnerships rooted in integrity.
        </p>

        <h2 class="text-2xl md:text-3xl font-just mt-6">Project Management</h2>
        <p class="text-lg leading-relaxed pb-10">
            Our experienced team delivers end-to-end project solutions with a focus on quality, efficiency, and risk mitigation—ensuring smooth execution from planning to completion.
        </p>

    </section>

    <!-- Footer -->
    @include("users.footer")

</body>

</html>
