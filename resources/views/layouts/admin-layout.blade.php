@php
    $userRole = auth()->user()->role->name;
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="icon" type="image/png" href="{{ asset("assets/images/favicon-omega.png") }}">
    @if (file_exists(public_path("build/manifest.json")) || file_exists(public_path("hot")))
        @vite(["resources/css/app.css", "resources/js/app.js"])
    @else
        <style></style>
    @endif
    <title>Omega City Admin Panel</title>
</head>

<body x-data="{ sidebarOpen: false }" :class="sidebarOpen ? 'overflow-hidden h-screen' : ''" class="bg-gray-100 flex w-full">

    <!-- Toast notifications -->
    @if (session("success"))
        <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
        <script>
            Toastify({
                text: "{{ session("success") }}",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "green",
                stopOnFocus: true
            }).showToast();
        </script>
    @endif

    @if (session("error"))
        <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
        <script>
            Toastify({
                text: "{{ session("error") }}",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "red",
                stopOnFocus: true
            }).showToast();
        </script>
    @endif

    @if ($errors->any())
        <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
        @foreach ($errors->all() as $error)
            <script>
                Toastify({
                    text: "{{ $error }}",
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "red",
                    stopOnFocus: true
                }).showToast();
            </script>
        @endforeach
    @endif

    <!-- Mobile overlay -->
    <div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 bg-black bg-opacity-30 z-40 lg:hidden"
        @click="sidebarOpen = false"></div>

    <!-- Sidebar -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        x-show="sidebarOpen || window.innerWidth >= 1024"
        class="fixed inset-y-0 left-0 z-50 w-64 bg-white transform lg:translate-x-0 transition-transform duration-300 ease-in-out lg:static lg:flex flex-col shadow-lg overflow-y-auto">

        <!-- Logo -->
        <div class="p-4">
            <img src="{{ asset("assets/images/omegacitylogo.png") }}" alt="logo">
        </div>

        <!-- Navigation -->
        <nav class="text-white text-xs font-semibold flex flex-col flex-grow">
            <p class="text-gray-400 ml-12 font-sans text-[20px] mt-3">Admin Panel</p>

            <!-- Example: Dashboard link -->
            @if (in_array($userRole, ["Admin", "Accountant", "Agent"]))
                <a href="{{ route("admin.dashboard") }}"
                    class="{{ request()->routeIs("admin.dashboard")
                        ? "flex items-center py-[12px] px-5 bg-black text-white rounded-l ml-6 shadow-md mt-7 mr-4 font-sans"
                        : "flex items-center gap-3 py-2 px-8 h-12 text-gray-800 mt-7 font-sans hover:scale-110 transition-transform duration-200 rounded-l ml-6 mr-4" }}">
                    <img src="{{ asset("assets/images/dashboard-svgrepo-com.svg") }}"
                        class="w-6 h-6 {{ request()->routeIs("admin.dashboard") ? "filter invert" : "" }}"
                        alt="dashboard-icon">
                    <span
                        class="text-[14px] font-sans ml-2 mr-4 {{ request()->routeIs("admin.dashboard") ? "text-white" : "text-[#222222B2]" }}">
                        Dashboard
                    </span>
                </a>
            @endif

            @if (in_array($userRole, ["Admin", "Accountant", "Agent"]))
                <a href="{{ route("admin.profile.index") }}"
                    class="{{ request()->routeIs("admin.profile.*") ? "flex items-center py-[12px] px-5 bg-black text-white rounded-l ml-6 shadow-md mt-7 mr-4 font-sans" : "flex items-center gap-3 py-2 px-8 h-12 text-gray-800 mt-7 font-sans hover:scale-110 transition-transform duration-200 rounded-l ml-6 mr-4" }}">
                    <img src="{{ asset("assets/images/profile.svg") }}"
                        class="w-6 h-6 {{ request()->routeIs("admin.profile.*") ? "filter invert" : "" }}"
                        alt="profile-icon"> <span
                        class="text-[14px] font-sans ml-2 mr-4 {{ request()->routeIs("admin.profile.*") ? "text-white" : "text-[#222222B2]" }}">
                        Profile </span> </a>
                @endif @if (in_array($userRole, ["Admin", "Accountant", "Agent"]))
                    <a href="{{ route("admin.forms.index") }}"
                        class="{{ request()->routeIs("admin.forms.*") ? "flex items-center py-[12px] px-5 bg-black text-white rounded-l ml-6 shadow-md mt-7 mr-4 font-sans" : "flex items-center gap-3 py-2 px-8 h-12 text-gray-800 mt-7 font-sans hover:scale-110 transition-transform duration-200 rounded-l ml-6 mr-4" }}">
                        <img src="{{ asset("assets/images/forms.svg") }}"
                            class="w-6 h-6 {{ request()->routeIs("admin.forms.*") ? "filter invert" : "" }}"
                            alt="forms-icon"> <span
                            class="text-[14px] font-sans ml-2 mr-4 {{ request()->routeIs("admin.forms.*") ? "text-white" : "text-[#222222B2]" }}">
                            Forms </span> </a>
                    @endif <!-- Land Listing -->
                    @if (in_array($userRole, ["Admin", "Agent"]))
                        <a href="{{ route("admin.landlistings.index") }}"
                            class="{{ request()->routeIs("admin.landlistings.*") ? "flex items-center py-[12px] px-5 bg-black text-white rounded-l ml-6 shadow-md mt-7 mr-4 font-sans" : "flex items-center gap-3 py-2 px-8 h-12 text-gray-800 mt-7 font-sans hover:scale-110 transition-transform duration-200 rounded-l ml-6 mr-4" }}">
                            <img src="{{ asset("assets/images/earth.svg") }}"
                                class="w-6 h-6 {{ request()->routeIs("admin.landlistings.*") ? "filter invert" : "" }}"
                                alt="transactions-icon"> <span
                                class="text-[14px] font-sans ml-2 mr-4 {{ request()->routeIs("admin.landlistings.*") ? "text-white" : "text-[#222222B2]" }}">
                                Land Listing </span> </a>
                        @endif <!-- Users -->
                        @if ($userRole === "Admin")
                            <a href="{{ route("admin.users.index") }}"
                                class="{{ request()->routeIs("admin.users.*") ? "flex items-center py-[12px] px-5 bg-black text-white rounded-l ml-6 shadow-md mt-7 mr-4 font-sans" : "flex items-center gap-3 py-2 px-8 h-12 text-gray-800 mt-7 font-sans hover:scale-110 transition-transform duration-200 rounded-l ml-6 mr-4" }}">
                                <img src="{{ asset("assets/images/users.svg") }}"
                                    class="w-6 h-6 {{ request()->routeIs("admin.users.*") ? "filter invert" : "" }}"
                                    alt="users-icon"> <span
                                    class="text-[14px] font-sans ml-2 mr-4 {{ request()->routeIs("admin.users.*") ? "text-white" : "text-[#222222B2]" }}">Staffs</span>
                            </a>
                            @endif <!-- Agent Targets -->
                            @if ($userRole === "Admin")
                                <a href="{{ route("admin.targets.index") }}"
                                    class="{{ request()->routeIs("admin.targets.*") ? "flex items-center py-[12px] px-5 bg-black text-white rounded-l ml-6 shadow-md mt-7 mr-4 font-sans" : "flex items-center gap-3 py-2 px-8 h-12 text-gray-800 mt-7 font-sans hover:scale-110 transition-transform duration-200 rounded-l ml-6 mr-4" }}">
                                    <img src="{{ asset("assets/images/bullseye.svg") }}"
                                        class="w-6 h-6 {{ request()->routeIs("admin.targets.*") ? "filter invert" : "" }}"
                                        alt="bullseye-icon"> <span
                                        class="text-[14px] font-sansm l-2 mr-4 {{ request()->routeIs("admin.targets.*") ? "text-white" : "text-[#222222B2]" }}">Marketers
                                        Targets</span> </a>
                                @endif <!-- Contacts -->
                                @if ($userRole === "Admin")
                                    <a href="{{ route("admin.contacts.index") }}"
                                        class="{{ request()->routeIs("admin.contacts.*") ? "flex items-center py-[12px] px-5 bg-black text-white rounded-l ml-6 shadow-md mt-7 mr-4 font-sans" : "flex items-center gap-3 py-2 px-8 h-12 text-gray-800 mt-7 font-sans hover:scale-105 transition-transform duration-200 rounded-l ml-6 mr-4" }}">
                                        <img src="{{ asset("assets/images/contacts.svg") }}"
                                            class="w-6 h-6 {{ request()->routeIs("admin.contacts.*") ? "filter invert" : "" }}"
                                            alt="contacts-icon"> <span
                                            class="text-[14px] font-sans ml-2 mr-4 {{ request()->routeIs("admin.contacts.*") ? "text-white" : "text-[#222222B2]" }}">Contacts</span>
                                    </a>
                                    @endif <!-- Document Verification-->
                                    @if ($userRole === "Admin")
                                        <a href="{{ route("admin.documents-verification.index") }}"
                                            class="{{ request()->routeIs("admin.documents-verification.*") ? "flex items-center py-[12px] px-5 bg-black text-white rounded-l ml-6 shadow-md mt-7 mr-4 font-sans" : "flex items-center gap-3 py-2 px-8 h-12 text-gray-800 mt-7 font-sans hover:scale-110 transition-transform duration-200 rounded-l ml-6 mr-4" }}">
                                            <img src="{{ asset("assets/images/document.svg") }}"
                                                class="w-6 h-6 {{ request()->routeIs("admin.documents-verification.*") ? "filter invert" : "" }}"
                                                alt="users-icon"> <span
                                                class="text-[14px] font-sans ml-2 mr-4 {{ request()->routeIs("admin.documents-verification.*") ? "text-white" : "text-[#222222B2]" }}">Documents
                                                Verification</span> </a>
                                        @endif <!-- Settings -->
                                        @if ($userRole === "Admin")
                                            <a href="{{ route("admin.settings.index") }}"
                                                class="{{ request()->routeIs("admin.settings.*") ? "flex items-center py-[12px] px-5 bg-black text-white rounded-l ml-6 shadow-md mt-7 mr-4 font-sans" : "flex items-center gap-3 py-2 px-8 h-12 text-gray-800 mt-7 font-sans hover:scale-105 transition-transform duration-200 rounded-l ml-6 mr-4" }}">
                                                <img src="{{ asset("assets/images/settings.svg") }}"
                                                    class="w-6 h-6 {{ request()->routeIs("admin.settings.*") ? "filter invert" : "" }}"
                                                    alt="settings-icon"> <span
                                                    class="text-[14px] font-sans ml-2 mr-4 {{ request()->routeIs("admin.settings.*") ? "text-white" : "text-[#222222B2]" }}">Settings</span>
                                            </a>
                                            @endif <!-- Clients -->
                                            @if (in_array($userRole, ["Admin", "Accountant", "Agent"]))
                                                <a href="{{ route("admin.clients.index") }}"
                                                    class="{{ request()->routeIs("admin.clients.*") ? "flex items-center py-[12px] px-5 bg-black text-white rounded-l ml-6 shadow-md mt-7 mr-4 font-sans" : "flex items-center gap-3 py-2 px-8 h-12 text-gray-800 mt-7 font-sans hover:scale-110 transition-transform duration-200 rounded-l ml-6 mr-4" }}">
                                                    <img src="{{ asset("assets/images/client.svg") }}"
                                                        class="w-6 h-6 {{ request()->routeIs("admin.clients.*") ? "filter invert" : "" }}"
                                                        alt="users-icon"> <span
                                                        class="text-[14px] font-sans ml-2 mr-4 {{ request()->routeIs("admin.clients.*") ? "text-white" : "text-[#222222B2]" }}">Clients</span>
                                                </a>
                                                @endif <!-- Invoice -->
                                                @if (in_array($userRole, ["Admin", "Accountant"]))
                                                    <a href="{{ route("admin.invoices.index") }}"
                                                        class="{{ request()->routeIs("admin.invoices.*") ? "flex items-center py-[12px] px-5 bg-black text-white rounded-l ml-6 shadow-md mt-7 mr-4 font-sans" : "flex items-center gap-3 py-2 px-8 h-12 text-gray-800 mt-7 font-sans hover:scale-110 transition-transform duration-200 rounded-l ml-6 mr-4" }}">
                                                        <img src="{{ asset("assets/images/invoice.svg") }}"
                                                            class="w-6 h-6 {{ request()->routeIs("admin.invoices.*") ? "filter invert" : "" }}"
                                                            alt="invoice-icon"> <span
                                                            class="text-[14px] font-sans ml-2 mr-4 {{ request()->routeIs("admin.invoices.*") ? "text-white" : "text-[#222222B2]" }}">Invoice</span>
                                                    </a>
                                                    @endif <!-- Receipt -->
                                                    @if (in_array($userRole, ["Admin", "Accountant"]))
                                                        <a href="{{ route("admin.receipts.index") }}"
                                                            class="{{ request()->routeIs("admin.receipts.*") ? "flex items-center py-[12px] px-5 bg-black text-white rounded-l ml-6 shadow-md mt-7 mr-4 font-sans" : "flex items-center gap-3 py-2 px-8 h-12 text-gray-800 mt-7 font-sans hover:scale-110 transition-transform duration-200 rounded-l ml-6 mr-4" }}">
                                                            <img src="{{ asset("assets/images/receipt-alt.svg") }}"
                                                                class="w-6 h-6 {{ request()->routeIs("admin.receipts.*") ? "filter invert" : "" }}"
                                                                alt="receipt-icon"> <span
                                                                class="text-[14px] font-sans ml-2 mr-4 {{ request()->routeIs("admin.receipts.*") ? "text-white" : "text-[#222222B2]" }}">Receipt</span>
                                                        </a>
                                                        @endif <!-- UpdateReceipt -->
                                                        @if (in_array($userRole, ["Admin", "Accountant"]))
                                                            <a href="{{ route("admin.update-receipts.index") }}"
                                                                class="{{ request()->routeIs("admin.update-receipts.*") ? "flex items-center py-[12px] px-5 bg-black text-white rounded-l ml-6 shadow-md mt-7 mr-4 font-sans" : "flex items-center gap-3 py-2 px-8 h-12 text-gray-800 mt-7 font-sans hover:scale-110 transition-transform duration-200 rounded-l ml-6 mr-4" }}">
                                                                <img src="{{ asset("assets/images/receipt-alt.svg") }}"
                                                                    class="w-6 h-6 {{ request()->routeIs("admin.update-receipts.*") ? "filter invert" : "" }}"
                                                                    alt="receipt-icon"> <span
                                                                    class="text-[14px] font-sans ml-2 mr-4 {{ request()->routeIs("admin.update-receipts.*") ? "text-white" : "text-[#222222B2]" }}">Updated
                                                                    Receipt</span> </a>
                                                            @endif <!-- Blog -->
                                                            @if (in_array($userRole, ["Admin", "Accountant"]))
                                                                <a href="{{ route("admin.blogs.index") }}"
                                                                    class="{{ request()->routeIs("admin.blogs.*") ? "flex items-center py-[12px] px-5 bg-black text-white rounded-l ml-6 shadow-md mt-7 mr-4 font-sans" : "flex items-center gap-3 py-2 px-8 h-12 text-gray-800 mt-7 font-sans hover:scale-110 transition-transform duration-200 rounded-l ml-6 mr-4" }}">
                                                                    <img src="{{ asset("assets/images/blog.svg") }}"
                                                                        class="w-6 h-6 {{ request()->routeIs("admin.blogs.*") ? "filter invert" : "" }}"
                                                                        alt="blog-icon"> <span
                                                                        class="text-[14px] font-sans ml-2 mr-4 {{ request()->routeIs("admin.blogs.*") ? "text-white" : "text-[#222222B2]" }}">Blog</span>
                                                                </a>
                                                            @endif
                                                            <!-- Logout at the bottom -->
                                                            <form method="POST" action="{{ route("admin.logout") }}"
                                                                class="mt-7 flex items-center gap-3 py-2 px-8 h-12 font-sans mb-4 text-red-600">
                                                                @csrf
                                                                <button type="submit"
                                                                    class="flex items-center hover:scale-105 transition-transform duration-200">
                                                                    <img src="{{ asset("assets/images/logout.svg") }}"
                                                                        class="w-6 h-6 " alt="logout-icon">
                                                                    <span class="pl-2 text-[13.5px] font-sans">Log
                                                                        Out</span>
                                                                </button>
                                                            </form>
        </nav>
    </aside>

    <!-- Main content -->
    <div class="w-full flex flex-col h-screen overflow-y-hidden">
        <!-- Desktop Header -->
        <header class="w-full items-center bg-white py-6 px-18 hidden lg:flex justify-between">
            <div class="w-full flex flex-row justify-between">
                <p class=" text-[#222222] text-[30px] ml-4"></p>
                <div class="flex items-center gap-2 mt-4">
                    <img src="{{ asset("assets/images/notifyicon.png") }}" alt="Alert" class="w-5 h-5">
                    <p class="text-[#222222] font-[bricolage] font-bold">{{ auth()->user()->name }}</p>
                </div>
            </div>
        </header>

        <!-- Mobile Header -->
        <header class="w-full bg-[#ffffff] py-5 px-6 lg:hidden">
            <div class="flex items-center justify-between">
                <a href="/">
                    <img class="w-[120px]" src="{{ asset("assets/images/omegacitylogo.png") }}" alt="logo" />
                </a>
                <button @click="sidebarOpen = !sidebarOpen" class="text-black text-3xl focus:outline-none">
                    <i x-show="!sidebarOpen" class="fas fa-bars"></i>
                    <i x-show="sidebarOpen" class="fas fa-times"></i>
                </button>
            </div>
        </header>

        <!-- Content -->
        <div class="w-full flex flex-col overflow-y-scroll p-7">
            @yield("content")
        </div>
    </div>

    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @stack("scripts")
</body>

</html>
