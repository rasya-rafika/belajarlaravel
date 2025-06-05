<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Artikel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($artikel->user_id === Auth::id() || Auth::user()->hasRole('admin'))
                        <!-- Jika artikel milik user yang login atau admin, tampilkan form -->
                        <form action="{{ route('artikel.update', $artikel->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label for="judul" class="block text-sm font-medium text-gray-700">Judul</label>
                                <input type="text" name="judul" id="judul" class="mt-1 block w-full" value="{{ $artikel->judul }}" required>
                            </div>

                            <div class="mb-4">
                                <label for="link_artikel" class="block text-sm font-medium text-gray-700">Link Artikel</label>
                                <input type="text" name="link_artikel" id="link_artikel" class="mt-1 block w-full" value="{{ $artikel->link_artikel }}" required>
                            </div>

                            <div class="mb-4">
                                <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" class="mt-1 block w-full" required>{{ $artikel->deskripsi }}</textarea>
                            </div>

                            <div class="mb-4">
                                <label for="gambar" class="block text-sm font-medium text-gray-700">Gambar</label>
                                <input type="file" name="gambar" id="gambar" accept="image/*" class="mt-1 block w-full">
                            </div>

                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-wides">Update</button>
                        </form>
                    @else
                        <!-- Jika user bukan pemilik artikel, tampilkan pesan error -->
                        <p class="text-red-500">Anda tidak memiliki akses untuk mengedit artikel ini.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
