<footer class="bg-[#F3F3F3] md:bg-[#F3F3F3] py-10 px-6 md:px-20 mt-12">
  <div class="flex flex-col md:flex-row items-start justify-between space-y-10 md:space-y-0">

    <!-- Left: Logo -->
    <div class="flex flex-col items-start space-y-2">
      <img src="{{ asset('assets/images/Omega-City-no-whitespace.png') }}"
           alt="Omega Logo"
           class="w-16 -ml-1 md:w-44 object-contain" />
    </div>

    <!-- Right: Links & Socials -->
    <div class="flex flex-col md:flex-row items-start md:space-x-20 space-y-10 md:space-y-0 w-full md:w-auto">

      <!-- Omega City Links -->
      <div class="text-left w-full md:w-auto">
        <h4 class="font-bold text-lg text-gray-900 mb-3">Omega City</h4>
        <ul class="space-y-2 text-gray-700">
          <li><a href="/about" class="hover:text-gray-900 transition">About</a></li>
          <li><a href="/land" class="hover:text-gray-900 transition">Land</a></li>
          <li><a href="/contact-us" class="hover:text-gray-900 transition">Contact us</a></li>
        </ul>
      </div>

      <!-- Socials -->
      <div class="text-left w-full md:w-auto">
        <h4 class="font-bold text-lg text-gray-900 mb-3">Socials</h4>
        <ul class="space-y-2 text-gray-700">
          <li><a href="https://www.instagram.com/omegacityproperties/?hl=en" class="hover:text-gray-900 transition">Instagram</a></li>
          <li><a href="https://web.facebook.com/profile.php?id=61581679809389" class="hover:text-gray-900 transition">Facebook</a></li>
        </ul>
      </div>

    </div>
  </div>

  <!-- Copyright (always at bottom) -->
  <div class="mt-4 md:mt-6">
    <p class="text-gray-700 text-sm text-left">
      © {{ date('Y') }} Omega city & properties Nig. Ltd
    </p>
  </div>
</footer>
