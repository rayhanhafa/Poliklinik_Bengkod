<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-gradient-to-r from-gray-50 via-white to-gray-50 overflow-hidden shadow-xl sm:rounded-lg">
        <div class="p-8 text-gray-900">
            <h1 class="text-3xl font-extrabold text-gray-800 mb-2">
                You're logged in! Welcome, {{ Auth::user()->nama }}!
            </h1>

            @if(Auth::user()->polis)
                <div class="mt-4">
                    <h2 class="text-xl font-semibold text-gray-700">
                        Poli: {{ Auth::user()->polis->nama_poli }}
                    </h2>
                    <p class="mt-2 text-gray-700 leading-relaxed">
                        {{ Auth::user()->polis->deskripsi }}
                    </p>
                </div>
            @else
                <p class="mt-4 text-gray-500 italic">
                    Kamu belum terdaftar pada poli manapun.
                </p>
            @endif
        </div>
    </div>
</div>

    </div>
</x-app-layout>
