<style>
    .font-montserrat {
        font-family: 'Montserrat', sans-serif;
    }
    .font-quicksand {
        font-family: 'Quicksand', sans-serif;
    }
    .footer-link {
        position: relative;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .footer-link::before {
        content: '•';
        margin-right: 0px;
        width: 0;
        opacity: 0;
        transition: all 0.3s ease;
        color: #86efac; /* green-300 */
        font-size: 1.25rem;
        line-height: 1;
    }
    .footer-link:hover {
        transform: translateX(6px);
        color: #86efac !important; /* green-300 */
    }
    .footer-link:hover::before {
        width: 12px;
        margin-right: 6px;
        opacity: 1;
    }
</style>

<footer class="bg-green-600 text-white relative font-quicksand">
    <!-- Top Accent Bar -->
    <div class="h-1.5 bg-green-300 w-full"></div>
    
    <div class="container mx-auto px-6 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">

            <!-- Column 1: Brand Profile -->
            <div class="flex flex-col justify-between">
                <div>
                    <a href="{{ route('index') }}" class="flex items-center gap-3 mb-5 group">
                        <div class="h-14 w-14 rounded-2xl bg-white/10 backdrop-blur-md flex items-center justify-center p-2 border border-white/20 shadow-md group-hover:scale-105 transition-transform duration-300">
                            <img src="{{ asset('images/logo-masjid-nur-haq.png') }}" onerror="this.src='{{ asset('images/your-logo.png') }}'" alt="Logo Masjid" class="h-full w-full object-contain filter drop-shadow">
                        </div>
                        <div>
                            <h3 class="text-lg font-bold uppercase tracking-wider font-montserrat text-white leading-tight">Masjid</h3>
                            <span class="text-xs text-green-300 font-semibold tracking-widest font-montserrat">NURUL HAQ</span>
                        </div>
                    </a>

                    <p class="text-white/80 text-sm leading-relaxed mb-6 font-quicksand max-w-sm">
                        Menjadi pusat keagamaan serta teknologi dan kegiatan komunitas yang menebar rahmat dan manfaat bagi seluruh umat di lingkungan sekitar.
                    </p>
                </div>

                <!-- Social Media -->
                <div>
                    <h5 class="text-xs font-bold uppercase font-montserrat tracking-widest text-green-300 mb-3">Ikuti Kami</h5>
                    <div class="flex space-x-3">
                        <a href="#" title="Facebook" class="w-10 h-10 rounded-xl bg-white/10 hover:bg-green-300 hover:text-green-950 text-white flex items-center justify-center border border-white/10 hover:border-green-300 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg">
                            <i class="fab fa-facebook-f text-base"></i>
                        </a>
                        <a href="#" title="Instagram" class="w-10 h-10 rounded-xl bg-white/10 hover:bg-green-300 hover:text-green-950 text-white flex items-center justify-center border border-white/10 hover:border-green-300 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg">
                            <i class="fab fa-instagram text-base"></i>
                        </a>
                        <a href="#" title="Tiktok" class="w-10 h-10 rounded-xl bg-white/10 hover:bg-green-300 hover:text-green-950 text-white flex items-center justify-center border border-white/10 hover:border-green-300 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg">
                            <i class="fab fa-tiktok text-base"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Column 2: Main Navigation -->
            <div>
                <h4 class="text-lg font-bold mb-6 font-montserrat uppercase tracking-wider text-green-300 border-b border-white/10 pb-2 inline-block">
                    Navigasi Utama
                </h4>
                <ul class="space-y-3 font-quicksand">
                    <li>
                        <a href="{{ route('index') }}" class="footer-link text-white/90">Beranda</a>
                    </li>
                    <li>
                        <a href="{{ route('penggunaMasjid.lihatKonten.kontenMasjid') }}" class="footer-link text-white/90">Konten Masjid</a>
                    </li>
                    <li>
                        <a href="{{ route('penggunaMasjid.galeriMasjid.index') }}" class="footer-link text-white/90">Galeri Masjid</a>
                    </li>
                    <li>
                        <a href="{{ route('penggunaMasjid.risnhaMasjid.index') }}" class="footer-link text-white/90">Risnha (Remaja Masjid)</a>
                    </li>
                    <li>
                        <a href="{{ route('penggunaMasjid.kontakMasjid.index') }}" class="footer-link text-white/90">Kontak Masjid</a>
                    </li>
                </ul>
            </div>

            <!-- Column 3: Profile & DKM -->
            <div>
                <h4 class="text-lg font-bold mb-6 font-montserrat uppercase tracking-wider text-green-300 border-b border-white/10 pb-2 inline-block">
                    Profil & DKM
                </h4>
                <ul class="space-y-3 font-quicksand">
                    <li>
                        <a href="{{ route('penggunaMasjid.profile.visiMisiMasjid') }}" class="footer-link text-white/90">Visi & Misi</a>
                    </li>
                    <li>
                        <a href="{{ route('penggunaMasjid.profile.sejarahMasjid') }}" class="footer-link text-white/90">Sejarah Masjid</a>
                    </li>
                    <li>
                        <a href="{{ route('penggunaMasjid.profile.strukturDkm') }}" class="footer-link text-white/90">Struktur DKM</a>
                    </li>
                </ul>
            </div>

            <!-- Column 4: Layanan & Kontak -->
            <div>
                <h4 class="text-lg font-bold mb-6 font-montserrat uppercase tracking-wider text-green-300 border-b border-white/10 pb-2 inline-block">
                    Layanan & Kontak
                </h4>
                <ul class="space-y-3 font-quicksand">
                    <li>
                        <a href="{{ route('penggunaMasjid.donasi.index') }}" class="footer-link text-white/90">Donasi Online</a>
                    </li>
                    <li>
                        <a href="{{ route('penggunaMasjid.donasi.hasilDonasi') }}" class="footer-link text-white/90">Hasil Donasi</a>
                    </li>
                    <li>
                        <a href="{{ route('penggunaMasjid.keuanganMasjid.index') }}" class="footer-link text-white/90">Keuangan Masjid</a>
                    </li>
                </ul>
                
                <div class="mt-6 pt-4 border-t border-white/10">
                    <ul class="space-y-2.5 font-quicksand text-white/95 text-sm">
                        <li class="flex items-center gap-3 group">
                            <div class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center text-green-300 group-hover:bg-green-300 group-hover:text-green-950 transition-all duration-300">
                                <i class="fab fa-whatsapp"></i>
                            </div>
                            <span class="group-hover:text-green-300 transition-colors">0812-3456-xxxx</span>
                        </li>
                        <li class="flex items-center gap-3 group">
                            <div class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center text-green-300 group-hover:bg-green-300 group-hover:text-green-950 transition-all duration-300">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <a href="mailto:info@masjid.id" class="group-hover:text-green-300 transition-colors">info@masjid.id</a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>

    <!-- Copyright & Address Bar -->
    <div class="bg-green-300 text-green-950 font-quicksand py-6 border-t border-green-400/30">
        <div class="container mx-auto px-6 flex flex-col md:flex-row items-center justify-between gap-4 text-center md:text-left">
            <div class="text-sm font-semibold">
                &copy; {{ date('Y') }} DKM Masjid Nurul Haq. All Rights Reserved.
            </div>
            <div class="flex items-center gap-2.5 text-sm font-bold">
                <i class="fas fa-map-marker-alt text-green-700 animate-bounce"></i>
                <span>Jl. Alamat Lengkap Masjid, Kota, Provinsi</span>
            </div>
        </div>
    </div>
</footer>