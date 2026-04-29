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
                <form method="POST" action="{{ route('sales-pages.store') }}" class="p-6 space-y-6">
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
                            type="submit"
                            class="px-5 py-2 bg-gray-900 text-white rounded-md text-sm font-semibold hover:bg-gray-700"
                        >
                            Generate Sales Page
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>