<x-app-layout>
    <div class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-6 text-center">Edit Dokter</h2>

        <form action="{{ route('dokter.update', $dokter->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium">Nama</label>
                <input type="text" name="nama" value="{{ old('nama', $dokter->nama) }}" class="w-full border border-gray-300 rounded px-4 py-2 mt-1" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Pengalaman</label>
                <input type="text" name="pengalaman" value="{{ old('pengalaman', $dokter->pengalaman) }}" class="w-full border border-gray-300 rounded px-4 py-2 mt-1" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Lokasi</label>
                <input type="text" name="lokasi" value="{{ old('lokasi', $dokter->lokasi) }}" class="w-full border border-gray-300 rounded px-4 py-2 mt-1" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Alamat</label>
                <textarea name="alamat" class="w-full border border-gray-300 rounded px-4 py-2 mt-1" rows="3">{{ old('alamat', $dokter->alamat) }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Jadwal (opsional)</label>
                <input type="text" name="jadwal" value="{{ old('jadwal', $dokter->jadwal) }}" class="w-full border border-gray-300 rounded px-4 py-2 mt-1">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Foto (opsional)</label>
                <input type="file" name="foto" class="mt-1">
                @if ($dokter->foto)
                    <div class="mt-2">
                        <p class="text-sm text-gray-600">Foto saat ini:</p>
                        <img src="{{ asset('storage/public' . $dokter->foto) }}" alt="Foto Dokter" class="h-32 rounded mt-1">
                    </div>
                @endif
            </div>

            <div class="text-center">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Perbarui</button>
            </div>
        </form>
    </div>
</x-app-layout>
