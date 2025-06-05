<x-app-layout>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <div class="max-w-7xl mx-auto px-4 py-12">
        <h1 class="text-3xl font-bold mb-8 text-center text-gray-800">Daftar Dokter Hewan</h1>

        @role('admin')
            <div class="text-right mb-6">
                <a href="{{ route('dokter.create')}}" class="bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 px-4 rounded shadow">
                    + Tambah Dokter
                </a>
            </div>
        @endrole

        @isset($lokasiList)
            <form method="GET" action="{{ route('dokter.index') }}" class="mb-8 flex justify-center items-center space-x-2">
                <select name="lokasi" onchange="this.form.submit()" class="px-4 py-2 border border-gray-300 rounded shadow">
                    <option value="">-- Semua Lokasi --</option>
                    @foreach ($lokasiList as $lok)
                        <option value="{{ $lok }}" {{ request('lokasi') == $lok ? 'selected' : '' }}>{{ $lok }}</option>
                    @endforeach
                </select>
                <button type="submit" class="bg-teal-500 hover:bg-teal-600 text-white font-medium py-2 px-4 rounded shadow">
                    Filter
                </button>
            </form>
        @endisset

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($dokters as $dokter)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300">
                    @if ($dokter->foto)
                       <img src="{{ asset('storage/' . $dokter->foto) }}" class="w-full h-60 object-cover" alt="Foto Dokter">
                    @else
                        <div class="w-full h-60 bg-gray-100 flex items-center justify-center text-gray-400">
                            Tidak Ada Foto
                        </div>
                    @endif

                    <div class="p-6">
                        <h5 class="text-xl font-bold text-gray-800 mb-2">{{ $dokter->nama }}</h5>
                        <p class="text-gray-600 mb-1"><strong>Pengalaman:</strong> {{ $dokter->pengalaman }}</p>
                        <p class="text-gray-600 mb-1"><strong>Lokasi:</strong> {{ $dokter->lokasi }}</p>
                        <p class="text-yellow-500 font-medium mb-4">
                            ⭐ {{ number_format($dokter->ratings->avg('nilai') ?? 0, 1) }} / 5
                        </p>

                        <div class="flex flex-wrap gap-2">
                            <a href="{{ route('dokter.show', $dokter->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white text-sm px-3 py-1 rounded">Lihat Detail</a>

                            @role('admin')
                                <a href="{{ route('dokter.edit', $dokter->id) }}" class="bg-yellow-400 hover:bg-yellow-500 text-white text-sm px-3 py-1 rounded">Edit</a>

                                <form action="{{ route('dokter.destroy', $dokter->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus dokter ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white text-sm px-3 py-1 rounded">
                                        Delete
                                    </button>
                                </form>
                            @endrole

                            @role('user')
                                <button onclick="openModal({{ $dokter->id }})"
                                    class="bg-green-500 hover:bg-green-600 text-white text-sm px-3 py-1 rounded">
                                    Beri Rating
                                </button>
                            @endrole
                        </div>
                    </div>
                </div>

                <!-- Modal Rating -->
                <div id="modal-{{ $dokter->id }}" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50">
                    <div class="bg-white rounded-xl p-6 w-full max-w-md relative shadow-lg">
                        <h2 class="text-xl font-bold mb-4 text-gray-800">Beri Rating untuk {{ $dokter->nama }}</h2>
                        <form method="POST" action="{{ route('rating.store', $dokter->id) }}">
                            @csrf
                            <div class="flex justify-center mb-4 space-x-1 text-3xl">
                                @for ($i = 1; $i <= 5; $i++)
                                    <button type="submit" name="nilai" value="{{ $i }}" class="text-gray-400 hover:text-yellow-500 transition duration-150">
                                        ★
                                    </button>
                                @endfor
                            </div>
                            <div class="text-center">
                                <button type="button" onclick="closeModal({{ $dokter->id }})"
                                    class="text-sm text-gray-500 hover:text-red-500">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500 col-span-full">Tidak ada dokter ditemukan.</p>
            @endforelse
        </div>
    </div>

    <script>
        function openModal(id) {
            const modal = document.getElementById(`modal-${id}`);
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal(id) {
            const modal = document.getElementById(`modal-${id}`);
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>
</x-app-layout>
