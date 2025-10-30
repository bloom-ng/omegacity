<!DOCTYPE html>
<html lang="en">
@include("users.header")
<style>
    @media (max-width: 767px) {
      .contact-section {
        margin-top: 9rem !important; /* Tailwind mt-44 */
      }
    }
    </style>

<body class="bg-gray-50 font-just text-[#010504]">

    <!-- Navbar -->
    @include("users.nav")


    <!-- Contact Us Section -->
    <section
        class="contact-section w-11/12 md:w-10/12 mx-auto mt-24 md:mt-32 mb-16 bg-white rounded-3xl overflow-hidden shadow-md flex flex-col md:flex-row">
        <!-- Left Image Section -->
        <div class="md:w-1/2 relative">
            <img src="{{ asset("assets/images/contact-us.png") }}" alt="Land View" class="w-full object-cover">
        </div>

        <!-- Right Contact Form Section -->
        <div class="md:w-1/2 bg-gray-50 p-8 md:p-12 flex flex-col justify-center space-y-8">
            <!-- Contact Info -->
            <div>
                <h2 class="text-2xl md:text-3xl mb-2">Contact us</h2>
                <p class="text-gray-700 text-sm md:text-base leading-relaxed">
                    Omega city & properties is a fast rising real estate brand that offers affordable land for sale in Abuja. to get in touch with us, please reach out to us on any of the details below.
                </p>
            </div>

            <!-- Contact Details -->
            <div>
                <h3 class="text-lg mb-1">Contact details</h3>
                <p class="text-gray-800 text-sm md:text-base">+234 806 778 0422, +234 911 333 3439</p>
                <p class="text-gray-800 text-sm md:text-base">30 Libreville Cres,
                Wuse 2, Abuja 904101, Federal Capital Territory</p>
            </div>

            <!-- Message Form -->
            <div>
                <h3 class="text-xl md:text-2xl mb-2">Have questions?</h3>
                <p class="text-gray-700 mb-4 text-sm md:text-base">Send us a dm</p>

                @if (session("success"))
                    <div class="mb-4 text-green-600 font-semibold">
                        {{ session("success") }}
                    </div>
                @endif

                <form action="{{ route("store.contact-us") }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="email" name="email" placeholder="joedan@gmail.com"
                        class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400 text-sm md:text-base"
                        value="{{ old("email") }}" required>

                    @error("email")
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror

                    <textarea name="message" placeholder="Type message here" rows="4"
                        class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400 text-sm md:text-base"
                        required>{{ old("message") }}</textarea>

                    @error("message")
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror

                    <button
                        class="w-full bg-[#FACF07] hover:bg-yellow-500 transition py-3 md:py-4 rounded-full text-sm md:text-base">
                        Send us a message
                    </button>
                </form>

            </div>
        </div>
    </section>


    <!-- Footer Section -->
    @include("users.footer")
</body>
