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
                        <a href="{{ route('artikel.create') }}" class="mb-4 inline-block px-4 py-2 bg-blue-600 text-white rounded-md">+ Tambah Artikel</a>
                    @endauth

                    <!-- Grid layout untuk artikel -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
                        @forelse ($artikels as $artikel)
                            <div class="bg-orange-100 rounded-lg shadow-lg p-4">
                                <!-- Foto Artikel -->
                                @if($artikel->gambar)
                                    <img src="{{ asset('storage/'.$artikel->gambar) }}" alt="{{ $artikel->judul }}" class="w-full h-48 object-cover rounded-lg mb-4">
                                @else
                                    <div class="w-full h-48 bg-gray-300 rounded-lg mb-4"></div> <!-- Placeholder jika tidak ada gambar -->
                                @endif
                                
                                <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $artikel->judul }}</h3>
                                <p class="text-gray-600 mb-2">{{ Str::limit($artikel->deskripsi, 100) }}</p>
                                
                                <div class="flex justify-between items-center mt-4">
                                    <a href="{{ $artikel->link_artikel }}" target="_blank" class="text-blue-500 hover:text-blue-700">Lihat Artikel</a>
                                    
                                    <!-- Aksi Edit dan Hapus hanya untuk user yang login dan memiliki akses -->
                                    @auth
                                        @if ($artikel->user_id == Auth::id() || Auth::user()->hasRole('admin'))
                                            <div class="flex space-x-2">
                                                <a href="{{ route('artikel.edit', $artikel->id) }}" class="text-yellow-500 hover:text-yellow-700">Edit</a>
                                                <form action="{{ route('artikel.destroy', $artikel->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:text-red-700">Hapus</button>
                                                </form>
                                            </div>
                                        @endif
                                    @endauth
                                </div>

                                <!-- Info penulis -->
                                @if($artikel->user)
                                    <div class="mt-2 text-sm text-gray-500">
                                        Oleh: {{ $artikel->user->name }}
                                    </div>
                                @endif
                            </div>
                        @empty
                            <p class="text-center text-gray-500 mt-4">Belum ada artikel.</p>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    {{ $artikels->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>