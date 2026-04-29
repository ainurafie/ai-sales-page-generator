<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    Sales Pages
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Kelola hasil AI sales page yang sudah dibuat.
                </p>
            </div>

            <a href="{{ route('sales-pages.create') }}"
                class="inline-flex items-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                + Buat Sales Page
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-200">
                <div class="border-b border-gray-200 px-6 py-5">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Daftar Sales Page
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Klik lihat untuk membuka hasil generate AI.
                    </p>
                </div>

                @if ($salesPages->isEmpty())
                    <div class="px-6 py-16 text-center">
                        <h3 class="text-base font-semibold text-gray-900">
                            Belum ada sales page
                        </h3>
                        <p class="mt-2 text-sm text-gray-500">
                            Mulai dengan membuat sales page pertama kamu.
                        </p>

                        <div class="mt-6">
                            <a href="{{ route('sales-pages.create') }}"
                                class="inline-flex items-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700">
                                Buat Sales Page
                            </a>
                        </div>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                        Produk
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                        Target Audience
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                        Harga
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach ($salesPages as $salesPage)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $salesPage->product_name ?: '-' }}
                                            </div>
                                            <div class="mt-1 max-w-xl truncate text-sm text-gray-500">
                                                {{ Str::limit($salesPage->description, 60) }}
                                            </div>
                                        </td>

                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900">
                                                {{ $salesPage->target_audience ?: '-' }}
                                            </div>
                                        </td>

                                        <td class="whitespace-nowrap px-6 py-4">
                                            <span
                                                class="inline-flex rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-700">
                                                {{ $salesPage->price ?: '-' }}
                                            </span>
                                        </td>

                                        <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                                            <a href="{{ route('sales-pages.show', $salesPage) }}"
                                                class="inline-flex items-center rounded-md border border-gray-300 bg-white px-3 py-1.5 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50">
                                                Lihat
                                            </a>

                                            <form action="{{ route('sales-pages.destroy', $salesPage) }}" method="POST"
                                                class="inline-block"
                                                onsubmit="return confirm('Yakin ingin menghapus sales page ini?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="ml-2 inline-flex items-center rounded-md border border-red-200 bg-red-50 px-3 py-1.5 text-sm font-medium text-red-700 hover:bg-red-100">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
