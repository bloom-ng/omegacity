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

<body class="h-screen font-bricolage md:overflow-hidden">
    <div class="flex flex-col md:flex-row">
        <div class="w-full md:w-[45%] h-[40vh] md:h-screen bg-black flex items-center justify-center">
            <img src="{{ asset("assets/images/Omega-City-White.png") }}" alt="omega-city-logo"
                class="w-[70%] md:w-[60%] object-contain">
        </div>

        <!-- Mobile Login Form (hidden on md and above) -->
        <div class="flex flex-col h-[60vh] w-full  items-center bg-black pt-10 p-4 md:hidden">
            <div class="flex flex-col gap-4 w-full max-w-sm justify-center items-center">
                <div>
                    <h2 class="text-xl font-bold pb-2 text-center">Welcome Back</h2>
                </div>
                <p class="font-[justsansexregular]">Login to access your account</p>
                <div class="flex flex-col gap-3 w-full justify-center">
                    <form class="flex flex-col justify-between h-full gap-4 w-full" method="POST"
                        action="{{ route("login") }}">
                        <div class="flex flex-col gap-3 w-full">
                            <label for="password" class="sr-only">Email</label>
                            <input placeholder="Email address" type="email" name="email" id="email-mobile"
                                class="bg-white w-full border border-[#212121/80] rounded-md placeholder-[#212121/60] p-3">
                            <div class="flex flex-row justify-between relative">
                                <label for="password" class="sr-only">Password</label>
                                <input placeholder="Password" type="password" name="password" id="password-mobile"
                                    class="bg-white w-full border border-[#212121/80] rounded-md placeholder-[#212121/60] p-3">
                                <img class="absolute right-4 top-1/2 -translate-y-1/2 cursor-pointer"
                                    src="/images/eye.png" alt=""
                                    onclick="togglePassword('password-mobile', this)">
                            </div>

                            <div class="flex flex-row justify-between items-center">
                                <div class="flex flex-row items-center space-x-2">
                                    <input type="checkbox" name="remember" id="remember-mobile"
                                        class="accent-[#85BB3F] w-4 h-4 border-2 border-[#85BB3F] rounded focus:ring-2 focus:ring-offset-1 focus:ring-[#85BB3F]" />
                                    <label for="remember-mobile" class="text-sm font-medium">Remember me</label>
                                </div>

                                <div class="text-sm font-medium cursor-pointer hover:underline">Forgot password?</div>
                            </div>


                        </div>
                        <div class="flex flex-row mt-[10%] pb-8 justify-center pt-2 items-center">
                            <button type="submit" class="w-full text-md py-3 text-white rounded-lg"
                                style="background: linear-gradient(91.36deg, #85BB3F 0%, #212121 162.21%);">
                                LOGIN
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Desktop Login Form (hidden on mobile) -->
        <div class="hidden md:flex flex-col h-screen w-[55%] justify-center items-center bg-white pr-10">
            <div
                class="flex flex-col gap-3 w-[90%] justify-center items-center border border-[#21212199/70] rounded-xl p-8">
                <div>
                    <h2 class="text-xl font-[] text-center">Welcome Back</h2>
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
                                <label for="email" class="text-sm font-[justsansexregular] text-gray-600">Email Address</label>
                                <input type="email" name="email" id="email"
                                    class="border border-gray-300 rounded-md p-3 w-full focus:ring-2 focus:ring-[#FACF07] focus:outline-none"
                                    placeholder="example@gmail.com" required>
                            </div>

                            <!-- Password -->
                            <div class="flex flex-col space-y-1 relative mt-4">
                                <label for="password" class="text-sm font-[justsansexregular] text-gray-600">Password</label>
                                <input type="password" name="password" id="password"
                                    class="border border-gray-300 rounded-md p-3 w-full focus:ring-2 focus:ring-[#FACF07] focus:outline-none"
                                    placeholder="password" required>
                                    <img class="absolute right-4 top-[65%] -translate-y-1/2 cursor-pointer"
                                    src="{{ asset('assets/images/eye.png') }}" alt="Toggle password"
                                    onclick="togglePassword('password', this)">
                            </div>

                            <div class="flex flex-row justify-between mt-2">
                                <div class="flex flex-row items-center space-x-2">
                                    <input type="checkbox" name="remember" id="remember-desktop"
                                        class="accent-[#FACF07] w-4 h-4 border-2 border-[#FACF07] rounded focus:ring-2 focus:ring-offset-1 focus:ring-[#85BB3F]" />
                                    <label for="remember-desktop" class="text-sm font-[justsansexregular]">Remember me</label>
                                </div>

                                <div class="text-sm font-[justsansexregular] cursor-pointer hover:underline"><a
                                        href="{{ route('password.request') }}">Forgot password?</a></div>
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
            const openEye = "{{ asset('assets/images/open-eye.png') }}";
            const closedEye = "{{ asset('assets/images/eye.png') }}";

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
