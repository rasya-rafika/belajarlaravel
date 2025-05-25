<x-app-layout>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <div class="container py-12">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold">Detail Dokter Hewan</h1>
        </div>

        <div class="card mx-auto" style="max-width: 700px;">
            @if ($dokter->foto)
                <img src="{{ asset('storage/' . $dokter->foto) }}" class="card-img-top" style="height: 300px; object-fit: cover;">
            @endif

            <div class="card-body">
                <h3 class="card-title text-2xl font-bold mb-2">{{ $dokter->nama }}</h3>
                <p class="mb-1"><strong>Pengalaman:</strong> {{ $dokter->pengalaman }}</p>
                <p class="mb-1"><strong>Lokasi:</strong> {{ $dokter->lokasi }}</p>
                <p class="mb-1"><strong>Alamat Lengkap:</strong> {{ $dokter->alamat }}</p>
                <p class="mb-1"><strong>Jadwal:</strong> {{ $dokter->jadwal ?? '-' }}</p>
                <p class="mb-1"><strong>Rating:</strong> ⭐ {{ number_format($dokter->ratings->avg('nilai') ?? 0, 1) }} / 5</p>

                {{-- Tombol rating untuk user --}}
                @role('user')
                    <a href="{{ route('rating.create', $dokter->id) }}" class="btn btn-success mt-3">Beri Rating</a>
                @endrole

                {{-- Tombol edit & hapus untuk admin --}}
                @role('admin')
                    <div class="mt-4 d-flex gap-2">
                        <a href="{{ route('dokter.edit', $dokter->id) }}" class="btn btn-warning">Edit</a>

                        <form action="{{ route('dokter.destroy', $dokter->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus dokter ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                @endrole

                <div class="mt-4">
                    <a href="{{ route('dokter.index') }}" class="btn btn-secondary">← Kembali ke Daftar Dokter</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
