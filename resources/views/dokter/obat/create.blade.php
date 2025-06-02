<x-app-layout>
    {{-- Header halaman --}}
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Obat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white p-6 shadow sm:rounded-lg">
                {{-- Judul form --}}
                <header class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">Tambah Data Obat</h3>
                    <p class="text-sm text-gray-600 mt-1">
                        Silakan isi form berikut untuk menambahkan data obat.
                    </p>
                </header>

                {{-- Error validasi --}}
                @if ($errors->any())
                    <div class="mb-4 p-4 text-sm text-red-800 bg-red-100 border border-red-200 rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Form tambah data obat --}}
                <form action="{{ route('dokter.obat.store') }}" method="POST" class="space-y-5">
                    @csrf

                    {{-- Input Nama Obat --}}
                    <div>
                        <label for="namaObat" class="block text-sm font-medium text-gray-700">Nama Obat</label>
                        <input type="text" name="nama_obat" id="namaObat"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                               value="{{ old('nama_obat') }}">
                    </div>

                    {{-- Input Kemasan --}}
                    <div>
                        <label for="kemasan" class="block text-sm font-medium text-gray-700">Kemasan</label>
                        <input type="text" name="kemasan" id="kemasan"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                               value="{{ old('kemasan') }}">
                    </div>

                    {{-- Input Harga --}}
                    <div>
                        <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
                        <input type="number" name="harga" id="harga"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                               value="{{ old('harga') }}">
                    </div>

                    {{-- Tombol aksi: batal dan simpan --}}
                    <div class="flex justify-between items-center mt-6">
                        <a href="{{ route('dokter.obat.index') }}"
                           class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded hover:bg-gray-200">
                            Batal
                        </a>
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
