<x-app-layout>
    {{-- Bagian Header Halaman --}}
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Jadwal Periksa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white p-6 shadow sm:rounded-lg">
                {{-- Judul dan Deskripsi Form --}}
                <header class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">Tambah Jadwal Periksa</h3>
                    <p class="text-sm text-gray-600 mt-1">
                        Silakan isi form berikut sesuai jadwal dokter yang tersedia.
                    </p>
                </header>

                {{-- Menampilkan pesan error validasi jika ada --}}
                @if ($errors->any())
                    <div class="mb-4 p-4 text-sm text-red-800 bg-red-100 border border-red-200 rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Form input jadwal periksa --}}
                <form action="{{ route('dokter.jadwal-periksa.store') }}" method="POST" class="space-y-5">
                    @csrf

                    {{-- Dropdown Pilih Hari --}}
                    <div>
                        <label for="hariSelect" class="block text-sm font-medium text-gray-700">Hari</label>
                        <select name="hari" id="hariSelect" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Pilih Hari</option>
                            @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $hari)
                                <option value="{{ $hari }}" {{ old('hari') == $hari ? 'selected' : '' }}>{{ $hari }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Input Jam Mulai --}}
                    <div>
                        <label for="jamMulai" class="block text-sm font-medium text-gray-700">Jam Mulai</label>
                        <input type="time" name="jam_mulai" id="jamMulai"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                               value="{{ old('jam_mulai') }}">
                    </div>

                    {{-- Input Jam Selesai --}}
                    <div>
                        <label for="jamSelesai" class="block text-sm font-medium text-gray-700">Jam Selesai</label>
                        <input type="time" name="jam_selesai" id="jamSelesai"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                               value="{{ old('jam_selesai') }}">
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="flex justify-between items-center mt-6">
                        {{-- Tombol Batal: Kembali ke halaman index --}}
                        <a href="{{ route('dokter.jadwal-periksa.index') }}"
                           class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded hover:bg-gray-200">
                            Batal
                        </a>

                        {{-- Tombol Simpan --}}
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
