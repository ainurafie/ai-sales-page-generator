<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'SalesAI') }} — Generate sales page dengan AI</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Inter', system-ui, sans-serif; }
    </style>
</head>
<body class="antialiased bg-white text-gray-900">

    {{-- ================= NAV ================= --}}
    <nav class="border-b border-gray-100">
        <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="/" class="flex items-center gap-2 font-semibold text-gray-900">
                <span class="h-7 w-7 rounded-md bg-gray-900 flex items-center justify-center">
                    <svg class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </span>
                SalesAI
            </a>

            <div class="flex items-center gap-6 text-sm">
                <a href="#features" class="text-gray-600 hover:text-gray-900 hidden sm:inline">Fitur</a>
                <a href="#how" class="text-gray-600 hover:text-gray-900 hidden sm:inline">Cara kerja</a>

                @auth
                    <a href="{{ route('sales-pages.index') }}"
                       class="rounded-md bg-gray-900 text-white px-4 py-1.5 font-medium hover:bg-gray-800 transition">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}"
                       class="rounded-md bg-gray-900 text-white px-4 py-1.5 font-medium hover:bg-gray-800 transition">
                        Mulai gratis
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- ================= HERO ================= --}}
    <section class="px-6 pt-20 pb-24">
        <div class="max-w-3xl mx-auto text-center">
            <span class="inline-flex items-center gap-2 rounded-full border border-gray-200 bg-gray-50 px-3 py-1 text-xs font-medium text-gray-600">
                <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>
                Powered by AI
            </span>

            <h1 class="mt-6 text-4xl md:text-5xl lg:text-6xl font-bold tracking-tight text-gray-900 leading-[1.1]">
                Generate sales page dalam <span class="text-indigo-600">hitungan detik</span>
            </h1>

            <p class="mt-6 text-lg text-gray-600 leading-relaxed max-w-xl mx-auto">
                Cukup isi info produkmu, AI akan menyusun sales page lengkap —
                dari headline, fitur, testimoni, sampai pricing.
            </p>

            <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-3">
                @auth
                    <a href="{{ route('sales-pages.create') }}"
                       class="inline-flex items-center gap-2 rounded-md bg-gray-900 text-white px-5 py-2.5 text-sm font-semibold hover:bg-gray-800 transition">
                        Buat sales page
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                @else
                    <a href="{{ route('register') }}"
                       class="inline-flex items-center gap-2 rounded-md bg-gray-900 text-white px-5 py-2.5 text-sm font-semibold hover:bg-gray-800 transition">
                        Mulai gratis
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                    <a href="#features"
                       class="inline-flex items-center gap-1 rounded-md border border-gray-200 bg-white text-gray-700 px-5 py-2.5 text-sm font-semibold hover:bg-gray-50 transition">
                        Lihat fitur
                    </a>
                @endauth
            </div>

            <p class="mt-6 text-xs text-gray-500">
                Gratis dipakai &middot; Tanpa kartu kredit
            </p>
        </div>
    </section>

    {{-- ================= FEATURES ================= --}}
    <section id="features" class="px-6 py-20 border-t border-gray-100">
        <div class="max-w-5xl mx-auto">
            <div class="max-w-xl">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900">
                    Semua yang kamu butuhkan
                </h2>
                <p class="mt-3 text-gray-600">
                    Tools sederhana yang fokus pada satu hal: bantu kamu bikin sales page yang convert.
                </p>
            </div>

            <div class="mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-10">
                @php
                    $features = [
                        ['icon' => 'M13 10V3L4 14h7v7l9-11h-7z', 'title' => 'AI Copywriter', 'desc' => 'Copy persuasif yang dibuat dengan training khusus marketing dan psikologi penjualan.'],
                        ['icon' => 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z', 'title' => 'Bahasa Indonesia', 'desc' => 'Hasil natural dalam bahasa Indonesia. Bukan terjemahan kaku.'],
                        ['icon' => 'M3 3v18h18M9 17V9m4 8V5m4 12v-7', 'title' => '10+ Section', 'desc' => 'Hero, problem, solution, fitur, benefit, testimoni, pricing, FAQ — otomatis.'],
                        ['icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'title' => 'Cepat', 'desc' => 'Generate dalam ~10 detik. Tidak perlu nunggu lama.'],
                        ['icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z', 'title' => 'Desain rapi', 'desc' => 'Template landing page modern dengan typography profesional.'],
                        ['icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2', 'title' => 'Tersimpan otomatis', 'desc' => 'Semua sales page tersimpan di akunmu. Akses kapan saja.'],
                    ];
                @endphp

                @foreach ($features as $f)
                    <div>
                        <div class="h-9 w-9 rounded-md bg-gray-100 flex items-center justify-center text-gray-700">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $f['icon'] }}" />
                            </svg>
                        </div>
                        <h3 class="mt-4 font-semibold text-gray-900">{{ $f['title'] }}</h3>
                        <p class="mt-1.5 text-sm text-gray-600 leading-relaxed">{{ $f['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ================= HOW IT WORKS ================= --}}
    <section id="how" class="px-6 py-20 bg-gray-50 border-t border-gray-100">
        <div class="max-w-5xl mx-auto">
            <div class="max-w-xl">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900">
                    Cara kerja
                </h2>
                <p class="mt-3 text-gray-600">
                    Tiga langkah, sales page kamu siap.
                </p>
            </div>

            <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-8">
                @php
                    $steps = [
                        ['num' => '1', 'title' => 'Isi info produk', 'desc' => 'Masukkan nama produk, deskripsi, fitur, target audience, dan harga.'],
                        ['num' => '2', 'title' => 'AI generate', 'desc' => 'AI memproses datamu dan menyusun sales page lengkap.'],
                        ['num' => '3', 'title' => 'Pakai & bagikan', 'desc' => 'Sales page siap. Copy konten atau bagikan ke customer.'],
                    ];
                @endphp

                @foreach ($steps as $s)
                    <div class="bg-white rounded-lg border border-gray-200 p-6">
                        <div class="h-7 w-7 rounded-full bg-gray-900 text-white text-sm font-semibold flex items-center justify-center">
                            {{ $s['num'] }}
                        </div>
                        <h3 class="mt-4 font-semibold text-gray-900">{{ $s['title'] }}</h3>
                        <p class="mt-1.5 text-sm text-gray-600 leading-relaxed">{{ $s['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ================= CTA ================= --}}
    <section class="px-6 py-20 border-t border-gray-100">
        <div class="max-w-2xl mx-auto text-center">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900">
                Siap bikin sales page pertamamu?
            </h2>
            <p class="mt-3 text-gray-600">
                Gratis dipakai. Tidak butuh kartu kredit.
            </p>

            <div class="mt-8">
                @auth
                    <a href="{{ route('sales-pages.create') }}"
                       class="inline-flex items-center gap-2 rounded-md bg-gray-900 text-white px-5 py-2.5 text-sm font-semibold hover:bg-gray-800 transition">
                        Buat sekarang
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                @else
                    <a href="{{ route('register') }}"
                       class="inline-flex items-center gap-2 rounded-md bg-gray-900 text-white px-5 py-2.5 text-sm font-semibold hover:bg-gray-800 transition">
                        Mulai gratis
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                @endauth
            </div>
        </div>
    </section>

    {{-- ================= FOOTER ================= --}}
    <footer class="border-t border-gray-100 px-6 py-8">
        <div class="max-w-6xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-3 text-sm text-gray-500">
            <div class="flex items-center gap-2">
                <span class="h-5 w-5 rounded bg-gray-900 flex items-center justify-center">
                    <svg class="h-3 w-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </span>
                <span class="font-medium text-gray-900">SalesAI</span>
            </div>
            <p>&copy; {{ date('Y') }} SalesAI. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
