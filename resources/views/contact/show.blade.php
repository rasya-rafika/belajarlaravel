<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Pesan Kontak') }}
            </h2>
            <a href="{{ route('contact.index') }}" 
               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                {{ __('Kembali') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Success Message -->
                    @if(session('success'))
                        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <!-- Contact Details -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Left Column -->
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    {{ __('Nama') }}
                                </label>
                                <p class="text-lg text-gray-900">{{ $contact->name }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    {{ __('Email') }}
                                </label>
                                <p class="text-lg text-gray-900">
                                    <a href="mailto:{{ $contact->email }}" class="text-blue-600 hover:text-blue-800">
                                        {{ $contact->email }}
                                    </a>
                                </p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    {{ __('Kategori') }}
                                </label>
                                <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full 
                                    @switch($contact->category)
                                        @case('aduan_permasalahan')
                                            bg-red-100 text-red-800
                                            @break
                                        @case('pendaftaran_dokter')
                                            bg-blue-100 text-blue-800
                                            @break
                                        @case('pendaftaran_hewan_adopsi')
                                            bg-green-100 text-green-800
                                            @break
                                        @default
                                            bg-gray-100 text-gray-800
                                    @endswitch">
                                    {{ $contact->category_label }}
                                </span>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    {{ __('Status') }}
                                </label>
                                @if($contact->is_read)
                                    <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                                        {{ __('Sudah Dibaca') }}
                                    </span>
                                @else
                                    <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-800">
                                        {{ __('Belum Dibaca') }}
                                    </span>
                                @endif
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    {{ __('Tanggal Dikirim') }}
                                </label>
                                <p class="text-lg text-gray-900">
                                    {{ $contact->created_at->format('d F Y, H:i') }} WIB
                                </p>
                            </div>
                        </div>

                        <!-- Right Column - Photo -->
                        <div class="space-y-4">
                            @if($contact->photo)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        {{ __('Foto Lampiran') }}
                                    </label>
                                    <div class="mt-2">
                                        <img src="{{ Storage::url($contact->photo) }}" 
                                             alt="Contact Photo" 
                                             class="max-w-full h-auto rounded-lg shadow-lg cursor-pointer"
                                             onclick="showImageModal('{{ Storage::url($contact->photo) }}')">
                                        <p class="text-sm text-gray-500 mt-2">
                                            {{ __('Klik gambar untuk memperbesar') }}
                                        </p>
                                    </div>
                                </div>
                            @else
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        {{ __('Foto Lampiran') }}
                                    </label>
                                    <p class="text-gray-500 italic">{{ __('Tidak ada foto') }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Message -->
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            {{ __('Pesan') }}
                        </label>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-gray-900 whitespace-pre-wrap">{{ $contact->message }}</p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    @auth
                        @if (auth()->user()->hasRole('admin'))
                            <div class="mt-8 flex flex-wrap gap-3">
                                @if(!$contact->is_read)
                                    <form action="{{ route('contact.mark-read', $contact->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" 
                                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                            {{ __('Tandai Sudah Dibaca') }}
                                        </button>
                                    </form>
                                @endif

                                <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->category_label }}" 
                                   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    {{ __('Balas via Email') }}
                                </a>

                                @if($contact->photo)
                                    <form action="{{ route('contact.photo.destroy', $contact->id) }}" 
                                          method="POST" 
                                          class="inline"
                                          onsubmit="return confirm('{{ __('Apakah Anda yakin ingin menghapus foto ini?') }}')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                            {{ __('Hapus Foto') }}
                                        </button>
                                    </form>
                                @endif

                                <form action="{{ route('contact.destroy', $contact->id) }}" 
                                      method="POST" 
                                      class="inline"
                                      onsubmit="return confirm('{{ __('Apakah Anda yakin ingin menghapus pesan ini? Tindakan ini tidak dapat dibatalkan.') }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                        {{ __('Hapus Pesan') }}
                                    </button>
                                </form>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50 flex items-center justify-center">
        <div class="bg-white rounded-lg p-4 max-w-4xl max-h-screen overflow-auto">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium">{{ __('Preview Foto') }}</h3>
                <button onclick="closeImageModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <img id="modalImage" src="" alt="Preview" class="max-w-full h-auto">
        </div>
    </div>

    <script>
    // Modal functions
    function showImageModal(imageSrc) {
        document.getElementById('modalImage').src = imageSrc;
        document.getElementById('imageModal').classList.remove('hidden');
    }

    function closeImageModal() {
        document.getElementById('imageModal').classList.add('hidden');
    }

    // Close modal when clicking outside
    document.getElementById('imageModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeImageModal();
        }
    });

    // Auto mark as read when admin views the contact
    @auth
        @if (auth()->user()->hasRole('admin') && !$contact->is_read)
            // Optional: Auto mark as read when admin opens the detail
            // Uncomment the lines below if you want this behavior
            /*
            fetch('{{ route('contact.mark-read', $contact->id) }}', {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
            });
            */
        @endif
    @endauth
    </script>
</x-app-layout>