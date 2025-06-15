<x-app-layout>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Hero Section -->
    <div class="bg-gradient-to-br from-orange-50 via-white to-orange-100 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
            
            <!-- Header Section -->
            <div class="text-center mb-12">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-orange-500 rounded-full mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <h1 class="text-4xl sm:text-5xl font-bold text-gray-800 mb-4">
                    Dokter <span class="text-orange-500">Hewan</span>
                </h1>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Temukan dokter hewan terpercaya untuk sahabat berbulu Anda
                </p>
            </div>

            <!-- Admin Action Buttons -->
            @role('admin')
                <div class="flex flex-col sm:flex-row justify-center sm:justify-end gap-4 mb-8">
                    <!-- Chart Rating Button -->
                    <a href="{{ route('dokter.chart') }}" 
                       class="group inline-flex items-center gap-2 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold py-3 px-6 rounded-full shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                        <svg class="w-5 h-5 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        Chart Rating
                    </a>
                    
                   
                    
                    <!-- Add Doctor Button -->
                    <a href="{{ route('dokter.create')}}" 
                       class="group inline-flex items-center gap-2 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-semibold py-3 px-6 rounded-full shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                        <svg class="w-5 h-5 group-hover:rotate-90 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Tambah Dokter
                    </a>
                </div>
            @endrole

            <!-- Filter Section -->
            @isset($lokasiList)
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg p-6 mb-8 border border-orange-100">
                    <form method="GET" action="{{ route('dokter.index') }}" class="flex flex-col sm:flex-row justify-center items-center gap-4">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>  
                            </svg>
                            <select name="lokasi" onchange="this.form.submit()" 
                                    class="px-4 py-3 border border-orange-200 rounded-full shadow-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 bg-white min-w-[200px]">
                                <option value="">-- Semua Lokasi --</option>
                                @foreach ($lokasiList as $lok)
                                    <option value="{{ $lok }}" {{ request('lokasi') == $lok ? 'selected' : '' }}>{{ $lok }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" 
                                class="bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-medium py-3 px-6 rounded-full shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                            🔍 Filter
                        </button>
                    </form>
                </div>
            @endisset

            <!-- Doctors Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 lg:gap-8">
                @forelse ($dokters as $dokter)
                    <div class="group bg-white rounded-3xl shadow-lg hover:shadow-2xl overflow-hidden transform hover:-translate-y-2 transition-all duration-300 border border-orange-100">
                        
                        <!-- Doctor Image -->
                        <div class="relative overflow-hidden">
                            @if ($dokter->foto)
                                <img src="{{ asset('storage/' . $dokter->foto) }}" 
                                     class="w-full h-56 sm:h-64 object-cover group-hover:scale-105 transition-transform duration-300" 
                                     alt="Foto {{ $dokter->nama }}">
                            @else
                                <div class="w-full h-56 sm:h-64 bg-gradient-to-br from-orange-50 to-orange-100 flex flex-col items-center justify-center text-orange-300">
                                    <svg class="w-16 h-16 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <span class="text-sm font-medium">Foto Belum Tersedia</span>
                                </div>
                            @endif
                            
                            <!-- Rating Badge -->
                            <div class="absolute top-4 right-4 bg-white/95 backdrop-blur-sm rounded-full px-3 py-1 shadow-lg">
                                <div class="flex items-center gap-1">
                                    <span class="text-orange-400">⭐</span>
                                    <span class="text-sm font-bold text-gray-800">
                                        {{ number_format($dokter->ratings->avg('nilai') ?? 0, 1) }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Doctor Info -->
                        <div class="p-6">
                            <h5 class="text-xl font-bold text-gray-800 mb-3 group-hover:text-orange-600 transition-colors duration-200">
                                {{ $dokter->nama }}
                            </h5>
                            
                            <div class="space-y-2 mb-4">
                                <div class="flex items-center gap-2 text-gray-600">
                                    <svg class="w-4 h-4 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-sm">{{ $dokter->pengalaman }}</span>
                                </div>
                                
                                <div class="flex items-center gap-2 text-gray-600">
                                    <svg class="w-4 h-4 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span class="text-sm">{{ $dokter->lokasi }}</span>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex flex-wrap gap-2">
                                <a href="{{ route('dokter.show', $dokter->id) }}" 
                                   class="flex-1 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white text-sm font-medium px-4 py-2 rounded-full text-center transition-all duration-200 transform hover:scale-105">
                                    Detail
                                </a>

                                @role('admin')
                                    <a href="{{ route('dokter.edit', $dokter->id) }}" 
                                       class="bg-gradient-to-r from-yellow-400 to-yellow-500 hover:from-yellow-500 hover:to-yellow-600 text-white text-sm font-medium px-4 py-2 rounded-full transition-all duration-200 transform hover:scale-105">
                                        Edit
                                    </a>

                                    <form action="{{ route('dokter.destroy', $dokter->id) }}" method="POST" 
                                          onsubmit="return confirm('Yakin ingin menghapus dokter ini?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white text-sm font-medium px-4 py-2 rounded-full transition-all duration-200 transform hover:scale-105">
                                            Hapus
                                        </button>
                                    </form>
                                @endrole

                                @role('user')
                                    <button onclick="openModal({{ $dokter->id }})"
                                            class="bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white text-sm font-medium px-4 py-2 rounded-full transition-all duration-200 transform hover:scale-105">
                                        ⭐ Rating
                                    </button>
                                @endrole
                            </div>
                        </div>
                    </div>

                    <!-- Enhanced Rating Modal -->
                    <div id="modal-{{ $dokter->id }}" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm p-4">
                        <div class="bg-white rounded-3xl p-8 w-full max-w-md shadow-2xl border border-orange-100 transform scale-95 transition-transform duration-200" onclick="event.stopPropagation()">
                            <div class="text-center mb-6">
                                <div class="inline-flex items-center justify-center w-16 h-16 bg-orange-100 rounded-full mb-4">
                                    <span class="text-2xl">⭐</span>
                                </div>
                                <h2 class="text-2xl font-bold text-gray-800 mb-2">Beri Rating</h2>
                                <p class="text-gray-600">untuk <span class="font-semibold text-orange-600">{{ $dokter->nama }}</span></p>
                            </div>
                            
                            <form method="POST" action="{{ route('rating.store', $dokter->id) }}">
                                @csrf
                                <div class="flex justify-center mb-8 space-x-2">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <button type="submit" name="nilai" value="{{ $i }}" 
                                                class="text-4xl text-gray-300 hover:text-orange-400 transition-all duration-200 transform hover:scale-110 focus:outline-none focus:text-orange-500">
                                            ★
                                        </button>
                                    @endfor
                                </div>
                                
                                <div class="flex gap-3">
                                    <button type="button" onclick="closeModal({{ $dokter->id }})"
                                            class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-3 px-6 rounded-full transition-all duration-200">
                                        Batal
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full flex flex-col items-center justify-center py-16">
                        <div class="w-24 h-24 bg-orange-100 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-12 h-12 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.5-1.01-6-2.709M15 15.803c.622-.226 1.239-.518 1.837-.863a2.5 2.5 0 00-3.674-3.374c-.345.598-.637 1.215-.863 1.837M15 15.803c0 .622.126 1.221.363 1.775.237.554.584 1.06 1.022 1.494.438.434.944.781 1.498 1.018.554.237 1.153.363 1.775.363s1.221-.126 1.775-.363a4.5 4.5 0 001.494-1.022c.434-.438.781-.944 1.018-1.498.237-.554.363-1.153.363-1.775s-.126-1.221-.363-1.775a4.5 4.5 0 00-1.022-1.494 4.5 4.5 0 00-1.494-1.018 4.457 4.457 0 00-1.775-.363c-.622 0-1.221.126-1.775.363-.554.237-1.06.584-1.498 1.018a4.5 4.5 0 00-1.022 1.494c-.237.554-.363 1.153-.363 1.775z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-700 mb-2">Tidak Ada Dokter Ditemukan</h3>
                        <p class="text-gray-500 text-center max-w-md">
                            Maaf, tidak ada dokter hewan yang sesuai dengan kriteria pencarian Anda.
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <script>
        function openModal(id) {
            const modal = document.getElementById(`modal-${id}`);
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            // Add scale animation
            const content = modal.querySelector('div > div');
            setTimeout(() => {
                content.classList.remove('scale-95');
                content.classList.add('scale-100');
            }, 10);
        }

        function closeModal(id) {
            const modal = document.getElementById(`modal-${id}`);
            const content = modal.querySelector('div > div');
            content.classList.remove('scale-100');
            content.classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }, 200);
        }

        // Close modal when clicking outside
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('fixed')) {
                const modalId = e.target.id.replace('modal-', '');
                if (modalId) closeModal(modalId);
            }
        });
    </script>
</x-app-layout>