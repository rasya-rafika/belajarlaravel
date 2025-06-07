<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contact SafePaws') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <!-- Contact Form Section - Only for non-admin users -->
        @if(!auth()->user()->hasRole('admin'))
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto">
                <h2 class="text-3xl font-bold text-center mb-8 text-gray-800">
                    {{ __('Contact SafePaws') }}
                </h2>
                
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <form action="{{ route('contact.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        
                        <!-- Nama -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('Nama') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror" 
                                   required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('Email') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror" 
                                   required>
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kategori Pesan -->
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('Kategori Pesan') }} <span class="text-red-500">*</span>
                            </label>
                            <select id="category" 
                                    name="category" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('category') border-red-500 @enderror" 
                                    required>
                                <option value="">{{ __('Pilih Kategori') }}</option>
                                <option value="aduan_permasalahan" {{ old('category') == 'aduan_permasalahan' ? 'selected' : '' }}>
                                    {{ __('Aduan Permasalahan') }}
                                </option>
                                <option value="pendaftaran_dokter" {{ old('category') == 'pendaftaran_dokter' ? 'selected' : '' }}>
                                    {{ __('Pendaftaran Dokter') }}
                                </option>
                                <option value="pendaftaran_hewan_adopsi" {{ old('category') == 'pendaftaran_hewan_adopsi' ? 'selected' : '' }}>
                                    {{ __('Pendaftaran Hewan Adopsi') }}
                                </option>
                                <option value="lainnya" {{ old('category') == 'lainnya' ? 'selected' : '' }}>
                                    {{ __('Lainnya') }}
                                </option>
                            </select>
                            @error('category')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Upload Foto (Opsional) -->
                        <div>
                            <label for="photo" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('Upload Foto') }} <span class="text-gray-500">({{ __('Opsional') }})</span>
                            </label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-gray-400 transition-colors">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="photo" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                            <span>{{ __('Upload file') }}</span>
                                            <input id="photo" 
                                                   name="photo" 
                                                   type="file" 
                                                   accept="image/*"
                                                   class="sr-only">
                                        </label>
                                        <p class="pl-1">{{ __('atau drag and drop') }}</p>
                                    </div>
                                    <p class="text-xs text-gray-500">
                                        {{ __('PNG, JPG, JPEG hingga 2MB') }}
                                    </p>
                                </div>
                            </div>
                            @error('photo')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            
                            <!-- Preview Image -->
                            <div id="imagePreview" class="mt-3 hidden">
                                <img id="previewImg" src="" alt="Preview" class="max-w-xs rounded-md shadow-sm">
                                <button type="button" id="removeImage" class="mt-2 text-sm text-red-600 hover:text-red-800">
                                    {{ __('Hapus Foto') }}
                                </button>
                            </div>
                        </div>

                        <!-- Pesan -->
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('Pesan') }} <span class="text-red-500">*</span>
                            </label>
                            <textarea id="message" 
                                      name="message" 
                                      rows="5" 
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('message') border-red-500 @enderror" 
                                      placeholder="{{ __('Tulis pesan Anda di sini...') }}" 
                                      required>{{ old('message') }}</textarea>
                            @error('message')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-4">
                            <button type="submit" 
                                    class="w-full bg-blue-600 text-white py-3 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors font-medium">
                                {{ __('Kirim Pesan') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endif

        <!-- Contact Messages List Section - Only for admin -->
        @if(auth()->user()->hasRole('admin'))
        <div class="container mx-auto px-4 py-8">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b">
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Daftar Pesan Kontak') }}</h3>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pesan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Foto</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($contacts ?? [] as $index => $contact)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $index + 1 }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $contact->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $contact->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
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
                                            @switch($contact->category)
                                                @case('aduan_permasalahan')
                                                    {{ __('Aduan Permasalahan') }}
                                                    @break
                                                @case('pendaftaran_dokter')
                                                    {{ __('Pendaftaran Dokter') }}
                                                    @break
                                                @case('pendaftaran_hewan_adopsi')
                                                    {{ __('Pendaftaran Hewan Adopsi') }}
                                                    @break
                                                @default
                                                    {{ __('Lainnya') }}
                                            @endswitch
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500 max-w-xs">
                                        <div class="truncate" title="{{ $contact->message }}">
                                            {{ Str::limit($contact->message, 50) }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        @if($contact->photo)
                                            <img src="{{ Storage::url($contact->photo) }}" 
                                                 alt="Contact Photo" 
                                                 class="h-10 w-10 rounded-full object-cover cursor-pointer"
                                                 onclick="showImageModal('{{ Storage::url($contact->photo) }}')">
                                        @else
                                            <span class="text-gray-400">{{ __('Tidak ada') }}</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($contact->is_read)
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                {{ __('Sudah Dibaca') }}
                                            </span>
                                        @else
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                                {{ __('Belum Dibaca') }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $contact->created_at ? $contact->created_at->format('d/m/Y H:i') : '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                        <a href="{{ route('contact.show', $contact->id) }}" 
                                           class="text-blue-600 hover:text-blue-900">
                                            {{ __('Lihat Detail') }}
                                        </a>
                                        <form action="{{ route('contact.destroy', $contact->id) }}" 
                                              method="POST" 
                                              class="inline"
                                              onsubmit="return confirm('{{ __('Apakah Anda yakin ingin menghapus pesan ini?') }}')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="text-red-600 hover:text-red-900 ml-2">
                                                {{ __('Hapus') }}
                                            </button>
                                        </form>
                                        @if(!$contact->is_read)
                                            <form action="{{ route('contact.mark-read', $contact->id) }}" 
                                                  method="POST" 
                                                  class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" 
                                                        class="text-green-600 hover:text-green-900 ml-2">
                                                    {{ __('Tandai Dibaca') }}
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="px-6 py-4 text-center text-sm text-gray-500">
                                        {{ __('Belum ada pesan kontak') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50 flex items-center justify-center">
        <div class="bg-white rounded-lg p-4 max-w-2xl max-h-screen overflow-auto">
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
    // Image preview functionality
    document.getElementById('photo')?.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImg').src = e.target.result;
                document.getElementById('imagePreview').classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    });

    // Remove image functionality
    document.getElementById('removeImage')?.addEventListener('click', function() {
        document.getElementById('photo').value = '';
        document.getElementById('imagePreview').classList.add('hidden');
    });

    // Modal functions
    function showImageModal(imageSrc) {
        document.getElementById('modalImage').src = imageSrc;
        document.getElementById('imageModal').classList.remove('hidden');
    }

    function closeImageModal() {
        document.getElementById('imageModal').classList.add('hidden');
    }

    // Close modal when clicking outside
    document.getElementById('imageModal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeImageModal();
        }
    });
    </script>
</x-app-layout>