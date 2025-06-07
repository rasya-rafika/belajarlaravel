<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Adopsi Hewan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Tombol Kembali -->
                    <div class="mb-4">
                        <a href="{{ route('adopsi.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition duration-200">
                            ← Kembali ke Daftar Adopsi
                        </a>
                    </div>

                    <!-- Form Edit -->
                    <form action="{{ route('adopsi.update', $adopsi->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Nama Hewan -->
                        <div>
                            <label for="nama_hewan" class="block text-sm font-medium text-gray-700 mb-2">Nama Hewan</label>
                            <input type="text" 
                                   id="nama_hewan" 
                                   name="nama_hewan" 
                                   value="{{ old('nama_hewan', $adopsi->nama_hewan) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   required>
                            @error('nama_hewan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jenis Hewan -->
                        <div>
                            <label for="jenis_hewan" class="block text-sm font-medium text-gray-700 mb-2">Jenis Hewan</label>
                            <select id="jenis_hewan" 
                                    name="jenis_hewan" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    required>
                                <option value="">Pilih Jenis Hewan</option>
                                <option value="Kucing" {{ old('jenis_hewan', $adopsi->jenis_hewan) == 'Kucing' ? 'selected' : '' }}>Kucing</option>
                                <option value="Anjing" {{ old('jenis_hewan', $adopsi->jenis_hewan) == 'Anjing' ? 'selected' : '' }}>Anjing</option>
                                <option value="Kelinci" {{ old('jenis_hewan', $adopsi->jenis_hewan) == 'Kelinci' ? 'selected' : '' }}>Kelinci</option>
                                <option value="Burung" {{ old('jenis_hewan', $adopsi->jenis_hewan) == 'Burung' ? 'selected' : '' }}>Burung</option>
                                <option value="Lainnya" {{ old('jenis_hewan', $adopsi->jenis_hewan) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('jenis_hewan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Umur -->
                        <div>
                            <label for="umur" class="block text-sm font-medium text-gray-700 mb-2">Umur (Tahun)</label>
                            <input type="number" 
                                   id="umur" 
                                   name="umur" 
                                   value="{{ old('umur', $adopsi->umur) }}"
                                   min="0" 
                                   max="30"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   required>
                            @error('umur')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jenis Kelamin -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
                            <div class="flex space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" 
                                           name="jenis_kelamin" 
                                           value="Jantan" 
                                           {{ old('jenis_kelamin', $adopsi->jenis_kelamin) == 'Jantan' ? 'checked' : '' }}
                                           class="form-radio text-blue-600">
                                    <span class="ml-2">Jantan</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" 
                                           name="jenis_kelamin" 
                                           value="Betina" 
                                           {{ old('jenis_kelamin', $adopsi->jenis_kelamin) == 'Betina' ? 'checked' : '' }}
                                           class="form-radio text-blue-600">
                                    <span class="ml-2">Betina</span>
                                </label>
                            </div>
                            @error('jenis_kelamin')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                            <textarea id="deskripsi" 
                                      name="deskripsi" 
                                      rows="4" 
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                      placeholder="Ceritakan tentang hewan ini..."
                                      required>{{ old('deskripsi', $adopsi->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <select id="status" 
                                    name="status" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    required>
                                <option value="tersedia" {{ old('status', $adopsi->status) == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                                <option value="proses" {{ old('status', $adopsi->status) == 'proses' ? 'selected' : '' }}>Sedang Diproses</option>
                                <option value="diadopsi" {{ old('status', $adopsi->status) == 'diadopsi' ? 'selected' : '' }}>Sudah Diadopsi</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Gambar -->
                        <div>
                            <label for="gambar" class="block text-sm font-medium text-gray-700 mb-2">Foto Hewan</label>
                            
                            <!-- Preview gambar yang sudah ada -->
                            @if($adopsi->gambar)
                                <div class="mb-4">
                                    <p class="text-sm text-gray-600 mb-2">Foto saat ini:</p>
                                    <img src="{{ asset('storage/'.$adopsi->gambar) }}" 
                                         alt="{{ $adopsi->nama_hewan }}" 
                                         class="w-32 h-32 object-cover rounded-lg border">
                                </div>
                            @endif
                            
                            <input type="file" 
                                   id="gambar" 
                                   name="gambar" 
                                   accept="image/*"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <p class="mt-1 text-sm text-gray-500">Biarkan kosong jika tidak ingin mengubah foto</p>
                            @error('gambar')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tombol Submit -->
                        <div class="flex justify-end space-x-3 pt-4">
                            <a href="{{ route('adopsi.index') }}" 
                               class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition duration-200">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-200">
                                Update Adopsi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>