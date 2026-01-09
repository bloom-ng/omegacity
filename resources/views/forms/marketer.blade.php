<!DOCTYPE html>
<html lang="en">
@include("users.header")

<body class="bg-[#F3F3F3] text-[#010504]">

    @include("users.nav")

    <div class="max-w-3xl mx-auto bg-white shadow-md p-8 rounded-lg mt-8">
        <h2 class="text-2xl font-bold mb-6">Personal Information Form</h2>

        @if (session("success"))
            <p class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session("success") }}
            </p>
        @endif

        <form method="POST" action="{{ route('marketer.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Passport -->
            <div>
                <label class="block font-semibold mb-1">Passport Photograph</label>
                <input type="file" name="passport"
                    class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none">
            </div>

            <!-- Full Name -->
            <input name="full_name" placeholder="Full Name"
                class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none">

            <!-- Phone Number -->
            <input name="phone" placeholder="Phone Number"
                class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none">

            <!-- Email -->
            <input type="email" name="email" placeholder="Email Address"
                class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none">

            <!-- Address -->
            <textarea name="address" placeholder="Residential Address"
                class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"></textarea>

            <!-- Date of Birth -->
            <div>
                <label class="block font-semibold mb-1">Date of Birth</label>
                <input type="date" name="dob"
                    class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none">
            </div>

            <!-- Occupation -->
            <input name="occupation" placeholder="Occupation"
                class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none">

            <!-- Bank Details -->
            <h3 class="font-bold text-lg border-b pt-4">Bank Details</h3>

            <input name="bank_name" placeholder="Bank Name"
                class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none">

            <input name="account_name" placeholder="Account Name"
                class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none">

            <input name="account_number" placeholder="Account Number"
                class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none">

            <!-- Signature -->
            <div>
                <label class="block font-semibold mb-1">Upload Signature</label>
                <input type="file" name="signature"
                    class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none">
            </div>

           
            <button class="bg-black text-white px-6 py-2 rounded shadow hover:bg-gray-800">
                Submit
            </button>

        </form>
    </div>

    @include("users.footer")

</body>
</html>

<style>
    .input {
        @apply w-full border p-2 rounded;
    }
</style>
