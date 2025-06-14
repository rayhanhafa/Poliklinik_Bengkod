<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            {{ __('Janji Periksa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                {{-- Header --}}
                <header class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">
                        {{ __('Buat Janji Periksa') }}
                    </h3>
                    <p class="mt-1 text-sm text-gray-600">
                        {{ __('Atur jadwal konsultasi dan pemeriksaan sesuai kebutuhan Anda.') }}
                    </p>
                </header>

                {{-- Notifikasi sukses --}}
                @if (session('status') === 'janji-periksa-created')
                    <div x-data="{ show: true }" x-show="show" x-transition
                         class="flex items-center justify-between p-4 mb-6 text-sm text-green-800 bg-green-100 border border-green-200 rounded-lg">
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" stroke-width="2"
                                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M9 12l2 2l4 -4M12 20c4.418 0 8 -3.582 8 -8s-3.582 -8 -8 -8s-8 3.582 -8 8s3.582 8 8 8z"></path>
                            </svg>
                            <span>{{ __('Janji berhasil dibuat.') }}</span>
                        </div>
                        <button @click="show = false" class="text-green-600 hover:text-green-800">
                            &times;
                        </button>
                    </div>
                @endif

                {{-- Formulir --}}
                <form action="{{ route('pasien.janji-periksa.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label for="no_rm" class="block text-sm font-medium text-gray-700">Nomor Rekam Medis</label>
                        <input type="text" id="no_rm" class="mt-1 block w-full rounded-md shadow-sm border-gray-300 bg-gray-100" value="{{ $no_rm }}" readonly>
                    </div>

                    <div>
                        <label for="dokterSelect" class="block text-sm font-medium text-gray-700">Dokter & Jadwal</label>
                        <select name="id_dokter" id="dokterSelect" required class="mt-1 block w-full rounded-md shadow-sm border-gray-300">
                            <option disabled selected>Pilih Dokter</option>
                            @foreach ($dokters as $dokter)
                                @foreach ($dokter->jadwalPeriksas as $jadwal)
                                    <option value="{{ $dokter->id }}">
                                        {{ $dokter->nama }} - {{ $dokter->poli }} | {{ $jadwal->hari }},
                                        {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} -
                                        {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}
                                    </option>
                                @endforeach
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="keluhan" class="block text-sm font-medium text-gray-700">Keluhan</label>
                        <textarea id="keluhan" name="keluhan" rows="3" class="mt-1 block w-full rounded-md shadow-sm border-gray-300" required></textarea>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
