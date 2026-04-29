@php
    use Illuminate\Support\Str;

    /** @var \App\Models\SalesPage $salesPage */
    /** @var array $content */

    $hero = $content['hero'] ?? null;
    $problem = $content['problem'] ?? null;
    $solution = $content['solution'] ?? null;
    $features = $content['features'] ?? [];
    $benefits = $content['benefits'] ?? [];
    $whyUs = $content['why_us'] ?? null;
    $testimonials = $content['testimonials'] ?? [];
    $pricing = $content['pricing'] ?? null;
    $faqs = $content['faq'] ?? [];
    $finalCta = $content['final_cta'] ?? null;

    $iconMap = [
        'zap' => 'M13 10V3L4 14h7v7l9-11h-7z',
        'shield' => 'M9 12l2 2 4-4M12 3l8 4v6c0 5-3.5 9-8 10-4.5-1-8-5-8-10V7l8-4z',
        'chart' => 'M3 3v18h18M9 17V9m4 8V5m4 12v-7',
        'users' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z',
        'star' => 'M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118L2.05 10.1c-.783-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.673z',
        'heart' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',
        'rocket' => 'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z',
        'check' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
        'clock' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
        'trophy' => 'M5 4h14l-1 7a6 6 0 01-12 0L5 4zM9 19h6m-3-3v3M7 4V2m10 2V2',
    ];

    $getIcon = fn($name) => $iconMap[$name] ?? $iconMap['check'];
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $salesPage->product_name }}</title>
    <meta name="description" content="{{ Str::limit($salesPage->description, 160) }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', system-ui, sans-serif; }
    </style>
