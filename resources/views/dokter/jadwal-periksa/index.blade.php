<x-app-layout>
    {{-- Header halaman --}}
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Jadwal Periksa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-6 bg-white shadow sm:rounded-lg">
                {{-- Judul dan tombol tambah jadwal --}}
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Daftar Jadwal Periksa</h3>

                    <a href="{{ route('dokter.jadwal-periksa.create') }}"
                    class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700 transition-all duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                        </svg>
                        Tambah Jadwal
                    </a>
                </div>


                {{-- Menampilkan flash message sukses --}}
                @if (session('success'))
                    <div class="relative p-4 mb-4 text-sm text-green-800 bg-green-100 border border-green-200 rounded">
                        {{ session('success') }}
                        <button type="button" onclick="this.parentElement.remove();"
                                class="absolute top-2 right-2 text-green-800 hover:text-green-900">
                            &times;
                        </button>
                    </div>
                @endif

                {{-- Menampilkan flash message error --}}
                @if (session('danger'))
                    <div class="relative p-4 mb-4 text-sm text-red-800 bg-red-100 border border-red-200 rounded">
                        {{ session('danger') }}
                        <button type="button" onclick="this.parentElement.remove();"
                                class="absolute top-2 right-2 text-red-800 hover:text-red-900">
                            &times;
                        </button>
                    </div>
                @endif

                {{-- Menampilkan error validasi --}}
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

                {{-- Tabel daftar jadwal periksa --}}
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left border border-gray-200 table-auto">
                        <thead class="text-xs text-white uppercase bg-gray-700">
                            <tr>
                                <th class="px-4 py-3">No</th>
                                <th class="px-4 py-3">Hari</th>
                                <th class="px-4 py-3">Mulai</th>
                                <th class="px-4 py-3">Selesai</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Looping jadwal, tampilkan data --}}
                            @forelse ($jadwalPeriksas as $index => $jadwalPeriksa)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-4 py-2">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2">{{ $jadwalPeriksa->hari }}</td>
                                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($jadwalPeriksa->jam_mulai)->format('H.i') }}</td>
                                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($jadwalPeriksa->jam_selesai)->format('H.i') }}</td>
                                    <td class="px-4 py-2">
                                        {{-- Status jadwal: aktif atau nonaktif --}}
                                        @if ($jadwalPeriksa->status)
                                            <span class="inline-block px-2 py-1 text-xs font-semibold text-green-800 bg-green-200 rounded">Aktif</span>
                                        @else
                                            <span class="inline-block px-2 py-1 text-xs font-semibold text-red-800 bg-red-200 rounded">Nonaktif</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2 space-x-2">
                                        {{-- Form tombol toggle status aktif/nonaktif --}}
                                        <form action="{{ route('dokter.jadwal-periksa.update', $jadwalPeriksa->id) }}"
                                              method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                    class="inline-block px-3 py-1 text-xs font-medium text-white rounded {{ $jadwalPeriksa->status ? 'bg-red-500 hover:bg-red-600' : 'bg-green-500 hover:bg-green-600' }}">
                                                {{ $jadwalPeriksa->status ? 'Nonaktifkan' : 'Aktifkan' }}
                                            </button>
                                        </form>

                                        {{-- Form tombol hapus jadwal --}}
                                        <form action="{{ route('dokter.jadwal-periksa.destroy', $jadwalPeriksa->id) }}"
                                              method="POST" class="inline"
                                              onsubmit="return confirm('Yakin ingin menghapus jadwal ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="inline-block px-3 py-1 text-xs font-medium text-white bg-red-600 rounded hover:bg-red-700">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            {{-- Jika data kosong, tampilkan pesan --}}
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-4 text-center text-gray-500">Belum ada jadwal periksa.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
