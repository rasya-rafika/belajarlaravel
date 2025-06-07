<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Hewan untuk Adopsi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <!-- Back Button -->
                    <div class="mb-6">
                        <a href="{{ route('adopsi.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-700 text-white text-sm font-medium rounded-md">
                            ← Kembali ke Daftar Adopsi
                        </a>
                    </div>

                    <!-- Display Validation Errors -->
                    @if ($errors->any())
                        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                            <strong>Whoops! Ada yang salah.</strong>
                            <ul class="mt-2 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Form -->
                    <form action="{{ route('adopsi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        
                        <!-- Nama Hewan -->
                        <div>
                            <label for="nama_hewan" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Hewan <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="nama_hewan" 
                                   name="nama_hewan" 
                                   value="{{ old('nama_hewan') }}"
                                   required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Contoh: Fluffy">
                        </div>

                        <!-- Jenis Hewan -->
                        <div>
                            <label for="jenis_hewan" class="block text-sm font-medium text-gray-700 mb-2">
                                Jenis Hewan <span class="text-red-500">*</span>
                            </label>
                            <select id="jenis_hewan" 
                                    name="jenis_hewan" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    required>
                                <option value="">Pilih Jenis Hewan</option>
                                <option value="Kucing" {{ old('jenis_hewan') == 'Kucing' ? 'selected' : '' }}>Kucing</option>
                                <option value="Anjing" {{ old('jenis_hewan') == 'Anjing' ? 'selected' : '' }}>Anjing</option>
                                <option value="Kelinci" {{ old('jenis_hewan') == 'Kelinci' ? 'selected' : '' }}>Kelinci</option>
                                <option value="Burung" {{ old('jenis_hewan') == 'Burung' ? 'selected' : '' }}>Burung</option>
                                <option value="Lainnya" {{ old('jenis_hewan') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('jenis_hewan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jenis Kelamin -->
                        <div>
                            <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-2">
                                Jenis Kelamin <span class="text-red-500">*</span>
                            </label>
                            <select id="jenis_kelamin" 
                                    name="jenis_kelamin" 
                                    required 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="Jantan" {{ old('jenis_kelamin') == 'Jantan' ? 'selected' : '' }}>Jantan</option>
                                <option value="Betina" {{ old('jenis_kelamin') == 'Betina' ? 'selected' : '' }}>Betina</option>
                            </select>
                        </div>

                        <!-- Umur -->
                        <div>
                            <label for="umur" class="block text-sm font-medium text-gray-700 mb-2">
                                Umur (dalam bulan) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" 
                                   id="umur" 
                                   name="umur" 
                                   value="{{ old('umur') }}"
                                   required 
                                   min="0" 
                                   max="20"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Contoh: 2">
                            <p class="mt-1 text-sm text-gray-500">Masukkan umur dalam bulan</p>
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                                Deskripsi Hewan <span class="text-red-500">*</span>
                            </label>
                            <textarea id="deskripsi" 
                                      name="deskripsi" 
                                      required 
                                      rows="4"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                      placeholder="Ceritakan tentang hewan ini, seperti sifat, kebiasaan, kondisi kesehatan, dll.">{{ old('deskripsi') }}</textarea>
                            <p class="mt-1 text-sm text-gray-500">Jelaskan karakteristik, sifat, dan informasi penting lainnya tentang hewan ini</p>
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <select id="status" 
                                    name="status" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    required>
                                <option value="tersedia" {{ old('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                                <option value="proses" {{ old('status') == 'proses' ? 'selected' : '' }}>Sedang Diproses</option>
                                <option value="diadopsi" {{ old('status') == 'diadopsi' ? 'selected' : '' }}>Sudah Diadopsi</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Foto Hewan -->
                        <div>
                            <label for="gambar" class="block text-sm font-medium text-gray-700 mb-2">
                                Foto Hewan
                            </label>
                            <input type="file" 
                                   id="gambar" 
                                   name="gambar" 
                                   accept="image/*"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <p class="mt-1 text-sm text-gray-500">Format yang diizinkan: JPG, PNG, JPEG, GIF. Maksimal 2MB</p>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end space-x-4 pt-6">
                            <a href="{{ route('adopsi.index') }}" 
                               class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Tambahkan Hewan untuk Adopsi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
