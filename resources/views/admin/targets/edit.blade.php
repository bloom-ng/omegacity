@extends("layouts.admin-layout")

@section("title", "Edit Target for {{ $agent->name }}")

@section("content")
    <div class="w-full max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Edit Target for {{ $agent->name }}</h1>
                <p class="text-gray-600">Update target value, notes, and status</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.targets.show', $agent) }}"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-lg transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Targets
                </a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-8">
                <!-- Target Information (Read-only) -->
                <div class="bg-gray-50 rounded-lg p-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Target Details</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Period Type</p>
                            <p class="text-base font-semibold text-gray-900 mt-1">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ ucfirst($target->period_type) }}
                                </span>
                            </p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600">Target Type</p>
                            <p class="text-base font-semibold text-gray-900 mt-1">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    @if($target->target_type === 'amount') bg-blue-100 text-blue-800 @else bg-green-100 text-green-800 @endif">
                                    {{ ucfirst($target->target_type) }}
                                </span>
                            </p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600">Period</p>
                            <p class="text-base font-semibold text-gray-900 mt-1">
                                @if($target->period_type === 'monthly')
                                    {{ \Carbon\Carbon::create()->month($target->month)->format('F') }} {{ $target->year }}
                                @else
                                    {{ $target->year }}
                                @endif
                            </p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600">Current Progress</p>
                            <p class="text-base font-semibold text-gray-900 mt-1">
                                {{ $target->progress_percentage }}%
                            </p>
                        </div>
                    </div>

                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm font-medium text-gray-600">Achieved Value</span>
                            <span class="text-sm font-semibold text-gray-900">{{ $target->formatted_achieved_value }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div class="bg-blue-600 h-3 rounded-full transition-all duration-300" 
                                style="width: {{ min(100, $target->progress_percentage) }}%"></div>
                        </div>
                    </div>
                </div>

                <!-- Edit Form -->
                <form action="{{ route('admin.targets.update', [$agent, $target]) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Target Value -->
                    <div>
                        <label for="target_value" class="block text-sm font-semibold text-gray-700 mb-2">
                            Target Value <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="target_value" id="target_value" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-black focus:border-black @error('target_value') border-red-500 @enderror"
                            placeholder="Enter target value"
                            min="0" step="0.01"
                            value="{{ old('target_value', $target->target_value) }}">
                        @error('target_value')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">
                            @if($target->target_type === 'amount')
                                Enter the target amount in Naira (e.g., 500000 for ₦500,000)
                            @else
                                Enter the target sales count (e.g., 10 for 10 sales)
                            @endif
                        </p>
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select name="status" id="status" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-black focus:border-black @error('status') border-red-500 @enderror">
                            <option value="active" {{ old('status', $target->status) === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="achieved" {{ old('status', $target->status) === 'achieved' ? 'selected' : '' }}>Achieved</option>
                            <option value="missed" {{ old('status', $target->status) === 'missed' ? 'selected' : '' }}>Missed</option>
                            <option value="cancelled" {{ old('status', $target->status) === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">
                            Update the status of this target (Active, Achieved, Missed, or Cancelled)
                        </p>
                    </div>

                    <!-- Notes -->
                    <div>
                        <label for="notes" class="block text-sm font-semibold text-gray-700 mb-2">
                            Notes (Optional)
                        </label>
                        <textarea name="notes" id="notes" rows="4"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-black focus:border-black @error('notes') border-red-500 @enderror"
                            placeholder="Any additional notes about this target..."
                            maxlength="500">{{ old('notes', $target->notes) }}</textarea>
                        @error('notes')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">
                            Maximum 500 characters. <span id="notes_counter">{{ strlen($target->notes ?? '') }}</span>/500
                        </p>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                        <div>
                            <form method="POST" action="{{ route('admin.targets.destroy', [$agent, $target]) }}" 
                                class="inline" onsubmit="return confirm('Are you sure you want to delete this target? This action cannot be undone.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-4 py-2 border border-red-300 rounded-md text-sm font-medium text-red-700 bg-white hover:bg-red-50">
                                    <i class="fas fa-trash mr-2"></i> Delete Target
                                </button>
                            </form>
                        </div>
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('admin.targets.show', $agent) }}"
                                class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                Cancel
                            </a>
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-black hover:bg-gray-700">
                                <i class="fas fa-save mr-2"></i> Update Target
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Additional Information -->
        <div class="mt-6 bg-blue-50 border border-blue-200 rounded-md p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-info-circle text-blue-400"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-blue-800">Important Information</h3>
                    <div class="mt-2 text-sm text-blue-700">
                        <ul class="list-disc list-inside space-y-1">
                            <li>The period type, target type, and time period cannot be changed after creation.</li>
                            <li>Updating the target value will automatically recalculate the progress percentage.</li>
                            <li>The achieved value is automatically calculated from completed sales and cannot be manually edited.</li>
                            <li>Changing the status to "Achieved" or "Missed" will affect reporting and analytics.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Character counter for notes
        document.addEventListener('DOMContentLoaded', function() {
            const notesTextarea = document.getElementById('notes');
            const notesCounter = document.getElementById('notes_counter');
            
            notesTextarea.addEventListener('input', function() {
                const length = this.value.length;
                notesCounter.textContent = length;
                
                if (length > 500) {
                    notesCounter.classList.add('text-red-600');
                } else {
                    notesCounter.classList.remove('text-red-600');
                }
            });
        });
    </script>
    @endpush
@endsection