</head>
<body class="antialiased bg-white text-gray-900">

    {{-- =========== HERO =========== --}}
    @if ($hero)
    <section class="relative overflow-hidden bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 text-white">
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0); background-size: 24px 24px;"></div>

        <div class="relative max-w-5xl mx-auto px-6 py-24 text-center">
            <span class="inline-flex items-center gap-1.5 rounded-full bg-white/15 px-4 py-1.5 text-xs font-semibold uppercase tracking-wider backdrop-blur">
                <span class="h-2 w-2 rounded-full bg-green-400 animate-pulse"></span>
                {{ $salesPage->target_audience }}
            </span>

            <h1 class="mt-6 text-4xl md:text-6xl font-extrabold tracking-tight leading-tight">
                {{ $hero['headline'] ?? $salesPage->product_name }}
            </h1>

            <p class="mt-6 max-w-2xl mx-auto text-lg md:text-xl text-indigo-100 leading-relaxed">
                {{ $hero['subheadline'] ?? '' }}
            </p>

            <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="#pricing"
                   class="inline-flex items-center gap-2 rounded-full bg-white text-indigo-700 px-8 py-4 text-base font-bold shadow-xl hover:shadow-2xl hover:scale-105 transition">
                    {{ $hero['cta_text'] ?? 'Mulai Sekarang' }}
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
                <a href="#features" class="text-white/90 hover:text-white text-sm font-medium underline-offset-4 hover:underline">
                    Lihat fitur lengkap
                </a>
            </div>
        </div>
    </section>
    @endif

    {{-- =========== PROBLEM =========== --}}
    @if ($problem)
    <section class="py-20 px-6 bg-gray-50">
        <div class="max-w-4xl mx-auto text-center">
            <span class="text-sm font-semibold text-red-600 uppercase tracking-wider">Masalah</span>
            <h2 class="mt-3 text-3xl md:text-4xl font-bold text-gray-900">
                {{ $problem['title'] ?? 'Kamu mengalami ini?' }}
            </h2>
            <p class="mt-5 text-lg text-gray-600 leading-relaxed">
                {{ $problem['description'] ?? '' }}
            </p>

            @if (!empty($problem['points']))
            <div class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach ($problem['points'] as $point)
                <div class="flex items-start gap-3 bg-white rounded-xl p-5 ring-1 ring-gray-200 text-left">
                    <div class="flex-shrink-0 h-8 w-8 rounded-full bg-red-100 flex items-center justify-center">
                        <svg class="h-5 w-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                    <p class="text-gray-700">{{ $point }}</p>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </section>
    @endif

    {{-- =========== SOLUTION =========== --}}
    @if ($solution)
    <section class="py-20 px-6 bg-white">
        <div class="max-w-4xl mx-auto text-center">
            <span class="text-sm font-semibold text-indigo-600 uppercase tracking-wider">Solusi</span>
            <h2 class="mt-3 text-3xl md:text-4xl font-bold text-gray-900">
                {{ $solution['title'] ?? '' }}
            </h2>
            <p class="mt-5 text-lg text-gray-600 leading-relaxed">
                {{ $solution['description'] ?? '' }}
            </p>
        </div>
    </section>
    @endif

    {{-- =========== FEATURES =========== --}}
    @if (!empty($features))
    <section id="features" class="py-20 px-6 bg-gradient-to-b from-white to-indigo-50/30">
        <div class="max-w-6xl mx-auto">
            <div class="text-center max-w-2xl mx-auto">
                <span class="text-sm font-semibold text-indigo-600 uppercase tracking-wider">Fitur</span>
                <h2 class="mt-3 text-3xl md:text-4xl font-bold text-gray-900">
                    Semua yang kamu butuhkan
                </h2>
            </div>

            <div class="mt-16 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-{{ min(count($features), 4) }} gap-6">
                @foreach ($features as $feature)
                <div class="group bg-white rounded-2xl p-6 ring-1 ring-gray-200 hover:ring-indigo-300 hover:shadow-xl transition">
                    <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white shadow-lg group-hover:scale-110 transition">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $getIcon($feature['icon'] ?? 'check') }}" />
                        </svg>
                    </div>
                    <h3 class="mt-5 text-lg font-bold text-gray-900">
                        {{ $feature['title'] ?? '' }}
                    </h3>
                    <p class="mt-2 text-sm text-gray-600 leading-relaxed">
                        {{ $feature['description'] ?? '' }}
                    </p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- =========== BENEFITS =========== --}}
    @if (!empty($benefits))
    <section class="py-20 px-6 bg-white">
        <div class="max-w-5xl mx-auto">
            <div class="text-center max-w-2xl mx-auto">
                <span class="text-sm font-semibold text-green-600 uppercase tracking-wider">Manfaat</span>
                <h2 class="mt-3 text-3xl md:text-4xl font-bold text-gray-900">
                    Apa yang kamu dapatkan
                </h2>
            </div>

            <div class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach ($benefits as $benefit)
                <div class="flex items-start gap-4 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl p-5 ring-1 ring-green-100">
                    <div class="flex-shrink-0 h-8 w-8 rounded-full bg-green-500 flex items-center justify-center shadow">
                        <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <p class="text-gray-800 font-medium pt-1">{{ $benefit }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- =========== WHY US =========== --}}
    @if ($whyUs && !empty($whyUs['reasons']))
    <section class="py-20 px-6 bg-gray-900 text-white">
        <div class="max-w-5xl mx-auto">
            <div class="text-center max-w-2xl mx-auto">
                <span class="text-sm font-semibold text-pink-400 uppercase tracking-wider">Why Choose Us</span>
                <h2 class="mt-3 text-3xl md:text-4xl font-bold">
                    {{ $whyUs['title'] ?? 'Kenapa pilih kami' }}
                </h2>
            </div>

            <div class="mt-14 grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($whyUs['reasons'] as $i => $reason)
                <div class="relative">
                    <div class="text-6xl font-black text-transparent bg-clip-text bg-gradient-to-br from-indigo-400 to-pink-400">
                        0{{ $i + 1 }}
                    </div>
                    <h3 class="mt-3 text-xl font-bold">{{ $reason['title'] ?? '' }}</h3>
                    <p class="mt-2 text-gray-400 leading-relaxed">{{ $reason['description'] ?? '' }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- =========== TESTIMONIALS =========== --}}
    @if (!empty($testimonials))
    <section class="py-20 px-6 bg-gradient-to-b from-indigo-50/30 to-white">
        <div class="max-w-6xl mx-auto">
            <div class="text-center max-w-2xl mx-auto">
                <span class="text-sm font-semibold text-indigo-600 uppercase tracking-wider">Testimoni</span>
                <h2 class="mt-3 text-3xl md:text-4xl font-bold text-gray-900">
                    Apa kata mereka
                </h2>
            </div>

            <div class="mt-14 grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($testimonials as $t)
                <div class="bg-white rounded-2xl p-6 ring-1 ring-gray-200 shadow-sm">
                    <div class="flex gap-0.5 text-yellow-400">
                        @for ($i = 0; $i < 5; $i++)
                        <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.49 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.755 4.635 1.123 6.545z"/></svg>
                        @endfor
                    </div>
                    <blockquote class="mt-4 text-gray-700 leading-relaxed">
                        "{{ $t['quote'] ?? '' }}"
                    </blockquote>
                    <div class="mt-5 flex items-center gap-3">
                        <div class="h-10 w-10 rounded-full bg-gradient-to-br from-indigo-500 to-pink-500 flex items-center justify-center text-white font-bold">
                            {{ Str::upper(Str::substr($t['name'] ?? 'A', 0, 1)) }}
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900">{{ $t['name'] ?? '' }}</p>
                            <p class="text-xs text-gray-500">{{ $t['role'] ?? '' }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- =========== PRICING =========== --}}
    @if ($pricing)
    <section id="pricing" class="py-20 px-6 bg-white">
        <div class="max-w-2xl mx-auto">
            <div class="text-center">
                <span class="text-sm font-semibold text-indigo-600 uppercase tracking-wider">Pricing</span>
                <h2 class="mt-3 text-3xl md:text-4xl font-bold text-gray-900">
                    {{ $pricing['title'] ?? 'Penawaran Spesial' }}
                </h2>
            </div>

            <div class="mt-12 relative rounded-3xl bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 p-1 shadow-2xl">
                <div class="rounded-3xl bg-white p-8 md:p-10">
                    <div class="text-center">
                        <p class="text-gray-500 text-sm uppercase tracking-wider font-semibold">{{ $salesPage->product_name }}</p>

                        <div class="mt-4 flex items-baseline justify-center gap-2">
                            @if (!empty($pricing['original_price']))
                            <span class="text-2xl text-gray-400 line-through">{{ $pricing['original_price'] }}</span>
                            @endif
                            <span class="text-5xl font-extrabold text-gray-900">{{ $pricing['price'] ?? '' }}</span>
                        </div>
                    </div>

                    @if (!empty($pricing['includes']))
                    <ul class="mt-8 space-y-3">
                        @foreach ($pricing['includes'] as $item)
                        <li class="flex items-start gap-3">
                            <svg class="h-5 w-5 text-green-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-700">{{ $item }}</span>
                        </li>
                        @endforeach
                    </ul>
                    @endif

                    <button class="mt-8 w-full rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-4 font-bold text-lg shadow-lg hover:shadow-xl hover:scale-[1.02] transition">
                        {{ $pricing['cta_text'] ?? 'Beli Sekarang' }}
                    </button>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- =========== FAQ =========== --}}
    @if (!empty($faqs))
    <section class="py-20 px-6 bg-gray-50">
        <div class="max-w-3xl mx-auto">
            <div class="text-center">
                <span class="text-sm font-semibold text-indigo-600 uppercase tracking-wider">FAQ</span>
                <h2 class="mt-3 text-3xl md:text-4xl font-bold text-gray-900">
                    Pertanyaan yang sering ditanya
                </h2>
            </div>

            <div class="mt-12 space-y-3">
                @foreach ($faqs as $faq)
                <details class="group bg-white rounded-xl ring-1 ring-gray-200 overflow-hidden">
                    <summary class="flex items-center justify-between cursor-pointer p-5 font-semibold text-gray-900 hover:bg-gray-50 list-none">
                        <span>{{ $faq['question'] ?? '' }}</span>
                        <svg class="h-5 w-5 text-gray-400 transition group-open:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </summary>
                    <div class="px-5 pb-5 text-gray-600 leading-relaxed">
                        {{ $faq['answer'] ?? '' }}
                    </div>
                </details>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- =========== FINAL CTA =========== --}}
    @if ($finalCta)
    <section class="py-24 px-6 bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 text-white text-center">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-3xl md:text-5xl font-extrabold tracking-tight">
                {{ $finalCta['headline'] ?? '' }}
            </h2>
            <p class="mt-5 text-lg text-indigo-100">
                {{ $finalCta['description'] ?? '' }}
            </p>
            <a href="#pricing"
               class="mt-10 inline-flex items-center gap-2 rounded-full bg-white text-indigo-700 px-10 py-5 text-lg font-bold shadow-2xl hover:scale-105 transition">
                {{ $finalCta['cta_text'] ?? 'Mulai Sekarang' }}
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </a>
        </div>
    </section>
    @endif

    {{-- =========== FOOTER =========== --}}
    <footer class="bg-gray-900 text-gray-400 py-8 px-6 text-center text-sm">
        &copy; {{ date('Y') }} {{ $salesPage->product_name }}. All rights reserved.
    </footer>

</body>
</html>
