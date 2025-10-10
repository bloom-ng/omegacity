<nav x-data="{ open: false }"
    class="absolute top-5 left-1/2 transform -translate-x-1/2 w-11/12 md:w-4/5
bg-white/10 backdrop-blur-md border border-white/20
shadow-[0_8px_32px_0_rgba(31,38,135,0.1)]
rounded-full px-10 py-2 flex items-center justify-between z-50
transition-all duration-300">

    <!-- Logo -->
    <div class="flex items-center space-x-2 ">
        <a href="{{ route("home") }}">
            <img src="{{ asset("assets/images/OmegaCityLogoYellow.png") }}" alt="Omega Logo" class=" md:h-16">
        </a>
    </div>

    <!-- Desktop Links -->
    <div class="hidden md:flex items-center space-x-8 text-black font-[justsansexregular]">
        <a href="#" class="hover:text-yellow-400 transition">About</a>
        <a href="#" class="hover:text-yellow-400 transition">Land</a>
        <a href="{{ route("contact-us") }}" class="hover:text-yellow-400 transition">Contact us</a>
    </div>

    <!-- Buy button (desktop) -->
    <button
        class="hidden md:block bg-yellow-400/90 hover:bg-yellow-500 text-black font-[justsansexbold] px-5 py-2 rounded-full shadow-lg transition">
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
        class="absolute top-[70px] left-0 w-full bg-white/20 backdrop-blur-md border border-white/20 rounded-2xl shadow-[0_8px_32px_0_rgba(31,38,135,0.1)] md:hidden py-4">
        <div class="flex flex-col items-center space-y-4 text-black font-[justsansexregular]">
            <a href="#" class="hover:text-yellow-400 transition">About</a>
            <a href="#" class="hover:text-yellow-400 transition">Land</a>
            <a href="{{ route("contact-us") }}" class="hover:text-yellow-400 transition">Contact us</a>
            <button
                class="bg-yellow-400/90 hover:bg-yellow-500 text-black font-[justsansexbold] px-5 py-2 rounded-full shadow-md transition">
                Buy a land
            </button>
        </div>
    </div>
</nav>
