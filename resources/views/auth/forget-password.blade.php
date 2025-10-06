<!DOCTYPE html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Forget Password - {{ config("app.name", "Admin Panel") }}</title>
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
                    <h2 class="text-xl font-bold pb-1 text-center">Forgot Password</h2>
                </div>
                <p class="font-[justsansexregular]">A reset link will be sent to your email address</p>
                <div class="flex flex-col gap-3 w-full justify-center">
                    <form class="flex flex-col justify-between h-full gap-4 w-full" method="POST"
                        action="">
                        <div class="flex flex-col gap-4 w-full">
                            <label for="" class="sr-only">Email</label>
                            <input placeholder="Email address" type="email" name="email" id="email-mobile"
                                class="bg-white w-full border border-[#212121/80] rounded-md placeholder-[#212121/60] p-3">

                        </div>
                        <div class="flex flex-row mt-[10%] pb-8 justify-center pt-2 items-center">
                            <button type="submit" class="w-full text-md py-3 text-white rounded-lg"
                            style="background-color: #FACF07;">
                               Send reset link
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
                    <h2 class="text-xl font-bold pb-2 text-center">Forgot Password</h2>
                </div>
                <p class="font-[justsansexregular]">A reset link will be sent to your email address</p>
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
                        action="">
                        @csrf
                        <div class="flex flex-col gap-2 w-full px-16">

                            <div class="flex flex-col space-y-1">
                                <label for="email" class="text-md font-[justsansexregular] text-gray-700">Email Address</label>
                                <input type="email" name="email" id="email"
                                    class="border border-gray-300 rounded-md p-3 w-full focus:ring-2 focus:ring-[#FACF07] focus:outline-none"
                                    placeholder="example@gmail.com" required>
                            </div>

                            <div class="flex flex-row justify-center mt-8">
                                <button type="submit"
                                    class="w-full py-3 text-black font-[justsansexbold] rounded-full hover:opacity-90 transition"
                                    style="background-color: #FACF07;">
                                   Send reset link
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
