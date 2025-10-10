<footer class="bg-gray-50 py-10 px-6 md:px-20 border-t border-gray-200">
    <div class="flex flex-col md:flex-row items-center md:items-start justify-between space-y-10 md:space-y-0">

        <!-- Left: Logo + Copyright -->
        <div class="flex flex-col items-center md:items-start space-y-2 ">
            <img src="{{ asset("assets/images/omegacitylogo.png") }}" alt="Omega Logo"
                class="w-28 md:w-44 object-contain" />

            <p class="text-gray-700 text-sm text-center md:text-left">
                © {{ date("Y") }} Omega city & properties Nig. Ltd
            </p>
        </div>

        <!-- Right: Links & Socials -->
        <div class="flex flex-col md:flex-row items-center md:items-start md:space-x-20 space-y-10 md:space-y-0">

            <!-- Omega City Links -->
            <div class="text-center md:text-left">
                <h4 class="font-bold text-lg text-gray-900 mb-3">Omega City</h4>
                <ul class="space-y-2 text-gray-700">
                    <li><a href="#" class="hover:text-gray-900 transition">About</a></li>
                    <li><a href="#" class="hover:text-gray-900 transition">Land</a></li>
                    <li><a href="#" class="hover:text-gray-900 transition">Contact us</a></li>
                </ul>
            </div>

            <!-- Socials -->
            <div class="text-center md:text-left">
                <h4 class="font-bold text-lg text-gray-900 mb-3">Socials</h4>
                <ul class="space-y-2 text-gray-700">
                    <li><a href="#" class="hover:text-gray-900 transition">Instagram</a></li>
                    <li><a href="#" class="hover:text-gray-900 transition">Twitter</a></li>
                </ul>
            </div>

        </div>
    </div>
</footer>
