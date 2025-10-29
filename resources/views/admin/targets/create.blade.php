@extends("layouts.admin-layout")

@section("title", "Set Targets for {{ $agent->name }}")

@section("content")
    <div class="w-full max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Set Targets for {{ $agent->name }}</h1>
                <p class="text-gray-600">Set monthly and yearly targets for amount and sales</p>
            </div>
            <a href="{{ route('admin.targets.index') }}"
                class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-lg transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i> Back to Agents
            </a>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-8">
                <form action="{{ route('admin.targets.store', $agent) }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Target Type Selection -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Period Type -->
                        <div>
                            <label for="period_type" class="block text-sm font-semibold text-gray-700 mb-2">
                                Target Period <span class="text-red-500">*</span>
                            </label>
                            <select name="targets[0][period_type]" id="period_type" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-black focus:border-black @error('targets.0.period_type') border-red-500 @enderror"
                                onchange="togglePeriodOptions()">
                                <option value="">-- Select Period --</option>
                                <option value="monthly" {{ old('targets.0.period_type') === 'monthly' ? 'selected' : '' }}>Monthly Target</option>
                                <option value="yearly" {{ old('targets.0.period_type') === 'yearly' ? 'selected' : '' }}>Yearly Target</option>
                            </select>
                            @error('targets.0.period_type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Target Type -->
                        <div>
                            <label for="target_type" class="block text-sm font-semibold text-gray-700 mb-2">
                                Target Type <span class="text-red-500">*</span>
                            </label>
                            <select name="targets[0][target_type]" id="target_type" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-black focus:border-black @error('targets.0.target_type') border-red-500 @enderror">
                                <option value="">-- Select Type --</option>
                                <option value="amount" {{ old('targets.0.target_type') === 'amount' ? 'selected' : '' }}>Revenue Amount (₦)</option>
                                <option value="sales" {{ old('targets.0.target_type') === 'sales' ? 'selected' : '' }}>Sales Count</option>
                            </select>
                            @error('targets.0.target_type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Monthly Options (Hidden by default) -->
                    <div id="monthly_options" class="grid grid-cols-1 lg:grid-cols-2 gap-6" style="display: none;">
                        <div>
                            <label for="month" class="block text-sm font-semibold text-gray-700 mb-2">
                                Select Month <span class="text-red-500">*</span>
                            </label>
                            <select name="targets[0][month]" id="month"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-black focus:border-black">
                                <option value="">-- Select Month --</option>
                                @for($month = $currentMonth; $month <= 12; $month++)
                                    <option value="{{ $month }}" {{ old('targets.0.month') == $month ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::create()->month($month)->format('F Y') }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div>
                            <label for="monthly_year" class="block text-sm font-semibold text-gray-700 mb-2">Year</label>
                            <input type="number" name="targets[0][year]" id="monthly_year" 
                                value="{{ old('targets.0.year', $currentYear) }}" readonly
                                class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100">
                        </div>
                    </div>

                    <!-- Yearly Options (Hidden by default) -->
                    <div id="yearly_options" class="grid grid-cols-1 lg:grid-cols-2 gap-6" style="display: none;">
                        <div>
                            <label for="yearly_year" class="block text-sm font-semibold text-gray-700 mb-2">
                                Select Year <span class="text-red-500">*</span>
                            </label>
                            <select name="targets[0][year]" id="yearly_year"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-black focus:border-black">
                                <option value="">-- Select Year --</option>
                                @for($year = $currentYear; $year <= $currentYear + 5; $year++)
                                    <option value="{{ $year }}" {{ old('targets.0.year', $currentYear) == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <!-- Target Value -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div>
                            <label for="target_value" class="block text-sm font-semibold text-gray-700 mb-2">
                                Target Value <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="targets[0][target_value]" id="target_value" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-black focus:border-black @error('targets.0.target_value') border-red-500 @enderror"
                                placeholder="Enter target value"
                                min="0" step="0.01"
                                value="{{ old('targets.0.target_value') }}">
                            @error('targets.0.target_value')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500" id="target_hint">
                                Enter the target amount in Naira or number of sales
                            </p>
                        </div>

                        <div>
                            <label for="notes" class="block text-sm font-semibold text-gray-700 mb-2">
                                Notes (Optional)
                            </label>
                            <textarea name="targets[0][notes]" id="notes" rows="3"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-black focus:border-black"
                                placeholder="Any additional notes about this target...">{{ old('targets.0.notes') }}</textarea>
                        </div>
                    </div>

                    <!-- Existing Targets Warning -->
                    <div id="existing_target_warning" class="bg-yellow-50 border border-yellow-200 rounded-md p-4" style="display: none;">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-triangle text-yellow-400"></i>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-yellow-800">Existing Target Found</h3>
                                <div class="mt-2 text-sm text-yellow-700">
                                    <p id="existing_target_message"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                        <a href="{{ route('admin.targets.index') }}"
                            class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                            Cancel
                        </a>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-black hover:bg-gray-700">
                            <i class="fas fa-save mr-2"></i> Save Targets
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Existing targets data for checking duplicates
        const existingTargets = @json($existingTargets);
        
        function togglePeriodOptions() {
            const periodType = document.getElementById('period_type').value;
            const monthlyOptions = document.getElementById('monthly_options');
            const yearlyOptions = document.getElementById('yearly_options');
            const targetHint = document.getElementById('target_hint');
            
            // Hide both sections first
            monthlyOptions.style.display = 'none';
            yearlyOptions.style.display = 'none';
            
            // Reset form validation requirements
            document.getElementById('month').required = false;
            document.getElementById('yearly_year').required = false;
            
            if (periodType === 'monthly') {
                monthlyOptions.style.display = 'grid';
                document.getElementById('month').required = true;
                targetHint.textContent = 'Enter the monthly target (amount in Naira or number of sales)';
            } else if (periodType === 'yearly') {
                yearlyOptions.style.display = 'grid';
                document.getElementById('yearly_year').required = true;
                targetHint.textContent = 'Enter the yearly target (amount in Naira or number of sales)';
            }
            
            // Update target hint based on target type
            updateTargetHint();
            checkExistingTarget();
        }
        
        function updateTargetHint() {
            const targetType = document.getElementById('target_type').value;
            const targetHint = document.getElementById('target_hint');
            const periodType = document.getElementById('period_type').value;
            
            if (targetType === 'amount') {
                const period = periodType === 'monthly' ? 'monthly' : periodType === 'yearly' ? 'yearly' : '';
                targetHint.textContent = `Enter the ${period} revenue target in Naira (e.g., 500000 for ₦500,000)`;
            } else if (targetType === 'sales') {
                const period = periodType === 'monthly' ? 'monthly' : periodType === 'yearly' ? 'yearly' : '';
                targetHint.textContent = `Enter the ${period} sales count target (e.g., 10 for 10 sales)`;
            }
        }
        
        function checkExistingTarget() {
            const periodType = document.getElementById('period_type').value;
            const targetType = document.getElementById('target_type').value;
            const month = document.getElementById('month').value;
            const year = periodType === 'monthly' ? {{ $currentYear }} : document.getElementById('yearly_year').value;
            
            if (!periodType || !targetType) return;
            
            let existingKey = '';
            if (periodType === 'monthly' && month) {
                existingKey = `${periodType}_${targetType}_${month}`;
            } else if (periodType === 'yearly') {
                existingKey = `${periodType}_${targetType}_yearly`;
            }
            
            const existing = existingTargets[existingKey];
            const warningDiv = document.getElementById('existing_target_warning');
            const warningMessage = document.getElementById('existing_target_message');
            
            if (existing) {
                const periodDisplay = periodType === 'monthly' ? 
                    `${new Date(year, month - 1).toLocaleString('default', { month: 'long' })} ${year}` : 
                    year;
                const typeDisplay = targetType === 'amount' ? 'amount' : 'sales count';
                const valueDisplay = targetType === 'amount' ? 
                    `₦${Number(existing.target_value).toLocaleString()}` : 
                    `${existing.target_value} sales`;
                
                warningMessage.textContent = `A ${periodType} ${typeDisplay} target already exists for ${periodDisplay}: ${valueDisplay}. Creating a new target will update the existing one.`;
                warningDiv.style.display = 'block';
            } else {
                warningDiv.style.display = 'none';
            }
        }
        
        // Event listeners
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('target_type').addEventListener('change', function() {
                updateTargetHint();
                checkExistingTarget();
            });
            
            document.getElementById('month').addEventListener('change', checkExistingTarget);
            document.getElementById('yearly_year').addEventListener('change', checkExistingTarget);
            
            // Initialize form if there are old values
            @if(old('targets.0.period_type'))
                togglePeriodOptions();
            @endif
        });
    </script>
    @endpush
@endsection
