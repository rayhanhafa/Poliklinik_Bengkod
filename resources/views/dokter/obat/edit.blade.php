<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Obat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white p-6 shadow sm:rounded-lg">
                <header class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">Edit Data Obat</h3>
                    <p class="text-sm text-gray-600 mt-1">
                        Silakan perbarui informasi obat sesuai dengan nama, kemasan, dan harga terbaru.
                    </p>
                </header>

                {{-- Validasi error --}}
                @if ($errors->any())
                    <div class="mb-4 p-4 text-sm text-red-800 bg-red-100 border border-red-200 rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Form update obat --}}
                <form action="{{ route('dokter.obat.update', $obat->id) }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')

                    {{-- Nama Obat --}}
                    <div>
                        <label for="editNamaObatInput" class="block text-sm font-medium text-gray-700">Nama Obat</label>
                        <input type="text" id="editNamaObatInput" name="nama_obat"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                               value="{{ old('nama_obat', $obat->nama_obat) }}">
                    </div>

                    {{-- Kemasan --}}
                    <div>
                        <label for="editKemasanInput" class="block text-sm font-medium text-gray-700">Kemasan</label>
                        <input type="text" id="editKemasanInput" name="kemasan"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                               value="{{ old('kemasan', $obat->kemasan) }}">
                    </div>

                    {{-- Harga --}}
                    <div>
                        <label for="editHargaInput" class="block text-sm font-medium text-gray-700">Harga</label>
                        <input type="number" id="editHargaInput" name="harga"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                               value="{{ old('harga', $obat->harga) }}">
                    </div>

                    {{-- Tombol aksi --}}
                    <div class="flex justify-between items-center mt-6">
                        <a href="{{ route('dokter.obat.index') }}"
                           class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded hover:bg-gray-200">
                            Batal
                        </a>
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
