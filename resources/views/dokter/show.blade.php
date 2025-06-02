<x-app-layout>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <div class="max-w-3xl mx-auto py-12 px-4">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Detail Dokter Hewan</h1>
        </div>

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            @if ($dokter->foto)
                <img src="{{ asset('storage/' . $dokter->foto) }}" class="w-full h-64 object-cover" alt="Foto Dokter">
            @endif

            <div class="p-6 space-y-3">
                <h2 class="text-2xl font-bold text-gray-800">{{ $dokter->nama }}</h2>

                <p><span class="font-semibold text-gray-700">Pengalaman:</span> {{ $dokter->pengalaman }}</p>
                <p><span class="font-semibold text-gray-700">Lokasi:</span> {{ $dokter->lokasi }}</p>
                <p><span class="font-semibold text-gray-700">Alamat Lengkap:</span> {{ $dokter->alamat }}</p>
                <p><span class="font-semibold text-gray-700">Jadwal:</span> {{ $dokter->jadwal ?? '-' }}</p>
                <p class="text-yellow-500">
                    <span class="font-semibold text-gray-700">Rating:</span> ⭐ {{ number_format($dokter->ratings->avg('nilai') ?? 0, 1) }} / 5
                </p>

                @role('user')
                    <a href="{{ route('rating.create', $dokter->id) }}"
                        class="inline-block bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded mt-4">
                        Beri Rating
                    </a>
                @endrole

                @role('admin')
                    <div class="flex flex-wrap gap-3 mt-6">
                        <a href="{{ route('dokter.edit', $dokter->id) }}"
                            class="bg-yellow-500 hover:bg-yellow-600 text-white font-medium py-2 px-4 rounded">
                            Edit
                        </a>

                        <form action="{{ route('dokter.destroy', $dokter->id) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus dokter ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded">
                                Hapus
                            </button>
                        </form>
                    </div>
                @endrole

                <div class="mt-6">
                    <a href="{{ route('dokter.index') }}"
                        class="text-blue-600 hover:underline text-sm">
                        ← Kembali ke Daftar Dokter
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
