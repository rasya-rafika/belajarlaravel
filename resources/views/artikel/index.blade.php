<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Artikel SafePaws') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Tombol tambah artikel hanya untuk user yang login -->
                    @auth
                        <a href="{{ route('artikel.create') }}" class="mb-4 inline-block px-6 py-3 bg-gradient-to-r from-orange-500 to-orange-400 text-white font-semibold rounded-md shadow-lg transform hover:scale-105 transition-all duration-200">+ Tambah Artikel</a>
                    @endauth

                    <!-- Grid layout untuk artikel -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mt-6">
                        @forelse ($artikels as $artikel)
                            <div class="bg-white rounded-lg shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105 p-6 border-2 border-orange-200">
                                <!-- Foto Artikel -->
                                @if($artikel->gambar)
                                    <img src="{{ asset('storage/'.$artikel->gambar) }}" alt="{{ $artikel->judul }}" class="w-full h-48 object-cover rounded-lg mb-4">
                                @else
                                    <div class="w-full h-48 bg-gray-300 rounded-lg mb-4 flex items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                        </svg>
                                    </div>
                                @endif
                                
                                <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $artikel->judul }}</h3>
                                <p class="text-gray-600 mb-4">{{ Str::limit($artikel->deskripsi, 120) }}</p>
                                
                                <div class="flex justify-between items-center mt-4">
                                    <a href="{{ $artikel->link_artikel }}" target="_blank" class="text-blue-500 hover:text-blue-700 font-semibold transition-all duration-300">Lihat Artikel</a>
                                    
                                    <!-- Aksi Edit dan Hapus hanya untuk user yang login dan memiliki akses -->
                                    @auth
                                        @if ($artikel->user_id == Auth::id() || Auth::user()->hasRole('admin'))
                                            <div class="flex space-x-4">
                                                <a href="{{ route('artikel.edit', $artikel->id) }}" class="text-yellow-500 hover:text-yellow-700 font-semibold">Edit</a>
                                                <form action="{{ route('artikel.destroy', $artikel->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:text-red-700 font-semibold">Hapus</button>
                                                </form>
                                            </div>
                                        @endif
                                    @endauth
                                </div>

                                <!-- Info penulis -->
                                @if($artikel->user)
                                    <div class="mt-2 text-sm text-gray-500">
                                        <span>Oleh: {{ $artikel->user->name }}</span>
                                    </div>
                                @endif
                            </div>
                        @empty
                            <p class="text-center text-gray-500 mt-4">Belum ada artikel.</p>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8">
                        {{ $artikels->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
