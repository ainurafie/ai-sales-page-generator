<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    {{ $salesPage->product_name }}
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Dibuat {{ $salesPage->created_at->diffForHumans() }}
                </p>
            </div>

            <div class="flex items-center gap-2">
                <button
                    type="button"
                    onclick="copyContent()"
                    class="inline-flex items-center gap-1.5 rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                    </svg>
                    <span id="copyLabel">Copy</span>
                </button>

                <a
                    href="{{ route('sales-pages.index') }}"
                    class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50"
                >
                    &larr; Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            {{-- Info Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-gray-200">
                    <div class="flex items-center gap-2 text-xs font-semibold uppercase tracking-wide text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Target Audience
                    </div>
                    <p class="mt-2 text-sm font-medium text-gray-900">
                        {{ $salesPage->target_audience }}
                    </p>
                </div>

                <div class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-gray-200">
                    <div class="flex items-center gap-2 text-xs font-semibold uppercase tracking-wide text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Harga
                    </div>
                    <p class="mt-2 text-sm font-medium text-gray-900">
                        {{ $salesPage->price ?: '-' }}
                    </p>
                </div>

                <div class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-gray-200">
                    <div class="flex items-center gap-2 text-xs font-semibold uppercase tracking-wide text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                        Status
                    </div>
                    <p class="mt-2">
                        <span class="inline-flex items-center gap-1 rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800">
                            <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>
                            Generated
                        </span>
                    </p>
                </div>
            </div>

            {{-- Main Content Card --}}
            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-200">
                {{-- Hero header --}}
                <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 px-8 py-10 text-center">
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-white/20 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-white backdrop-blur">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        AI Generated Sales Page
                    </span>
                    <h1 class="mt-4 text-3xl md:text-4xl font-bold text-white tracking-tight">
                        {{ $salesPage->product_name }}
                    </h1>
                    <p class="mt-3 max-w-2xl mx-auto text-sm md:text-base text-indigo-100">
                        {{ \Illuminate\Support\Str::limit($salesPage->description, 180) }}
                    </p>
                </div>

                {{-- Content body --}}
                <article id="salesContent" class="sales-content px-6 md:px-12 py-10">
                    {!! $renderedContent !!}
                </article>

                {{-- Footer actions --}}
                <div class="border-t border-gray-200 bg-gray-50 px-6 md:px-12 py-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <p class="text-xs text-gray-500">
                        Generated by AI &middot; {{ $salesPage->created_at->format('d M Y, H:i') }} WIB
                    </p>

                    <form action="{{ route('sales-pages.destroy', $salesPage) }}" method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus sales page ini?')">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="inline-flex items-center gap-1.5 rounded-md border border-red-200 bg-red-50 px-3 py-1.5 text-sm font-medium text-red-700 hover:bg-red-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M1 7h22M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3" />
                            </svg>
                            Hapus Sales Page
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .sales-content {
            color: #374151;
            line-height: 1.75;
            font-size: 1rem;
        }
        .sales-content h1,
        .sales-content h2,
        .sales-content h3,
        .sales-content h4 {
            font-weight: 700;
            color: #111827;
            letter-spacing: -0.01em;
        }
        .sales-content h1 {
            font-size: 1.875rem;
            margin: 2rem 0 1rem;
        }
        .sales-content h2 {
            font-size: 1.5rem;
            margin: 2.5rem 0 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #e5e7eb;
        }
        .sales-content h3 {
            font-size: 1.25rem;
            margin: 2rem 0 0.75rem;
            color: #4338ca;
        }
        .sales-content h4 {
            font-size: 1.1rem;
            margin: 1.5rem 0 0.5rem;
            color: #4f46e5;
        }
        .sales-content p {
            margin: 1rem 0;
        }
        .sales-content strong {
            color: #111827;
            font-weight: 600;
        }
        .sales-content ul,
        .sales-content ol {
            margin: 1rem 0;
            padding-left: 1.5rem;
        }
        .sales-content ul {
            list-style: none;
            padding-left: 0;
        }
        .sales-content ul li {
            position: relative;
            padding-left: 1.75rem;
            margin: 0.5rem 0;
        }
        .sales-content ul li::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0.6rem;
            width: 0.5rem;
            height: 0.5rem;
            background: linear-gradient(135deg, #6366f1, #ec4899);
            border-radius: 9999px;
        }
        .sales-content ol {
            counter-reset: item;
            list-style: none;
            padding-left: 0;
        }
        .sales-content ol > li {
            counter-increment: item;
            position: relative;
            padding-left: 2.5rem;
            margin: 0.75rem 0;
        }
        .sales-content ol > li::before {
            content: counter(item);
            position: absolute;
            left: 0;
            top: 0;
            width: 1.75rem;
            height: 1.75rem;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: white;
            border-radius: 9999px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: 600;
        }
        .sales-content blockquote {
            border-left: 4px solid #6366f1;
            background: #eef2ff;
            padding: 0.75rem 1.25rem;
            border-radius: 0 0.5rem 0.5rem 0;
            margin: 1.5rem 0;
            font-style: normal;
            color: #4338ca;
        }
        .sales-content a {
            color: #4f46e5;
            text-decoration: none;
            font-weight: 500;
        }
        .sales-content a:hover {
            text-decoration: underline;
        }
        .sales-content hr {
            margin: 2rem 0;
            border: none;
            border-top: 1px solid #e5e7eb;
        }
        .sales-content code {
            background: #f3f4f6;
            padding: 0.125rem 0.375rem;
            border-radius: 0.25rem;
            font-size: 0.875em;
            color: #db2777;
        }
    </style>

    <script>
        function copyContent() {
            const content = @json($salesPage->generated_content);
            navigator.clipboard.writeText(content).then(() => {
                const label = document.getElementById('copyLabel');
                const original = label.textContent;
                label.textContent = 'Copied!';
                setTimeout(() => { label.textContent = original; }, 2000);
            });
        }
    </script>
</x-app-layout>
