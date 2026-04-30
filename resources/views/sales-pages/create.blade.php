<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Sales Page
            </h2>

            <a
                href="{{ route('sales-pages.index') }}"
                class="text-sm text-gray-600 hover:text-gray-900"
            >
                Back to list
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if ($errors->any())
                <div class="mb-6 rounded-md bg-red-50 p-4">
                    <div class="font-semibold text-red-700">
                        Please fix the following errors:
                    </div>

                    <ul class="mt-2 list-disc list-inside text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form id="generateForm" method="POST" action="{{ route('sales-pages.store') }}" class="p-6 space-y-6">
                    @csrf

                    <div>
                        <label for="product_name" class="block text-sm font-medium text-gray-700">
                            Product / Service Name <span class="text-red-500">*</span>
                        </label>

                        <input
                            id="product_name"
                            name="product_name"
                            type="text"
                            value="{{ old('product_name') }}"
                            placeholder="Example: Premium Coffee Subscription"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            required
                        >

                        @error('product_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">
                            Description <span class="text-red-500">*</span>
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows="5"
                            placeholder="Describe what your product/service does..."
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            required
                        >{{ old('description') }}</textarea>

                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="features" class="block text-sm font-medium text-gray-700">
                            Key Features <span class="text-red-500">*</span>
                        </label>

                        <textarea
                            id="features"
                            name="features"
                            rows="4"
                            placeholder="Example: Fast delivery, premium quality, free consultation"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            required
                        >{{ old('features') }}</textarea>

                        <p class="mt-1 text-xs text-gray-500">
                            Separate features with commas or write each feature in a sentence.
                        </p>

                        @error('features')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="target_audience" class="block text-sm font-medium text-gray-700">
                                Target Audience <span class="text-red-500">*</span>
                            </label>

                            <input
                                id="target_audience"
                                name="target_audience"
                                type="text"
                                value="{{ old('target_audience') }}"
                                placeholder="Example: Small business owners"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                required
                            >

                            @error('target_audience')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700">
                                Price
                            </label>

                            <input
                                id="price"
                                name="price"
                                type="text"
                                value="{{ old('price') }}"
                                placeholder="Example: Rp150.000 / month"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >

                            @error('price')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="usp" class="block text-sm font-medium text-gray-700">
                            Unique Selling Points
                        </label>

                        <textarea
                            id="usp"
                            name="usp"
                            rows="4"
                            placeholder="What makes this product different from competitors?"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        >{{ old('usp') }}</textarea>

                        @error('usp')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4 border-t">
                        <a
                            href="{{ route('sales-pages.index') }}"
                            class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md text-sm font-semibold hover:bg-gray-200"
                        >
                            Cancel
                        </a>

                        <button
                            id="submitBtn"
                            type="submit"
                            class="inline-flex items-center gap-2 px-5 py-2 bg-gray-900 text-white rounded-md text-sm font-semibold hover:bg-gray-700 disabled:opacity-60 disabled:cursor-not-allowed"
                        >
                            <svg id="submitSpinner" class="hidden animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                            </svg>
                            <span id="submitLabel">Generate Sales Page</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Loading Overlay --}}
    <div id="loadingOverlay" class="hidden fixed inset-0 z-50 bg-gray-900/70 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-8 text-center">
            {{-- Animated icon --}}
            <div class="relative h-20 w-20 mx-auto">
                <div class="absolute inset-0 rounded-full bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 animate-pulse"></div>
                <div class="absolute inset-1 rounded-full bg-white flex items-center justify-center">
                    <svg class="h-10 w-10 text-indigo-600 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                    </svg>
                </div>
            </div>

            <h3 class="mt-6 text-xl font-bold text-gray-900">
                AI sedang membuat sales page kamu
            </h3>
            <p class="mt-2 text-sm text-gray-600">
                Proses ini biasanya memakan waktu <span class="font-semibold text-indigo-600">10-30 detik</span>.
                Jangan tutup atau refresh halaman ini.
            </p>

            {{-- Progress steps --}}
            <div class="mt-8 space-y-3 text-left">
                <div id="step1" class="flex items-center gap-3 text-sm">
                    <div class="step-icon h-6 w-6 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600">
                        <svg class="h-3 w-3 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                        </svg>
                    </div>
                    <span class="text-gray-700">Menganalisis info produk</span>
                </div>
                <div id="step2" class="flex items-center gap-3 text-sm opacity-40">
                    <div class="step-icon h-6 w-6 rounded-full bg-gray-100 flex items-center justify-center text-gray-400">
                        <span class="text-xs">2</span>
                    </div>
                    <span class="text-gray-700">Menyusun copywriting persuasif</span>
                </div>
                <div id="step3" class="flex items-center gap-3 text-sm opacity-40">
                    <div class="step-icon h-6 w-6 rounded-full bg-gray-100 flex items-center justify-center text-gray-400">
                        <span class="text-xs">3</span>
                    </div>
                    <span class="text-gray-700">Membuat struktur landing page</span>
                </div>
                <div id="step4" class="flex items-center gap-3 text-sm opacity-40">
                    <div class="step-icon h-6 w-6 rounded-full bg-gray-100 flex items-center justify-center text-gray-400">
                        <span class="text-xs">4</span>
                    </div>
                    <span class="text-gray-700">Finalisasi konten</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function () {
            const form = document.getElementById('generateForm');
            const overlay = document.getElementById('loadingOverlay');
            const submitBtn = document.getElementById('submitBtn');
            const submitSpinner = document.getElementById('submitSpinner');
            const submitLabel = document.getElementById('submitLabel');

            form.addEventListener('submit', function () {
                // Disable button and show spinner inside button
                submitBtn.disabled = true;
                submitSpinner.classList.remove('hidden');
                submitLabel.textContent = 'Generating...';

                // Show full-screen overlay
                overlay.classList.remove('hidden');

                // Animate steps progression
                const steps = ['step1', 'step2', 'step3', 'step4'];
                let current = 0;

                function activateStep(idx) {
                    const el = document.getElementById(steps[idx]);
                    if (!el) return;
                    el.classList.remove('opacity-40');
                    const icon = el.querySelector('.step-icon');
                    icon.className = 'step-icon h-6 w-6 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600';
                    icon.innerHTML = '<svg class="h-3 w-3 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path></svg>';
                }

                function completeStep(idx) {
                    const el = document.getElementById(steps[idx]);
                    if (!el) return;
                    const icon = el.querySelector('.step-icon');
                    icon.className = 'step-icon h-6 w-6 rounded-full bg-green-500 flex items-center justify-center text-white';
                    icon.innerHTML = '<svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>';
                }

                const interval = setInterval(function () {
                    if (current < steps.length - 1) {
                        completeStep(current);
                        current++;
                        activateStep(current);
                    } else {
                        clearInterval(interval);
                    }
                }, 5000);
            });

            // Warn if user tries to leave page during generation
            window.addEventListener('beforeunload', function (e) {
                if (!overlay.classList.contains('hidden')) {
                    e.preventDefault();
                    e.returnValue = '';
                }
            });
        })();
    </script>
</x-app-layout>