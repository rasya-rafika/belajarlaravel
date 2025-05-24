<x-app-layout>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Navbar -->
    <nav class="flex items-center justify-between px-8 py-4 bg-white shadow-md">
        <div class="text-2xl font-bold text-orange-600">SafePaws<span class="text-black">+</span></div>

        <ul class="flex items-center space-x-8 text-base font-medium text-gray-700">
            <li><a href="#" class="hover:text-orange-600 transition duration-300">Beranda</a></li>
            <li><a href="#dokter" class="hover:text-orange-600 transition duration-300">Cari Dokter</a></li>
            <li><a href="#adopsi" class="hover:text-orange-600 transition duration-300">Adopsi</a></li>
            <li><a href="#artikel" class="hover:text-orange-600 transition duration-300">Artikel</a></li>
            <li><a href="#kontak" class="hover:text-orange-600 transition duration-300">Kontak</a></li>
        </ul>

        <div class="flex items-center space-x-4">
            <span class="text-gray-600">juhar rafika</span>
            <a href="#" class="text-red-500 hover:underline">Logout</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-orange-200 to-orange-50 py-20">
        <div class="max-w-4xl mx-auto text-center px-4">
            <h1 class="text-5xl font-extrabold text-orange-700 mb-6">Selamat Datang di SafePaws+</h1>
            <p class="text-lg text-gray-700 mb-10">Platform konsultasi dokter hewan dan adopsi hewan peliharaan</p>
            <div class="flex justify-center gap-6 flex-wrap">
                <a href="#dokter" class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-3 rounded-full font-semibold shadow-md transition">Cari Dokter</a>
                <a href="#adopsi" class="bg-white text-orange-600 border-2 border-orange-600 hover:bg-orange-50 px-6 py-3 rounded-full font-semibold shadow-md transition">Adopsi Hewan</a>
            </div>
        </div>
    </section>

    <!-- Tentang Section -->
    <section id="tentang" class="py-20 bg-white">
        <div class="max-w-5xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold text-orange-700 mb-6">Tentang SafePaws+</h2>
            <p class="text-lg text-gray-600">SafePaws+ adalah platform digital yang membantu pengguna dalam mencari dokter hewan, mengadopsi hewan peliharaan, dan membaca artikel seputar dunia hewan. Kami mendukung adopsi dan perawatan hewan yang bertanggung jawab.</p>
        </div>
    </section>

    <!-- Artikel Section -->
    <section id="artikel" class="py-20 bg-orange-50">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-3xl font-bold text-orange-700 text-center mb-12">Artikel Terbaru</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition">
                    <img src="/images/artikel1.jpg" alt="Artikel 1" class="w-full h-48 object-cover">
                    <div class="p-5">
                        <h3 class="text-xl font-semibold text-orange-700 mb-2">World Wildlife Day</h3>
                        <p class="text-sm text-gray-600">Lindungi satwa liar demi masa depan bumi.</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition">
                    <img src="/images/artikel2.jpg" alt="Artikel 2" class="w-full h-48 object-cover">
                    <div class="p-5">
                        <h3 class="text-xl font-semibold text-orange-700 mb-2">Save the Wild!</h3>
                        <p class="text-sm text-gray-600">Bersama kita bisa menyelamatkan habitat mereka.</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition">
                    <img src="/images/artikel3.jpg" alt="Artikel 3" class="w-full h-48 object-cover">
                    <div class="p-5">
                        <h3 class="text-xl font-semibold text-orange-700 mb-2">Tips Adopsi Hewan</h3>
                        <p class="text-sm text-gray-600">Hal-hal yang perlu diperhatikan sebelum mengadopsi.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Kontak Section -->
    <section id="kontak" class="py-20 bg-white">
        <div class="max-w-4xl mx-auto text-center px-6">
            <h2 class="text-3xl font-bold text-orange-700 mb-6">Hubungi Kami</h2>
            <p class="text-gray-600 text-lg mb-6">Jika kamu memiliki pertanyaan atau membutuhkan bantuan, silakan hubungi kami melalui email di <a href="mailto:safepaws@support.com" class="text-orange-600 hover:underline">safepaws@support.com</a> atau isi form di halaman kontak.</p>
            <a href="#" class="inline-block bg-orange-600 text-white px-6 py-3 rounded-full hover:bg-orange-700 font-semibold shadow-md transition">
                Kontak Kami
            </a>
        </div>
    </section>
</x-app-layout>