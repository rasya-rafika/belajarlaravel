<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Adopsi Hewan SafePaws') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Tombol tambah adopsi hanya untuk admin -->
                    @auth
                        @if (Auth::user()->hasRole('admin'))
                            <a href="{{ route('adopsi.create') }}" class="mb-4 inline-block px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">+ Tambah Adopsi</a>
                        @endif
                    @endauth

                    <!-- Grid layout untuk hewan adopsi -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
                        @forelse ($adopsis as $adopsi)
                            <div class="bg-orange-100 rounded-lg shadow-lg p-4">
                                <!-- Foto Hewan -->
                                @if($adopsi->gambar)
                                    <img src="{{ asset('storage/'.$adopsi->gambar) }}" alt="{{ $adopsi->nama_hewan }}" class="w-full h-48 object-cover rounded-lg mb-4">
                                @else
                                    <div class="w-full h-48 bg-gray-300 rounded-lg mb-4 flex items-center justify-center">
                                        <span class="text-gray-500">No Image</span>
                                    </div>
                                @endif

                                <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $adopsi->nama_hewan }}</h3>
                                <p class="text-gray-600 mb-2">Umur: {{ $adopsi->umur }} Tahun</p>
                                <p class="text-gray-600 mb-2">Jenis Kelamin: {{ $adopsi->jenis_kelamin }}</p>
                                
                                <!-- New Fields: Status and Jenis Hewan -->
                                <p class="text-gray-600 mb-2">Jenis Hewan: {{ $adopsi->jenis_hewan }}</p>
                                <p class="text-gray-600 mb-4">Status: 
                                    <span class="font-semibold 
                                        @if($adopsi->status == 'tersedia') text-green-600 
                                        @elseif($adopsi->status == 'proses') text-yellow-600 
                                        @else text-red-600 @endif">
                                        {{ ucfirst($adopsi->status) }}
                                    </span>
                                </p>
                                
                                <p class="text-gray-600 mb-4">{{ Str::limit($adopsi->deskripsi, 100) }}</p>

                                <!-- Tombol aksi -->
                                <div class="flex flex-wrap gap-2 mt-4">
                                    <!-- Tombol Lihat Detail (untuk semua user) -->
                                    <a href="{{ route('adopsi.show', $adopsi->id) }}" class="px-3 py-2 bg-blue-500 text-white text-sm rounded-md hover:bg-blue-600 transition duration-200">
                                        Lihat Detail
                                    </a>
                                    
                                    @auth
                                        @if (Auth::user()->hasRole('admin'))
                                            <!-- Tombol Edit untuk Admin -->
                                            <a href="{{ route('adopsi.edit', $adopsi->id) }}" class="px-3 py-2 bg-yellow-500 text-white text-sm rounded-md hover:bg-yellow-600 transition duration-200">
                                                Edit
                                            </a>
                                            
                                            <!-- Tombol Delete untuk Admin -->
                                            <form action="{{ route('adopsi.destroy', $adopsi->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus hewan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-3 py-2 bg-red-500 text-white text-sm rounded-md hover:bg-red-600 transition duration-200">
                                                    Delete
                                                </button>
                                            </form>
                                        @else
                                            <!-- Tombol Adopsi untuk User biasa -->
                                            <a href="{{ route('adopsi.adopt', $adopsi->id) }}" class="px-3 py-2 bg-green-500 text-white text-sm rounded-md hover:bg-green-600 transition duration-200">
                                                Adopsi
                                            </a>
                                        @endif
                                    @else
                                        <!-- Tombol Adopsi untuk Guest (mengarah ke login) -->
                                        <a href="{{ route('login') }}" class="px-3 py-2 bg-green-500 text-white text-sm rounded-md hover:bg-green-600 transition duration-200">
                                            Adopsi
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-8">
                                <p class="text-gray-500 text-lg">Belum ada hewan yang tersedia untuk diadopsi.</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8">
                        {{ $adopsis->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
