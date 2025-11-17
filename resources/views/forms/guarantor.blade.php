<!DOCTYPE html>
<html lang="en">
@include("users.header")

<body class="bg-[#F3F3F3] text-[#010504]">

    @include("users.nav")

    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow mt-6">

        <h2 class="text-2xl font-bold mb-6">Guarantor Form</h2>

        @if (session("success"))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session("success") }}</div>
        @endif

        <form method="POST" action="{{ route("guarantor.store") }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- Candidate section --}}
            <h3 class="font-semibold text-lg border-b mb-2">Candidate Information</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <select name="candidate_title"
                    class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
                    required>
                    <option value="">Title</option>
                    <option>Mr</option>
                    <option>Mrs</option>
                    <option>Miss</option>
                </select>

                <input name="candidate_name" placeholder="Candidate Full Name"
                    class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
                    required>
            </div>

            {{-- Relationship Questions --}}
            <h3 class="font-semibold text-lg border-b mb-2">Guarantor Confirmation</h3>

            <label>Do you personally know the candidate?</label>
            <select name="known_candidate"
                class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
                required>
                <option value="">Select</option>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>

            <input name="relationship" placeholder="Relationship to Candidate"
                class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
                required>
            <input name="known_duration" placeholder="How long have you known them?"
                class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
                required>
            <input name="occupation" placeholder="Your Occupation"
                class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
                required>

            {{-- Guarantor Information --}}
            <h3 class="font-semibold text-lg border-b mb-2">Guarantor Personal Information</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <select name="guarantor_title"
                    class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
                    required>
                    <option value="">Title</option>
                    <option>Mr</option>
                    <option>Mrs</option>
                    <option>Miss</option>
                </select>

                <input name="guarantor_name" placeholder="Guarantor Full Name"
                    class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
                    required>
            </div>

            <textarea name="home_address" placeholder="Home Address"
                class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
                required></textarea>
            <textarea name="office_address" placeholder="Office Address"
                class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
                required></textarea>

            <input name="candidate_name_confirm" placeholder="Candidate Name (Confirm)"
                class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
                required>

            {{-- Documentation --}}
            <h3 class="font-semibold text-lg border-b mb-2">Documents</h3>

            <input type="email" name="guarantor_email" placeholder="Email Address"
                class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
                required>
            <select id="id_type" name="id_type"
                class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2
           focus:ring-black focus:border-black outline-none">
                <option value="">Valid Means of Identification</option>
                <option value="Driver License">Driver License</option>
                <option value="National ID Card">National ID Card</option>
                <option value="International Passport">International Passport</option>
                <option value="Voter’s Card">Voter’s Card</option>
            </select>

            <div id="id_upload_wrapper" class="hidden mt-2">
                <label class="block font-semibold">Attach Document</label>
                <input type="file" name="document_file"
                    class="w-full border-2 border-gray-700 p-3 rounded-md bg-white
                  focus:ring-2 focus:ring-black focus:border-black outline-none">
            </div>
            <div> <label class="block">Upload Passport</label>
                <input type="file" name="id_file"
                    class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none">
            </div>

            <div> <label class="block">Upload Signature</label>
                <input type="file" name="signature_file"
                    class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none">
            </div>


            <input name="phone" placeholder="Phone Number"
                class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
                required>
            <input type="date" name="date_signed"
                class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
                required>

            <button class="bg-black text-white px-6 py-2 rounded shadow hover:bg-gray-800">
                Submit Guarantor Form
            </button>

        </form>
    </div>

    @include("users.footer")
    <script>
        // Applicant ID
        document.getElementById('id_type').addEventListener('change', function() {
            let wrapper = document.getElementById('id_upload_wrapper');
            wrapper.classList.toggle('hidden', this.value === '');
        });
    </script>
</body>

</html>

<style>
    .input {
        @apply w-full border p-5 m-5 rounded;
    }
</style>
