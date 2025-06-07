<x-app-layout>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <html lang="en" class="scroll-smooth">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    
    <!-- Hero Section -->
    <section id="hero" class="bg-[#f8f5f0] min-h-screen flex items-center justify-center px-6">
        <div class="max-w-6xl w-full flex flex-col md:flex-row items-center justify-between">
        
        <!-- Text Side -->
        <div class="text-left md:w-1/2">
            <h1 class="text-6xl font-extrabold text-orange-700 leading-tight">SafePaws+</h1>
            <p class="text-lg text-gray-700 mb-7">Platform adopsi hewan peliharaan dan konsultasi dokter hewan</p>
            <div class="flex gap-4 flex-wrap">
                <a href="#about" class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-3 rounded-full font-semibold shadow-md transition">
                    Read More</a>
            </div>
        </div>

        <!-- Image Side -->
        <div class="md:w-1/2 flex justify-center mt-10 md:mt-0 relative">
        <img src="{{ asset('img/homecat.png') }}" alt="dashboard" class="w-80 h-auto object-contain z-10" />
        </div>
        
    </div>
    </section>

    <!-- Tentang Section -->
    <section id="about" class="py-20 bg-orange-50">
        <div class="max-w-5xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold text-orange-700 mb-2 relative inline-block after:block after:w-16 after:h-1 after:bg-orange-500 after:mt-2 after:mx-auto">
                About SafePaws+
            </h2>
            <p class="text-lg text-gray-700 leading-relaxed mb-10 mt-4">
                <strong>SafePaws+</strong> adalah mitra terpercaya bagi Anda yang peduli terhadap kesehatan dan kebahagiaan hewan peliharaan. 
                Kami menawarkan layanan medis lengkap seperti pemeriksaan rutin, vaksinasi, konsultasi, hingga perawatan lanjutan, 
                semua dilakukan oleh <span class="text-orange-600 font-semibold">dokter hewan profesional</span> di fasilitas yang modern dan nyaman.
                <br><br>
                Kami percaya bahwa setiap hewan adalah bagian dari keluarga. Oleh karena itu, SafePaws+ memberikan <span class="text-orange-600 font-semibold">pendekatan penuh kasih dan berbasis ilmu</span>, 
                agar hewan peliharaan Anda selalu sehat, bahagia, dan mendapatkan perawatan terbaik sesuai kebutuhannya.
            </p>

            <h3 class="text-2xl font-bold text-orange-600 mb-2 relative inline-block after:block after:w-12 after:h-1 after:bg-orange-500 after:mt-2 after:mx-auto">
                Our Mission
            </h3>
            <p class="text-md text-gray-600 leading-relaxed mt-4 mb-16">
                Misi kami adalah menciptakan ekosistem peduli hewan yang sehat, aman, dan bertanggung jawab. 
                Kami hadir untuk memudahkan akses layanan kesehatan hewan sekaligus memfasilitasi proses <span class="text-orange-700 font-semibold">adopsi hewan yang etis</span> dan penuh cinta.
                Dengan teknologi dan tenaga profesional, SafePaws+ menjadi jembatan antara pemilik, dokter hewan, dan hewan-hewan yang membutuhkan rumah baru.
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10">
                <div class="flex flex-col items-center text-center group transition">
                    <div class="bg-orange-600 text-white rounded-full w-24 h-24 flex items-center justify-center text-4xl shadow-lg">
                        <i class="fas fa-paw"></i>
                    </div>
                    <h3 class="font-semibold text-lg text-gray-800 group-hover:text-orange-600 transition mt-4 leading-tight">
                        Adopsi Bertanggung Jawab
                    </h3>
                </div>
                <div class="flex flex-col items-center text-center group transition">
                    <div class="bg-orange-600 text-white rounded-full w-24 h-24 flex items-center justify-center text-4xl shadow-lg">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3 class="font-semibold text-lg text-gray-800 group-hover:text-orange-600 transition mt-4 leading-tight">
                        Dokter Berpengalaman
                    </h3>
                </div>
                <div class="flex flex-col items-center text-center group transition">
                    <div class="bg-orange-600 text-white rounded-full w-24 h-24 flex items-center justify-center text-4xl shadow-lg">
                        <i class="fas fa-stethoscope"></i>
                    </div>
                    <h3 class="font-semibold text-lg text-gray-800 group-hover:text-orange-600 transition mt-4 leading-tight">
                        Perawatan Penuh Kasih
                    </h3>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Service -->
    <section class="px-8 py-16 bg-white">
        <h2 class="text-3xl font-bold text-center mb-10">Our Services</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-16">
            <div class="bg-orange-100 p-6 rounded-xl shadow hover:shadow-lg transition">
                <img src="{{ asset('img/adopsi.jpg') }}" class="w-full h-64 object-cover rounded-lg mb-4" alt="Adopsi">
                <h3 class="text-2xl font-semibold text-orange-600">Adopsi Hewan</h3>
                <p class="text-gray-600 mt-2">Temukan hewan peliharaan yang siap diadopsi dan berikan mereka rumah baru.</p>
               <a href="{{ route('adopsi.index') }}" class="inline-block mt-4 bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded">
                Lihat Detail</a>
            </div>
            <div class="bg-orange-100 p-6 rounded-xl shadow hover:shadow-lg transition">
                <img src="{{ asset('img/dokter.jpg') }}" class="w-full h-64 object-cover rounded-lg mb-4" alt="Dokter">
                <h3 class="text-2xl font-semibold text-orange-500">Layanan Dokter</h3>
                <p class="text-gray-600 mt-2">Konsultasi dan temukan dokter hewan terpercaya di sekitarmu.</p>
                <a href="{{ route('dokter.index') }}" class="inline-block mt-4 bg-orange-600 hover:bg-orange-600 text-white px-4 py-2 rounded">
                Lihat Dokter</a>
            </div>
        </div>

           <!-- Artikel Preview Section -->
