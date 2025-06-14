<x-app-layout>
    {{-- Header halaman --}}
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Memeriksa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-6 bg-white shadow sm:rounded-lg">
                {{-- Judul --}}
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Daftar Periksa Pasien</h3>
                </div>

                {{-- Tabel --}}
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left border border-gray-200 table-auto">
                        <thead class="text-xs text-white uppercase bg-gray-700">
                            <tr>
                                <th class="px-4 py-3">No Urut</th>
                                <th class="px-4 py-3">Nama Pasien</th>
                                <th class="px-4 py-3">Keluhan</th>
                                <th class="px-4 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($janjiPeriksas as $janjiPeriksa)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-4 py-2">{{ $janjiPeriksa->no_antrian }}</td>
                                    <td class="px-4 py-2">{{ $janjiPeriksa->pasien->nama }}</td>
                                    <td class="px-4 py-2">{{ $janjiPeriksa->keluhan }}</td>
                                    <td class="px-4 py-2">
                                        @if (is_null($janjiPeriksa->periksa))
                                            <a href="{{ route('dokter.memeriksa.periksa', $janjiPeriksa->id) }}"
                                               class="inline-block px-3 py-1 text-xs font-medium text-white bg-blue-600 rounded hover:bg-blue-700">
                                                Periksa
                                            </a>
                                        @else
                                            <a href="{{ route('dokter.memeriksa.edit', $janjiPeriksa->id) }}"
                                               class="inline-block px-3 py-1 text-xs font-medium text-white bg-gray-600 rounded hover:bg-gray-700">
                                                Edit
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-4 text-center text-gray-500">Tidak ada pasien dalam daftar periksa.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
