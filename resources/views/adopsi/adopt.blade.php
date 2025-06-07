<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Form Pengajuan Adopsi: ') }} {{ $adopsi->nama_hewan }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <!-- Back Button -->
                    <div class="mb-6">
                        <a href="{{ route('adopsi.index', $adopsi->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-700 text-white text-sm font-medium rounded-md">
                            ← Kembali ke Detail Hewan
                        </a>
                    </div>

                    <!-- Info Hewan -->
                    <div class="mb-8 p-4 bg-orange-50 rounded-lg border border-orange-200">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Hewan yang akan diadopsi:</h3>
                        <div class="flex items-center space-x-4">
                            @if($adopsi->gambar)
                                <img src="{{ asset('storage/'.$adopsi->gambar) }}" alt="{{ $adopsi->nama_hewan }}" class="w-16 h-16 object-cover rounded-lg">
                            @endif
                            <div>
                                <p class="font-medium">{{ $adopsi->nama_hewan }}</p>
                                <p class="text-sm text-gray-600">{{ $adopsi->jenis_kelamin }}, {{ $adopsi->umur }} tahun</p>
                            </div>
                        </div>
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

                    <!-- Form Pengajuan Adopsi -->
                    <form action="{{ route('adopsi.submitAdopsi', $adopsi->id) }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <h3 class="text-lg font-semibold text-gray-800 border-b pb-2">Informasi Pribadi</h3>
                        
                        <!-- Nama Lengkap -->
                        <div>
                            <label for="nama_pengaju" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="nama_pengaju" 
                                   name="nama_pengaju" 
                                   value="{{ old('nama_pengaju', Auth::user()->name ?? '') }}"
                                   required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Masukkan nama lengkap Anda">
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email', Auth::user()->email ?? '') }}"
                                   required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="contoh@email.com">
                        </div>

                        <!-- Nomor Telepon -->
                        <div>
                            <label for="nomor_telepon" class="block text-sm font-medium text-gray-700 mb-2">
                                Nomor Telepon <span class="text-red-500">*</span>
                            </label>
                            <input type="tel" 
                                   id="nomor_telepon" 
                                   name="nomor_telepon" 
                                   value="{{ old('nomor_telepon') }}"
                                   required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Contoh: 08123456789">
                            <p class="mt-1 text-sm text-gray-500">Nomor telepon yang bisa dihubungi</p>
                        </div>

                        <!-- Alamat Lengkap -->
                        <div>
                            <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">
                                Alamat Lengkap <span class="text-red-500">*</span>
                            </label>
                            <textarea id="alamat" 
                                      name="alamat" 
                                      required 
                                      rows="3"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                      placeholder="Masukkan alamat lengkap termasuk kota dan kode pos">{{ old('alamat') }}</textarea>
                        </div>

                        <!-- Usia -->
                        <div>
                            <label for="usia" class="block text-sm font-medium text-gray-700 mb-2">
                                Usia <span class="text-red-500">*</span>
                            </label>
                            <input type="number" 
                                   id="usia" 
                                   name="usia" 
                                   value="{{ old('usia') }}"
                                   required 
                                   min="18" 
                                   max="80"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Contoh: 25">
                            <p class="mt-1 text-sm text-gray-500">Minimal usia 18 tahun</p>
                        </div>

                        <!-- Pekerjaan -->
                        <div>
                            <label for="pekerjaan" class="block text-sm font-medium text-gray-700 mb-2">
                                Pekerjaan <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="pekerjaan" 
                                   name="pekerjaan" 
                                   value="{{ old('pekerjaan') }}"
                                   required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Contoh: Karyawan Swasta, Wiraswasta, dll">
                        </div>

                        <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 pt-6">Informasi Tempat Tinggal</h3>

                        <!-- Tipe Hunian -->
                        <div>
                            <label for="tipe_hunian" class="block text-sm font-medium text-gray-700 mb-2">
                                Tipe Hunian <span class="text-red-500">*</span>
                            </label>
                            <select id="tipe_hunian" 
                                    name="tipe_hunian" 
                                    required 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">-- Pilih Tipe Hunian --</option>
                                <option value="Rumah" {{ old('tipe_hunian') == 'Rumah' ? 'selected' : '' }}>Rumah</option>
                                <option value="Apartemen" {{ old('tipe_hunian') == 'Apartemen' ? 'selected' : '' }}>Apartemen</option>
                                <option value="Kos/Kontrakan" {{ old('tipe_hunian') == 'Kos/Kontrakan' ? 'selected' : '' }}>Kos/Kontrakan</option>
                            </select>
                        </div>

                        <!-- Status Kepemilikan -->
                        <div>
                            <label for="status_hunian" class="block text-sm font-medium text-gray-700 mb-2">
                                Status Kepemilikan <span class="text-red-500">*</span>
                            </label>
                            <select id="status_hunian" 
                                    name="status_hunian" 
                                    required 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">-- Pilih Status --</option>
                                <option value="Milik Sendiri" {{ old('status_hunian') == 'Milik Sendiri' ? 'selected' : '' }}>Milik Sendiri</option>
                                <option value="Sewa/Kontrak" {{ old('status_hunian') == 'Sewa/Kontrak' ? 'selected' : '' }}>Sewa/Kontrak</option>
                                <option value="Tinggal dengan Orang Tua" {{ old('status_hunian') == 'Tinggal dengan Orang Tua' ? 'selected' : '' }}>Tinggal dengan Orang Tua</option>
                            </select>
                        </div>

                        <!-- Halaman/Taman -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Apakah rumah memiliki halaman atau taman? <span class="text-red-500">*</span>
                            </label>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="radio" name="ada_halaman" value="Ya" {{ old('ada_halaman') == 'Ya' ? 'checked' : '' }} required class="mr-2">
                                    Ya, ada halaman/taman
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="ada_halaman" value="Tidak" {{ old('ada_halaman') == 'Tidak' ? 'checked' : '' }} required class="mr-2">
                                    Tidak ada halaman/taman
                                </label>
                            </div>
                        </div>

                        <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 pt-6">Pengalaman dengan Hewan</h3>

                        <!-- Pengalaman Memelihara -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Apakah Anda pernah memelihara hewan sebelumnya? <span class="text-red-500">*</span>
                            </label>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="radio" name="pengalaman_hewan" value="Ya" {{ old('pengalaman_hewan') == 'Ya' ? 'checked' : '' }} required class="mr-2">
                                    Ya, pernah
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="pengalaman_hewan" value="Tidak" {{ old('pengalaman_hewan') == 'Tidak' ? 'checked' : '' }} required class="mr-2">
                                    Tidak pernah
                                </label>
                            </div>
                        </div>

                        <!-- Detail Pengalaman -->
                        <div>
                            <label for="detail_pengalaman" class="block text-sm font-medium text-gray-700 mb-2">
                                Jika pernah, ceritakan pengalaman Anda
                            </label>
                            <textarea id="detail_pengalaman" 
                                      name="detail_pengalaman" 
                                      rows="3"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                      placeholder="Ceritakan jenis hewan yang pernah dipelihara dan pengalaman Anda">{{ old('detail_pengalaman') }}</textarea>
                        </div>

                        <!-- Hewan Lain di Rumah -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Apakah saat ini ada hewan lain di rumah? <span class="text-red-500">*</span>
                            </label>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="radio" name="hewan_lain" value="Ya" {{ old('hewan_lain') == 'Ya' ? 'checked' : '' }} required class="mr-2">
                                    Ya, ada
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="hewan_lain" value="Tidak" {{ old('hewan_lain') == 'Tidak' ? 'checked' : '' }} required class="mr-2">
                                    Tidak ada
                                </label>
                            </div>
                        </div>

                        <!-- Detail Hewan Lain -->
                        <div>
                            <label for="detail_hewan_lain" class="block text-sm font-medium text-gray-700 mb-2">
                                Jika ada, sebutkan jenis dan jumlahnya
                            </label>
                            <input type="text" 
                                   id="detail_hewan_lain" 
                                   name="detail_hewan_lain" 
                                   value="{{ old('detail_hewan_lain') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Contoh: 2 kucing, 1 anjing">
                        </div>

                        <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 pt-6">Alasan dan Komitmen</h3>

                        <!-- Alasan Adopsi -->
                        <div>
                            <label for="alasan_adopsi" class="block text-sm font-medium text-gray-700 mb-2">
                                Mengapa Anda ingin mengadopsi {{ $adopsi->nama_hewan }}? <span class="text-red-500">*</span>
                            </label>
                            <textarea id="alasan_adopsi" 
                                      name="alasan_adopsi" 
                                      required 
                                      rows="4"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                      placeholder="Jelaskan motivasi dan alasan Anda ingin mengadopsi hewan ini">{{ old('alasan_adopsi') }}</textarea>
                        </div>

                        <!-- Komitmen Waktu -->
                        <div>
                            <label for="komitmen_waktu" class="block text-sm font-medium text-gray-700 mb-2">
                                Berapa jam per hari Anda bisa meluangkan waktu untuk hewan ini? <span class="text-red-500">*</span>
                            </label>
                            <select id="komitmen_waktu" 
                                    name="komitmen_waktu" 
                                    required 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">-- Pilih Waktu --</option>
                                <option value="1-2 jam" {{ old('komitmen_waktu') == '1-2 jam' ? 'selected' : '' }}>1-2 jam</option>
                                <option value="3-4 jam" {{ old('komitmen_waktu') == '3-4 jam' ? 'selected' : '' }}>3-4 jam</option>
                                <option value="5-6 jam" {{ old('komitmen_waktu') == '5-6 jam' ? 'selected' : '' }}>5-6 jam</option>
                                <option value="Lebih dari 6 jam" {{ old('komitmen_waktu') == 'Lebih dari 6 jam' ? 'selected' : '' }}>Lebih dari 6 jam</option>
                            </select>
                        </div>

                        <!-- Rencana Perawatan -->
                        <div>
                            <label for="rencana_perawatan" class="block text-sm font-medium text-gray-700 mb-2">
                                Bagaimana rencana Anda dalam merawat hewan ini? <span class="text-red-500">*</span>
                            </label>
                            <textarea id="rencana_perawatan" 
                                      name="rencana_perawatan" 
                                      required 
                                      rows="4"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                      placeholder="Jelaskan rencana makanan, kesehatan, aktivitas, dan perawatan lainnya">{{ old('rencana_perawatan') }}</textarea>
                        </div>

                        <!-- Persetujuan -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="space-y-3">
                                <label class="flex items-start">
                                    <input type="checkbox" name="setuju_kunjungan" value="1" {{ old('setuju_kunjungan') ? 'checked' : '' }} required class="mr-3 mt-1">
                                    <span class="text-sm">Saya bersedia dikunjungi oleh tim SafePaws untuk verifikasi kondisi rumah dan kesiapan adopsi</span>
                                </label>
                                <label class="flex items-start">
                                    <input type="checkbox" name="setuju_followup" value="1" {{ old('setuju_followup') ? 'checked' : '' }} required class="mr-3 mt-1">
                                    <span class="text-sm">Saya bersedia memberikan update berkala tentang kondisi hewan yang diadopsi</span>
                                </label>
                                <label class="flex items-start">
                                    <input type="checkbox" name="setuju_tanggung_jawab" value="1" {{ old('setuju_tanggung_jawab') ? 'checked' : '' }} required class="mr-3 mt-1">
                                    <span class="text-sm">Saya berkomitmen untuk merawat hewan ini dengan baik dan bertanggung jawab penuh</span>
                                </label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end space-x-4 pt-6">
                            <a href="{{ route('adopsi.show', $adopsi->id) }}" 
                               class="px-6 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="px-6 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Kirim Pengajuan Adopsi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>