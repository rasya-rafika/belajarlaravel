<x-app-layout>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <div class="container py-12">
        <h1 class="text-2xl font-bold mb-4 text-center">Daftar Dokter Hewan</h1>

        <!-- Tampilkan tombol tambah dokter untuk admin -->
        @role('admin')
            <div class="text-right mb-4">
                <a href="{{ route('dokter.create') }}" class="btn btn-primary">+ Tambah Dokter</a>
            </div>
        @endrole

        <!-- Filter Lokasi -->
        @isset($lokasiList)
            <form method="GET" action="{{ route('dokter.index') }}" class="mb-4 text-center">
                <select name="lokasi" onchange="this.form.submit()" class="px-4 py-2 border rounded">
                    <option value="">-- Semua Lokasi --</option>
                    @foreach ($lokasiList as $lok)
                        <option value="{{ $lok }}" {{ request('lokasi') == $lok ? 'selected' : '' }}>{{ $lok }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary ml-2">Filter</button>
            </form>
        @endisset

        <div class="row">
            @forelse ($dokters as $dokter)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        @if ($dokter->foto)
                            <img src="{{ asset('storage.public' . $dokter->foto) }}" class="card-img-top" style="height: 250px; object-fit: cover;">
                        @endif

                        <div class="card-body">
                            <h5 class="card-title">{{ $dokter->nama }}</h5>
                            <p class="card-text"><strong>Pengalaman:</strong> {{ $dokter->pengalaman }}</p>
                            <p class="card-text"><strong>Lokasi:</strong> {{ $dokter->lokasi }}</p>
                            <p class="card-text"><strong>Rating:</strong> 
                                ⭐ {{ number_format($dokter->ratings->avg('nilai') ?? 0, 1) }} / 5
                            </p>

                            <a href="{{ route('dokter.show', $dokter->id) }}" class="btn btn-sm btn-primary mt-2">Lihat Detail</a>

                            {{-- Tombol CRUD untuk Admin --}}
                            @role('admin')
                                <a href="{{ route('dokter.edit', $dokter->id) }}" class="btn btn-sm btn-warning mt-2">Edit</a>

                                <form action="{{ route('dokter.destroy', $dokter->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger mt-2" onclick="return confirm('Yakin ingin menghapus dokter ini?')">Delete</button>
                                </form>
                            @endrole

                            {{-- Tombol rating untuk User --}}
                            @role('user')
                                <a href="{{ route('rating.create', $dokter->id) }}" class="btn btn-sm btn-success mt-2">Beri Rating</a>
                            @endrole
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center">Tidak ada dokter ditemukan.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>