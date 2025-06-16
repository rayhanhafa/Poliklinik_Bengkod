<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Obat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-6 bg-white shadow sm:rounded-lg">
                {{-- Header --}}
                <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Daftar Obat Terhapus</h3>

                <a href="{{ route('dokter.obat.index') }}"
                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-gray-600 rounded-lg shadow hover:bg-gray-700 transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Kembali
                </a>
            </div>


                {{-- Flash Messages --}}
                @if (session('success'))
                    <div class="relative p-4 mb-4 text-sm text-green-800 bg-green-100 border border-green-200 rounded">
                        {{ session('success') }}
                        <button type="button" onclick="this.parentElement.remove();"
                                class="absolute top-2 right-2 text-green-800 hover:text-green-900">
                            &times;
                        </button>
                    </div>
                @endif

                @if (session('danger'))
                    <div class="relative p-4 mb-4 text-sm text-red-800 bg-red-100 border border-red-200 rounded">
                        {{ session('danger') }}
                        <button type="button" onclick="this.parentElement.remove();"
                                class="absolute top-2 right-2 text-red-800 hover:text-red-900">
                            &times;
                        </button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="relative p-4 mb-4 text-sm text-red-800 bg-red-100 border border-red-200 rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" onclick="this.parentElement.remove();"
                                class="absolute top-2 right-2 text-red-800 hover:text-red-900">
                            &times;
                        </button>
                    </div>
                @endif

                {{-- Table --}}
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left border border-gray-200 table-auto">
                        <thead class="text-xs text-white uppercase bg-gray-700">
                            <tr>
                                <th class="px-4 py-3">No</th>
                                <th class="px-4 py-3">Nama Obat</th>
                                <th class="px-4 py-3">Kemasan</th>
                                <th class="px-4 py-3">Harga</th>
                                <th class="px-4 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($obats as $index => $obat)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-4 py-2">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2">{{ $obat->nama_obat }}</td>
                                    <td class="px-4 py-2">{{ $obat->kemasan }}</td>
                                    <td class="px-4 py-2">Rp {{ number_format($obat->harga, 0, ',', '.') }}</td>
                                    <td class="px-4 py-2 space-x-2">
                                        <!-- Tombol Restore -->
                                        <form action="{{ route('dokter.obat.restore', $obat->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="px-3 py-1 text-xs font-medium text-white bg-green-600 rounded hover:bg-green-700 transition">
                                                Restore
                                            </button>
                                        </form>

                                        <!-- Tombol Hapus Permanen -->
                                        <form action="{{ route('dokter.obat.force-delete', $obat->id) }}" method="POST"
                                            class="inline-block"
                                            onsubmit="return confirm('Yakin ingin menghapus permanen?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-3 py-1 text-xs font-medium text-white bg-red-600 rounded hover:bg-red-700 transition">
                                                Hapus Permanen
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-4 text-center text-gray-500">
                                        Tidak ada data obat.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
