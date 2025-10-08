<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Forgot Password - {{ config('app.name', 'Admin Panel') }}</title>

    <!-- Fonts & Tailwind -->
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:wght@400;500;700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        justbold: ['"just-sans-ex-bold"', 'sans-serif'],
                        justregular: ['"just-sans-regular"', 'sans-serif'],
                        bricolage: ['"Bricolage Grotesque"', 'sans-serif'],
                    },
                },
            },
        };
    </script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="h-screen font-bricolage md:overflow-hidden">

    <div class="flex flex-col md:flex-row h-full">

        <!-- Left Section (Desktop Only) -->
        <div class="hidden md:flex w-[45%] h-screen bg-black items-center justify-center">
            <img src="{{ asset('assets/images/Omega-City-White.png') }}" alt="omega-city-logo"
                class="w-[60%] object-contain">
        </div>

        <!-- MOBILE VERSION -->
        <div class="flex flex-col md:hidden w-full min-h-screen">
            <!-- Top section: Black background with logo -->
            <div class="bg-black h-[35vh] flex items-center justify-center">
                <img src="{{ asset('assets/images/Omega-City-White.png') }}" alt="omega-city-logo"
                    class="w-[65%] object-contain">
            </div>

            <!-- Bottom section: White form (same as desktop form styling) -->
            <div class="flex flex-col justify-center items-center bg-white text-black h-[65vh] p-6">
                <div class="border border-gray-200 rounded-xl p-6 w-full max-w-sm shadow-sm">
                    <h2 class="text-xl font-bold text-center mb-2">Forgot Password</h2>
                    <p class="text-center text-gray-600 mb-5">A reset link will be sent to your email address</p>

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                            role="alert">
                            <ul class="list-disc pl-5 text-left">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="" class="flex flex-col gap-4">
                        @csrf
                        <div class="flex flex-col gap-2">
                            <label for="email-mobile"
                                class="text-md font-[justregular] text-gray-700">Email Address</label>
                            <input type="email" name="email" id="email-mobile"
                                class="border border-gray-300 rounded-md p-3 w-full focus:ring-2 focus:ring-[#FACF07] focus:outline-none"
                                placeholder="example@gmail.com" required>
                        </div>

                        <button type="submit"
                            class="w-full py-3 text-black font-[justbold] rounded-full hover:opacity-90 transition"
                            style="background-color: #FACF07;">
                            Send reset link
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- DESKTOP FORM -->
        <div class="hidden md:flex flex-col h-screen w-[55%] justify-center items-center bg-white pr-10">
            <div
                class="flex flex-col gap-3 w-[90%] max-w-md justify-center items-center border border-gray-200 rounded-xl p-10 shadow-sm">
                <h2 class="text-2xl font-bold pb-2 text-center">Forgot Password</h2>
                <p class="font-[justregular] text-gray-600 text-center mb-4">A reset link will be sent to your
                    email address</p>

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                        role="alert">
                        <ul class="list-disc pl-5 text-left">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="flex flex-col gap-5 w-full" method="POST" action="">
                    @csrf
                    <div class="flex flex-col gap-2 w-full">
                        <label for="email" class="text-md font-[justregular] text-gray-700">Email
                            Address</label>
                        <input type="email" name="email" id="email"
                            class="border border-gray-300 rounded-md p-3 w-full focus:ring-2 focus:ring-[#FACF07] focus:outline-none"
                            placeholder="example@gmail.com" required>
                    </div>

                    <div class="flex flex-row justify-center mt-6">
                        <button type="submit"
                            class="w-full py-3 text-black font-[justbold] rounded-full hover:opacity-90 transition"
                            style="background-color: #FACF07;">
                            Send reset link
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

</body>

</html>
