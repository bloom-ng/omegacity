<!DOCTYPE html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - {{ config("app.name", "Admin Panel") }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:wght@400;500;700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
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

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="h-screen font-bricolage bg-white">
    <div class="flex flex-col md:flex-row min-h-screen">

        <!-- Left Section (Desktop Only) -->
        <div class="hidden md:flex w-[45%] h-screen bg-black items-center justify-center">
            <img src="{{ asset("assets/images/Omega-City-White.png") }}" alt="omega-city-logo"
                class="w-[60%] object-contain">
        </div>

        <!-- Mobile Layout -->
        <div class="flex flex-col md:hidden w-full min-h-screen">
            <!-- Top section: Black background with logo -->
            <div class="bg-black h-[35vh] flex items-center justify-center">
                <img src="{{ asset("assets/images/Omega-City-White.png") }}" alt="omega-city-logo"
                    class="w-[65%] object-contain">
            </div>

            <!-- Bottom section: White background (same design as desktop) -->
            <div class="flex md:hidden flex-col justify-start items-center bg-black text-white h-full p-6 pt-10">
                <div class="bg-white text-black rounded-xl p-6 w-full max-w-sm shadow-md mt-4">
                    <h2 class="text-xl font-bold text-center text-black">Welcome Back</h2>
                    <p class="text-md font-[justsansexregular] text-gray-700 pb-3">
                        Please Login to access your account
                    </p>

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                            role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="flex flex-col justify-center gap-2 w-full" method="POST"
                        action="{{ route("login") }}">
                        @csrf
                        <div class="flex flex-col gap-2 w-full">

                            <!-- Email -->
                            <div class="flex flex-col space-y-1">
                                <label for="email-mobile" class="text-sm font-[justsansexregular] text-gray-600">Email
                                    Address</label>
                                <input type="email" name="email" id="email-mobile"
                                    class="border border-gray-300 rounded-md p-3 w-full focus:ring-2 focus:ring-[#FACF07] focus:outline-none"
                                    placeholder="example@gmail.com" required>
                            </div>

                            <!-- Password -->
                            <div class="flex flex-col space-y-1 relative mt-4">
                                <label for="password-mobile"
                                    class="text-sm font-[justsansexregular] text-gray-600">Password</label>
                                <input type="password" name="password" id="password-mobile"
                                    class="border border-gray-300 rounded-md p-3 w-full focus:ring-2 focus:ring-[#FACF07] focus:outline-none"
                                    placeholder="password" required>
                                <img class="absolute right-4 top-[65%] -translate-y-1/2 cursor-pointer"
                                    src="{{ asset("assets/images/eye.png") }}" alt="Toggle password"
                                    onclick="togglePassword('password-mobile', this)">
                            </div>

                            <!-- Remember + Forgot -->
                            <div class="flex flex-row justify-between mt-2">
                                <div class="flex flex-row items-center space-x-2">
                                    <input type="checkbox" name="remember" id="remember-mobile"
                                        class="accent-[#FACF07] w-4 h-4 border-2 border-[#FACF07] rounded focus:ring-2 focus:ring-offset-1 focus:ring-[#85BB3F]" />
                                    <label for="remember-mobile" class="text-sm font-[justsansexregular]">Remember
                                        me</label>
                                </div>

                                <div class="text-sm font-[justsansexregular] cursor-pointer hover:underline">
                                    <a href="{{ route("password.request") }}">Forgot password?</a>
                                </div>
                            </div>

                            <!-- Submit button -->
                            <div class="flex flex-row justify-center mt-8">
                                <button type="submit"
                                    class="w-full py-3 text-black font-[justsansexbold] rounded-full hover:opacity-90 transition"
                                    style="background-color: #FACF07;">
                                    LOGIN
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Desktop Right Section -->
        <div class="hidden md:flex flex-col h-screen w-[55%] justify-center items-center bg-white pr-10">
            <div
                class="flex flex-col gap-3 w-[90%] justify-center items-center border border-[#21212199/70] rounded-xl p-8">
                <div>
                    <h2 class="text-xl text-center">Welcome Back</h2>
                </div>
                <p class="text-md pb-3 font-[justsansexregular]">Please Login to access your account</p>
                <div class="flex flex-col gap-2 w-full justify-center">
                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                            role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form class="flex flex-col justify-center gap-2 w-full" method="POST"
                        action="{{ route("login") }}">
                        @csrf
                        <div class="flex flex-col gap-2 w-full px-16">

                            <div class="flex flex-col space-y-1">
                                <label for="email" class="text-sm font-[justsansexregular] text-gray-600">Email
                                    Address</label>
                                <input type="email" name="email" id="email"
                                    class="border border-gray-300 rounded-md p-3 w-full focus:ring-2 focus:ring-[#FACF07] focus:outline-none"
                                    placeholder="example@gmail.com" required>
                            </div>

                            <!-- Password -->
                            <div class="flex flex-col space-y-1 relative mt-4">
                                <label for="password"
                                    class="text-sm font-[justsansexregular] text-gray-600">Password</label>
                                <input type="password" name="password" id="password"
                                    class="border border-gray-300 rounded-md p-3 w-full focus:ring-2 focus:ring-[#FACF07] focus:outline-none"
                                    placeholder="password" required>
                                <img class="absolute right-4 top-[65%] -translate-y-1/2 cursor-pointer"
                                    src="{{ asset("assets/images/eye.png") }}" alt="Toggle password"
                                    onclick="togglePassword('password', this)">
                            </div>

                            <div class="flex flex-row justify-between mt-2">
                                <div class="flex flex-row items-center space-x-2">
                                    <input type="checkbox" name="remember" id="remember-desktop"
                                        class="accent-[#FACF07] w-4 h-4 border-2 border-[#FACF07] rounded focus:ring-2 focus:ring-offset-1 focus:ring-[#85BB3F]" />
                                    <label for="remember-desktop" class="text-sm font-[justsansexregular]">Remember
                                        me</label>
                                </div>

                                <div class="text-sm font-[justsansexregular] cursor-pointer hover:underline">
                                    <a href="{{ route("password.request") }}">Forgot password?</a>
                                </div>
                            </div>

                            <div class="flex flex-row justify-center mt-8">
                                <button type="submit"
                                    class="w-full py-3 text-black font-[justsansexbold] rounded-full hover:opacity-90 transition"
                                    style="background-color: #FACF07;">
                                    LOGIN
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(inputId, eyeIcon) {
            const passwordInput = document.getElementById(inputId);
            const openEye = "{{ asset("assets/images/open-eye.png") }}";
            const closedEye = "{{ asset("assets/images/eye.png") }}";

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.src = openEye;
            } else {
                passwordInput.type = 'password';
                eyeIcon.src = closedEye;
            }
        }
    </script>
</body>

</html>
