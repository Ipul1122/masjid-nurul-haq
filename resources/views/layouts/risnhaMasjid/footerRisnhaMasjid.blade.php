<footer class="bg-emerald-800 text-white fixed-bottom">
    <div class="container mx-auto px-6 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

            <div>
                <a href="{{ route('index') }}" class="flex items-center mb-4 hover:bg-blue-600">
                    
                    <img src="{{ asset('images/logo-masjid-nur-haq.png') }}" alt="Logo Masjid Nurul Haq" class="h-16 w-16 mr-3">

                    <h3 class="text-2xl font-bold uppercase tracking-wider">Masjid Nurul Haq</h3>
                </a>

                <p class="text-gray-300 mb-4 max-w-md tracking-wider">
                    Menjadi pusat keagamaan serta teknologi dan kegiatan komunitas yang menebar rahmat dan manfaat bagi seluruh umat di lingkungan sekitar.
                </p>
            </div>

            <div>
                <h4 class="text-2xl font-bold mb-4 uppercase tracking-wider">Tautan Cepat</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('penggunaMasjid.lihatKonten.kontenMasjid') }}" class="text-gray-300 hover:bg-blue-600">Konten Masjid</a></li>
                    <li><a href="{{ route('penggunaMasjid.keuanganMasjid.index') }}" class="text-gray-300 hover:bg-blue-600">Keuangan Masjid</a></li>
                    <li><a href="{{ route('penggunaMasjid.galeriMasjid.index') }}" class="text-gray-300 hover:bg-blue-600">Galeri Masjid</a></li>
                    <li><a href="{{ route('penggunaMasjid.kontakMasjid.index') }}" class="text-gray-300 hover:bg-blue-600">Kontak Masjid</a></li>
                </ul>
            </div>
            
            <div>
                <h4 class="text-2xl font-bold mb-4 uppercase tracking-wider">Profil</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('penggunaMasjid.profile.visiMisiMasjid') }}" class="text-gray-300 hover:bg-blue-600">Visi & Misi</a></li>
                    <li><a href="{{ route('penggunaMasjid.profile.sejarahMasjid') }}" class="text-gray-300 hover:bg-blue-600">Sejarah Masjid</a></li>
                    <li><a href="{{ route('penggunaMasjid.donasi.index') }}" class="text-gray-300 hover:bg-blue-600">Donasi</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-2xl font-bold mb-4 uppercase tracking-wider">Hubungi Kami</h4>
                <ul class="space-y-2 text-gray-300">
                    <li class="flex items-center">
                        <i class="fab fa-whatsapp mr-3 w-4"></i> 0812-3456-7890
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-envelope mr-3 w-4"></i> info@nurulhaq.id
                    </li>
                </ul>
                <div class="flex space-x-4 mt-6">
                    <a href="#" title="Facebook" class="text-gray-300 hover:text-white transition-colors"><i class="fab fa-facebook-f fa-lg"></i></a>
                    <a href="#" title="Instagram" class="text-gray-300 hover:text-white transition-colors"><i class="fab fa-instagram fa-lg"></i></a>
                    <a href="#" title="Tiktok" class="text-gray-300 hover:text-white transition-colors"><i class="fab fa-tiktok fa-lg"></i></a>
                </div>
            </div>

        </div>
        
        <div class="mt-10 border-t border-emerald-700 pt-6 text-center text-gray-400">
            <p>&copy; {{ date('Y') }} DKM Masjid Nurul Haq. All Rights Reserved.
                <br>
                <i class="fas fa-map-marker-alt mt-1 mr-3"></i>
                <span>Jl. Rawa Bahagia I No. 8, Grogol, Kec. Grogol petamburan, 
                        Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta</span>
            </p>
        </div>
    </div>
</footer>