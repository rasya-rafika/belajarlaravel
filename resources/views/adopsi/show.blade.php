<!-- resources/views/adopsi/show.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Hewan: ') }} {{ $adopsi->nama_hewan }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex">
                <div class="w-1/2 pr-4">
                    @if($adopsi->gambar)
                        <img src="{{ asset('storage/'.$adopsi->gambar) }}" alt="{{ $adopsi->nama_hewan }}" class="w-full h-72 object-cover rounded-lg">
                    @else
                        <div class="w-full h-72 bg-gray-300 rounded-lg"></div>
                    @endif
                </div>
                <div class="w-1/2 pl-4">
                    <h3 class="text-2xl font-semibold text-gray-800">{{ $adopsi->nama_hewan }}</h3>
                    <p class="text-sm text-gray-600 mt-2">{{ $adopsi->deskripsi }}</p>
                    <p class="text-sm text-gray-500">Jenis Kelamin: {{ $adopsi->jenis_kelamin }}</p>
                    <p class="text-sm text-gray-500">Umur: {{ $adopsi->umur }} tahun</p>
                    @auth
                        <a href="{{ route('adopsi.adopt', $adopsi->id) }}" class="mt-4 inline-block px-4 py-2 bg-green-600 text-white rounded-md">Ajukan Adopsi</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
