<x-app-layout>
    {{-- Header halaman --}}
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Pemeriksaan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-6 bg-white shadow sm:rounded-lg">
                {{-- Judul --}}
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">Form Edit Pemeriksaan Pasien</h3>
                    <p class="text-sm text-gray-600">
                        Perbarui data hasil pemeriksaan dan obat yang diberikan kepada pasien.
                    </p>
                </div>

                {{-- Form --}}
                <form action="{{ route('dokter.memeriksa.update', $janjiPeriksa->periksa->id) }}" method="POST" id="formEdit">
                    @csrf
                    @method('PATCH')

                    <div class="mb-4">
                        <label for="editNamaInput" class="block text-sm font-medium text-gray-700">Nama Pasien</label>
                        <input type="text" id="editNamaInput" class="w-full mt-1 rounded-md shadow-sm border-gray-300" value="{{ $janjiPeriksa->pasien->nama }}" readonly>
                    </div>

                    <div class="mb-4">
                        <label for="edit_tgl_periksa" class="block text-sm font-medium text-gray-700">Tanggal Periksa</label>
                        <input type="datetime-local" id="edit_tgl_periksa" name="tgl_periksa"
                            value="{{ date('Y-m-d\TH:i', strtotime($janjiPeriksa->periksa->tgl_periksa)) }}"
                            class="w-full mt-1 rounded-md shadow-sm border-gray-300" required>
                    </div>

                    <div class="mb-4">
                        <label for="edit_catatan" class="block text-sm font-medium text-gray-700">Catatan</label>
                        <textarea id="edit_catatan" name="catatan" rows="3" class="w-full mt-1 rounded-md shadow-sm border-gray-300">{{ $janjiPeriksa->periksa->catatan }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="edit_obat" class="block text-sm font-medium text-gray-700">Pilih Obat</label>
                        <select id="edit_obat" name="obat[]" multiple onchange="hitungEditBiaya()"
                            class="w-full mt-1 rounded-md shadow-sm border-gray-300">
                            @foreach ($obats as $obat)
                                <option value="{{ $obat->id }}" data-harga="{{ $obat->harga }}"
                                    {{ in_array($obat->id, $janjiPeriksa->periksa->detailPeriksas->pluck('id_obat')->toArray()) ? 'selected' : '' }}>
                                    {{ $obat->nama_obat }} - {{ $obat->kemasan }} (Rp {{ number_format($obat->harga, 0, ',', '.') }})
                                </option>
                            @endforeach
                        </select>
                        <p class="mt-1 text-sm text-gray-500">Gunakan Ctrl (Windows) atau Command (Mac) untuk memilih lebih dari satu.</p>
                    </div>

                    <div class="mb-6">
                        <label for="edit_biaya_periksa" class="block text-sm font-medium text-gray-700">Biaya Pemeriksaan (Rp)</label>
                        <input type="text" id="edit_biaya_periksa" name="biaya_periksa" readonly
                            value="{{ $janjiPeriksa->periksa->biaya_periksa }}"
                            class="w-full mt-1 rounded-md shadow-sm border-gray-300">
                    </div>

                    {{-- Tombol --}}
                    <div class="flex justify-end gap-3">
                        <a href="{{ route('dokter.memeriksa.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-300">
                            Batal
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700">
                            Update
                        </button>
                    </div>
                </form>

                {{-- Script hitung biaya --}}
                <script>
                    function hitungEditBiaya() {
                        const baseBiaya = 150000;
                        let totalBiaya = baseBiaya;
                        const select = document.getElementById('edit_obat');
                        const selectedOptions = Array.from(select.selectedOptions);

                        selectedOptions.forEach(option => {
                            const harga = parseInt(option.getAttribute('data-harga')) || 0;
                            totalBiaya += harga;
                        });

                        document.getElementById('edit_biaya_periksa').value = totalBiaya;
                    }

                    document.addEventListener('DOMContentLoaded', hitungEditBiaya);
                </script>
            </div>
        </div>
    </div>
</x-app-layout>
