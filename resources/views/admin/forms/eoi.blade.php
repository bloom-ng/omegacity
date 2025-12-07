@extends("layouts.admin-layout")

@section("content")
    <div class="w-full">
        <div class="bg-white rounded-lg shadow overflow-hidden">

            {{-- Header + Search Bar --}}
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">

                    <!-- Search Form -->
                    <div class="flex items-center gap-3">
                        <form method="GET" action="{{ route("admin.forms.eoi") }}" class="relative max-w-xs w-full">
                            <input type="text" name="search" value="{{ request("search") }}"
                                class="form-input w-full pl-10 pr-4 py-2 border rounded-lg"
                                placeholder="Search EOI forms...">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </form>

                        @if (request("search"))
                            <a href="{{ route("admin.forms.eoi") }}" class="text-sm text-blue-600 hover:underline">Clear</a>
                        @endif
                    </div>


                    <a href="{{ route("admin.forms.eoi.download") }}"
                        class="bg-black shadow-md hover:scale-110 transition-transform duration-200 text-white font-medium py-2 px-4 rounded-lg">
                        Download EOI pdf
                    </a>

                </div>
            </div>


            {{-- Table --}}
            <div class="">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <tr>
                            <th class="py-3 px-6 text-left">#</th>
                            <th class="py-3 px-6 text-left">Applicant</th>
                            <th class="py-3 px-6 text-left">Email</th>
                            <th class="py-3 px-6 text-left">Phone</th>
                            <th class="py-3 px-6 text-left">Land Type</th>
                            <th class="px-6 py-3 text-right">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($forms as $form)
                            <tr class="hover:bg-gray-50">

                                <td class="px-6 py-4 text-sm">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 text-sm">{{ $form->surname }} {{ $form->first_name }}</td>
                                <td class="px-6 py-4 text-sm">{{ $form->email }}</td>
                                <td class="px-6 py-4 text-sm">{{ $form->mobile }}</td>
                                <td class="px-6 py-4 text-sm">{{ $form->land_category }}</td>

                                <td class="px-6 py-4 text-right text-sm">

                                    {{-- View PDF --}}
                                    <a href="{{ route("admin.forms.download", [$form->id, "eoi"]) }}" target="_blank"
                                        rel="noopener noreferrer" class="text-blue-600 hover:text-blue-900 mr-3">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <div class="relative inline-block text-left z-40">

                                        <button onclick="toggleDropdown({{ $form->id }})"
                                            class="text-blue-600 hover:text-blue-900 focus:outline-none mr-3">
                                            <i class="fas fa-download text-lg"></i>
                                        </button>

                                        <div id="dropdown-{{ $form->id }}"
                                            class="hidden fixed bg-white border border-gray-200 rounded-md shadow-xl z-[99999] w-48">


                                            <ul class="py-2 text-sm text-gray-700">

                                                <li class="px-4 py-2 hover:bg-gray-100">
                                                    @if ($form->id_file)
                                                        <a href="{{ route("admin.eoi.download.file", ["type" => "id", "id" => $form->id]) }}"
                                                            target="_blank" rel="noopener noreferrer"
                                                            class="flex items-center space-x-2">
                                                            <i class="fas fa-id-card"></i>
                                                            <span>Download ID File</span>
                                                        </a>
                                                    @else
                                                        <span class="text-gray-400">No ID File</span>
                                                    @endif
                                                </li>

                                                <li class="px-4 py-2 hover:bg-gray-100 border-t border-gray-200">
                                                    @if ($form->nok_id_file)
                                                        <a href="{{ route("admin.eoi.download.file", ["type" => "nok", "id" => $form->id]) }}"
                                                            target="_blank" rel="noopener noreferrer"
                                                            class="flex items-center space-x-2">
                                                            <i class="fas fa-user-shield"></i>
                                                            <span>Download NOK ID File</span>
                                                        </a>
                                                    @else
                                                        <span class="text-gray-400">No NOK File</span>
                                                    @endif
                                                </li>

                                            </ul>


                                        </div>
                                    </div>


                                    <button class="text-green-600 hover:text-green-800 mr-3 editBtn"
                                        data-id="{{ $form->id }}"
                                        data-receiving_manager="{{ $form->receiving_manager ?? "" }}"
                                        data-date_received="{{ $form->date_received ?? "" }}"
                                        data-approval_status="{{ $form->approval_status ?? "Pending" }}"
                                        data-remark="{{ $form->remark ?? "" }}">
                                        <i class="fas fa-edit"></i>
                                    </button>


                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center py-4 text-gray-500">No EOI forms found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $forms->links() }}
            </div>
        </div>
    </div>

    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-70 flex items-center justify-center">
        <div class="bg-white w-full max-w-lg rounded-lg shadow-lg p-6">

            <h2 class="text-xl font-bold mb-4">Edit EOI Form</h2>

            <form id="editForm" method="POST">
                @csrf
                @method("PUT")
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="text-sm font-medium">Receiving Manager</label>
                        <input id="editReceivingManager" type="text" name="receiving_manager"
                            class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
                            required>
                    </div>

                    <div>
                        <label class="text-sm font-medium">Date Received</label>
                        <input id="editDateReceived" type="date" name="date_received"
                            class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
                            required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="text-sm font-medium">Approval Status</label>
                    <select id="editApprovalStatus" name="approval_status"
                        class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none">
                        <option value="Pending">Pending</option>
                        <option value="Approved">Approved</option>
                        <option value="Rejected">Rejected</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="text-sm font-medium">Remark</label>
                    <textarea id="editRemark" name="remark"
                        class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
                        rows="3" placeholder="Enter remark (optional)"></textarea>
                </div>

                <div class="flex justify-end mt-6">
                    <button type="button" onclick="closeModal()"
                        class="mr-3 bg-gray-300 text-black px-6 py-2 rounded shadow mt-8">
                        Cancel
                    </button>

                    <button class="bg-black text-white px-6 py-2 rounded shadow hover:bg-gray-800 mt-8">
                        Update
                    </button>
                </div>
            </form>

        </div>
    </div>

    <script>
        const modal = document.getElementById('editModal');
        const editForm = document.getElementById('editForm');

        document.querySelectorAll('.editBtn').forEach(btn => {
            btn.addEventListener('click', function() {

                editForm.action = "/admin/forms/eoi/" + this.dataset.id;

                document.getElementById('editReceivingManager').value = this.dataset.receiving_manager ||
                    "";
                document.getElementById('editDateReceived').value = this.dataset.date_received || "";
                document.getElementById('editApprovalStatus').value = this.dataset.approval_status ||
                    "Pending";
                document.getElementById('editRemark').value = this.dataset.remark || "";

                modal.classList.remove('hidden');
            });
        });


        function closeModal() {
            modal.classList.add('hidden');
        }

        function toggleDropdown(id) {
            const dropdown = document.getElementById(`dropdown-${id}`);
            dropdown.classList.toggle('hidden');
            const button = event.currentTarget.getBoundingClientRect();
            dropdown.style.top = (button.bottom + 8) + "px";
            dropdown.style.left = (button.right - dropdown.offsetWidth) + "px";
        }

        document.addEventListener("click", function(e) {
            document.querySelectorAll("[id^='dropdown-']").forEach(dd => {
                if (!dd.contains(e.target) && !e.target.closest("button")) {
                    dd.classList.add("hidden");
                }
            });
        });
    </script>
@endsection
