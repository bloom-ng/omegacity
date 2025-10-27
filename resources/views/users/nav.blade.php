<nav x-data="{ open: false }"
    class="bg-[#F3F3F3] w-full px-6 md:px-12 lg:px-20 py-4 flex flex-row justify-between items-center">

    <!-- Logo -->
    <div class="flex items-center space-x-2 ">
        <a href="{{ route("home") }}">
            <img src="{{ asset("assets/images/OmegaCityLogoYellow.svg") }}" alt="Omega Logo" class="w-20 md:w-28 lg:w-36">
        </a>
    </div>

    <!-- Desktop Links -->
    <div class="text-sm lg:text-base hidden md:flex items-center space-x-4 md:space-x-6 lg:space-x-12 text-black font-just">
        <a href="#" class="hover:text-yellow-400 transition {{ request()->is('about') ? 'border-b-[0.5px] px-1 border-[#676968]' : '' }}">About</a>
        <a href="/land" class="hover:text-yellow-400 transition {{ request()->is('land') || request()->is('landlisting') ? 'border-b-[0.5px] px-1 border-[#676968]' : '' }}">Land</a>
        <a href="{{ route("contact-us") }}" class="hover:text-yellow-400 transition {{ request()->is('contact-us') ? 'border-b-[0.5px] px-1 border-[#676968]' : '' }}">Contact us</a>
        <!-- Buy button (desktop) -->
        <button
            class="hidden md:block bg-yellow-400/90 hover:bg-yellow-500 text-black font-just px-10 lg:px-12 py-2 rounded-full transition">
            Buy a land
        </button>
    </div>

    

    <!-- Hamburger Button -->
    <button @click="open = !open" class="md:hidden text-black focus:outline-none">
        <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>

    <!-- Mobile Menu -->
    <div x-show="open" x-transition
    class="absolute top-[60px] h-full z-50 left-0 w-full bg-[#F3F3F3] border-t rounded-sm border-gray-200 md:hidden py-6 flex flex-col justify-between">

    <!-- Menu Links -->
    <div class="flex flex-col items-start space-y-6 px-6 text-black font-just text-lg">
        <a href="#" class="hover:text-yellow-500 transition {{ request()->is('about') ? 'border-b-[0.5px] px-1 border-[#676968]' : '' }}">About</a>
        <a href="/land" class="hover:text-yellow-500 transition {{ request()->is('land') || request()->is('landlisting') ? 'border-b-[0.5px] px-1 border-[#676968]' : '' }}">Land</a>
        <a href="{{ route('contact-us') }}" class="hover:text-yellow-500 transition {{ request()->is('contact-us') ? 'border-b-[0.5px] px-1 border-[#676968]' : '' }}">Contact us</a>
        <!-- Buy a Land Button -->
        <div class="w-full flex justify-center pb-3 mt-2">
            <button
            class="bg-yellow-400 hover:bg-yellow-500 text-black font-just px-4 py-2 rounded-full w-full text-center transition">
            Buy a land
            </button>
        </div>
  </div>


</div>

</nav>
