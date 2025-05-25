<x-app-layout>
    <div class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-6 text-center">Tambah Dokter Baru</h2>

        <form action="{{ route('dokter.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium">Nama</label>
                <input type="text" name="nama" class="w-full border border-gray-300 rounded px-4 py-2 mt-1" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Pengalaman</label>
                <input type="text" name="pengalaman" class="w-full border border-gray-300 rounded px-4 py-2 mt-1" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Lokasi</label>
                <input type="text" name="lokasi" class="w-full border border-gray-300 rounded px-4 py-2 mt-1" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Alamat</label>
                <textarea name="alamat" class="w-full border border-gray-300 rounded px-4 py-2 mt-1" rows="3"></textarea>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Jadwal (opsional)</label>
                <input type="text" name="jadwal" class="w-full border border-gray-300 rounded px-4 py-2 mt-1">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Foto</label>
                <input type="file" name="foto" class="mt-1">
            </div>

            <div class="text-center">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</x-app-layout>