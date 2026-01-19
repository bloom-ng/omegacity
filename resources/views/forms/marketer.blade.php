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

        <form method="POST" action="{{ route("marketer.store") }}" enctype="multipart/form-data" class="space-y-6">
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

            <select id="id_type" name="id_type"
                class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2
           focus:ring-black focus:border-black outline-none">
                <option value="">Valid Means of Identification</option>
                <option value="Driver License">Driver License</option>
                <option value="National ID Card">National ID Card</option>
                <option value="International Passport">International Passport</option>
                <option value="Voter’s Card">Voter’s Card</option>
            </select>

            <!-- ID Upload -->
            <div id="id_upload_wrapper" class="hidden ">
                <label class="block font-semibold">Attach means of identification</label>
                <input type="file" name="id_file"
                    class="w-full border-2 border-gray-700 p-3 rounded-md bg-white
                  focus:ring-2 focus:ring-black focus:border-black outline-none">
            </div>

            <!-- Address -->
            <textarea name="address" placeholder="Residential Address"
                class="w-full mt-3 border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"></textarea>

            <!-- Date of Birth -->
            <div>
                <label class="block font-semibold mb-1">Date of Birth</label>
                <input type="date" name="dob"
                    class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none">
            </div>

            <!-- Gender -->
            <div>
                <label class="block font-semibold mb-1">Gender</label>
                <select name="gender" required
                    class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none">
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
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

            <!-- Contact staff. -->
            <div>
                <label class="block font-semibold mb-1">Name of Contact Staff (optional)</label>
                <input name="contact_staff" placeholder="Full name of contact staff if any...."
                    class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none">
            </div>

            <!-- Terms & Conditions -->
            <div class="border-2 border-gray-700 rounded-md p-4 h-auto overflow-y-scroll text-sm bg-gray-50 mt-4">
                <h4 class="font-bold mb-2">Terms and Conditions</h4>

                <p class="mb-2">
                    a) Letter of interest/proposal addressed to the Managing Director, Omega City & Properties Ltd.
                </p>

                <p class="mb-2">
                    b) Omega City & Properties Ltd does not allow any form of payment to any agent, realtor, marketer,
                    or representative of Omega City & Properties Ltd. All payments shall be made in favor of
                    Omega City & Properties Ltd into its designated bank accounts.
                </p>

                <p class="mb-2">
                    c) Omega City & Properties Ltd does not allow markup.
                </p>

                <p class="mb-2">
                    d) Percentage commission shall be discussed, agreed upon, and clearly stated in your acceptance
                    offer.
                </p>

                <p class="mb-2">
                    e) You must protect Omega City & Properties Ltd’s interest and promote the brand in good faith.
                </p>

                <p class="mb-2">
                    f) Omega City & Properties Ltd maintains standard operating procedures and channels of doing
                    business;
                    therefore, you must maintain the reporting system.
                </p>

                <p class="mb-2">
                    g) You must maintain clear communication and uphold integrity at all times.
                </p>

                <p class="mb-2">
                    h) You must maintain a good relationship with clients and Omega City & Properties Ltd and
                    keep all matters confidential.
                </p>

                <p class="mb-2">
                    i) You must not mandate a client to pay you any agency fee.
                </p>
                <label class="font-semibold flex items-start gap-1 mt-4">
                    <input type="checkbox" id="terms" name="terms" class="mt-1">
                    <label for="" class="text-sm font-medium"></label>
                    I have read, understood, and agree to comply with the terms and conditions of representing
                    Omega City & Properties Ltd as an agent, realtor, or marketer as contained in this application form.
                </label>
            </div>

            <button id="submitBtn" disabled class="bg-gray-400 text-white px-6 py-2 rounded shadow cursor-not-allowed">
                Submit
            </button>

        </form>
    </div>

    @include("users.footer")

</body>

<script>
    // Applicant ID
    document.getElementById('id_type').addEventListener('change', function() {
        let wrapper = document.getElementById('id_upload_wrapper');
        wrapper.classList.toggle('hidden', this.value === '');
    });
    const termsCheckbox = document.getElementById('terms');
    const submitBtn = document.getElementById('submitBtn');

    termsCheckbox.addEventListener('change', function() {
        if (this.checked) {
            submitBtn.disabled = false;
            submitBtn.classList.remove('bg-gray-400', 'cursor-not-allowed');
            submitBtn.classList.add('bg-black', 'hover:bg-gray-800');
        } else {
            submitBtn.disabled = true;
            submitBtn.classList.add('bg-gray-400', 'cursor-not-allowed');
            submitBtn.classList.remove('bg-black', 'hover:bg-gray-800');
        }
    });
</script>

</html>

<style>
    .input {
        @apply w-full border p-2 rounded;
    }
</style>