<section id="artikel" class="bg-white px-6 py-12">
    <h2 class="text-2xl font-bold text-orange-700 mb-6 text-center">Artikel Terbaru</h2>

    @if(isset($artikels) && $artikels->count())
        <div class="grid md:grid-cols-3 sm:grid-cols-2 gap-6">
            @foreach ($artikels->take(3) as $item)
                <div class="bg-white shadow rounded overflow-hidden">
                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="Artikel Image" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h2 class="text-lg font-bold text-orange-700">{{ $item->judul }}</h2>
                        <p class="text-gray-600 text-sm mt-1">{{ Str::limit($item->deskripsi, 100) }}</p>
                        <a href="{{ $item->link_artikel }}" target="_blank" class="text-blue-500 mt-2 inline-block">Baca selengkapnya</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-8">
            <a href="{{ route('artikel.index') }}" class="inline-block bg-orange-600 hover:bg-orange-700 text-white px-5 py-2 rounded font-semibold transition">
                Lihat Semua Artikel
            </a>
        </div>
    @else
        <p class="text-gray-500 text-center">Belum ada artikel yang tersedia.</p>
    @endif
</section>


   <!-- Contact Section -->
<section class="bg-[#FFE8DB] py-12 px-4">
    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Contact Form -->
        <div class="md:col-span-2 bg-[#FFF5F0] p-6 rounded-xl shadow">
            <h2 class="text-2xl font-bold text-[#9D4217] mb-4">SEND US A MESSAGE</h2>
            <form action="{{ route('contact.store') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                @csrf
                <!-- Name -->
                <div class="relative">
                    <i class="fas fa-user absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="text" name="name" placeholder="Name" value="{{ old('name') }}"
                        class="w-full pl-10 p-2 rounded border border-gray-300 bg-white text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#FF8750] transition @error('name') border-red-500 @enderror" required />
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="relative">
                    <i class="fas fa-envelope absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}"
                        class="w-full pl-10 p-2 rounded border border-gray-300 bg-white text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#FF8750] transition @error('email') border-red-500 @enderror" required />
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Message -->
                <div class="relative">
                    <i class="fas fa-comment-alt absolute left-3 top-3.5 text-gray-400"></i>
                    <textarea name="message" placeholder="Message" rows="3"
                        class="w-full pl-10 p-2 rounded border border-gray-300 bg-white text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#FF8750] transition @error('message') border-red-500 @enderror" required>{{ old('message') }}</textarea>
                    @error('message')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category -->
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('Category') }} <span class="text-red-500">*</span>
                    </label>
                    <select name="category" id="category" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#FF8750] transition @error('category') border-red-500 @enderror" required>
                        <option value="">{{ __('Select Category') }}</option>
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

                <!-- Photo Upload (Optional) -->
                <div>
                    <label for="photo" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('Upload Photo') }} <span class="text-gray-500">({{ __('Optional') }})</span>
                    </label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-gray-400 transition-colors">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600">
                                <label for="photo" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                    <span>{{ __('Upload file') }}</span>
                                    <input id="photo" name="photo" type="file" accept="image/*" class="sr-only">
                                </label>
                                <p class="pl-1">{{ __('or drag and drop') }}</p>
                            </div>
                            <p class="text-xs text-gray-500">
                                {{ __('PNG, JPG, JPEG up to 2MB') }}
                            </p>
                        </div>
                    </div>
                    @error('photo')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="bg-red-600 text-white px-5 py-2 rounded hover:bg-red-700 transition font-semibold">
                    Send
                </button>
            </form>
        </div>

        <!-- Contact Info -->
        <div class="bg-[#FFF5F0] p-4 rounded-xl shadow h-fit self-start">
            <h2 class="text-2xl font-bold text-[#9D4217] mb-4">CONTACT US</h2>
            <div class="space-y-5 text-gray-700 text-sm">

                <div class="flex space-x-4">
                    <div class="bg-red-600 text-white w-12 h-12 rounded flex items-center justify-center text-xl">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div>
                        <p class="text-base font-bold text-[#9D4217]">ADDRESS</p>
                        <p class="mt-1 leading-5">
                            UPN Veteran Jawa Timur,<br />
                            Jl. Raya Rungkut Madya, Gunung Anyar,<br />
                            Surabaya, Indonesia 
                        </p>
                    </div>
                </div>

                <div class="flex space-x-4">
                    <div class="bg-red-600 text-white w-12 h-12 rounded flex items-center justify-center text-xl">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div>
                        <p class="text-base font-bold text-[#9D4217]">EMAIL</p>
                        <p class="mt-1 leading-5">safepaws@gmail.com</p>
                    </div>
                </div>

                <div class="flex space-x-4">
                    <div class="bg-red-600 text-white w-12 h-12 rounded flex items-center justify-center text-xl">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <div>
                        <p class="text-base font-bold text-[#9D4217]">PHONE</p>
                        <p class="mt-1 leading-5">+62 81 2345 6789</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

</x-app-layout>