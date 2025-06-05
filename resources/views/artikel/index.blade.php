<!-- resources/views/artikel/index.blade.php -->
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
                    <a href="{{ route('artikel.create') }}" class="mb-4 inline-block px-4 py-2 bg-blue-600 text-white rounded-md">+ Tambah Artikel</a>

                    <table class="min-w-full divide-y divide-gray-200 mt-4">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left">No</th>
                                <th class="px-6 py-3 text-left">Judul</th>
                                <th class="px-6 py-3 text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($artikels as $index => $artikel)
                                <tr>
                                    <td class="px-6 py-4">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4">{{ $artikel->judul }}</td>
                                    <td class="px-6 py-4 space-x-2">
                                        <a href="{{ $artikel->link_artikel }}" target="_blank" class="text-blue-500">Lihat</a>
                                        @if ($artikel->user_id === Auth::id() || Auth::user()->hasRole('admin'))
                                            <a href="{{ route('artikel.edit', $artikel->id) }}" class="text-yellow-500">Edit</a>
                                            <form action="{{ route('artikel.destroy', $artikel->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500">Hapus</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-center text-gray-500">Belum ada artikel.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    {{ $artikels->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
