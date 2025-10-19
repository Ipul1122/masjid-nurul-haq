@extends('layouts.penggunaMasjid')

@section('title', 'Donasi Yuk')

@section('content')

{{-- 
  CATATAN: 
  Kode ini menggunakan kelas-kelas dari Tailwind CSS. 
  Pastikan Tailwind CSS sudah terinstall dan terkonfigurasi dengan benar di proyek Laravel Anda.
--}}

<div class="mt-16 bg-green-50 font-sans p-8 md:py-12">
    <div class="container mx-auto max-w-6xl">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <div class="bg-white rounded-2xl shadow-lg p-8 flex flex-col justify-center items-center h-full">
                <h5 class="text-gray-500 text-sm font-medium uppercase tracking-wider mb-2">
                    Rekening Donasi
                </h5>
                <h2 class="text-4xl font-bold text-emerald-600 mb-4" id="rekening-nomor">
                    123 456 7890
                </h2>
                <p class="text-gray-600 mb-6">
                    a.n. Yayasan Masjid Nurul Haq (BNI)
                </p>
                <button 
                    id="copy-button"
                    onclick="copyToClipboard()"
                    class="w-full bg-emerald-500 text-white font-semibold py-3 px-6 rounded-lg hover:bg-emerald-600 transition-all duration-300 ease-in-out transform hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-opacity-50 flex items-center justify-center space-x-2">
                    <svg id="copy-icon-default" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                    <svg id="copy-icon-success" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <span id="copy-text">Salin Nomor Rekening</span>
                </button>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-8 h-full">
                <h3 class="text-2xl font-bold text-emerald-800 mb-6">
                    Cara Berdonasi
                </h3>
                
                <div class="space-y-6">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 bg-emerald-500 text-white font-bold w-9 h-9 rounded-full flex items-center justify-center mr-4">1</div>
                        <div class="pt-1 text-gray-700">Salin nomor rekening tujuan di samping.</div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="flex-shrink-0 bg-emerald-500 text-white font-bold w-9 h-9 rounded-full flex items-center justify-center mr-4">2</div>
                        <div class="pt-1 text-gray-700">Lakukan transfer melalui m-Banking atau ATM.</div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="flex-shrink-0 bg-emerald-500 text-white font-bold w-9 h-9 rounded-full flex items-center justify-center mr-4">3</div>
                        <div class="pt-1 text-gray-700">Simpan bukti transfer Anda (screenshot/foto).</div>
                    </div>

                    <div class="flex items-start border-t border-gray-200 pt-6 mt-6">
                        <div class="flex-shrink-0 bg-emerald-500 text-white font-bold w-9 h-9 rounded-full flex items-center justify-center mr-4">4</div>
                        <div class="w-full">
                            <strong class="text-gray-800">Konfirmasi Donasi Anda</strong><br>
                            <small class="text-gray-500 block mb-3">Ini bersifat opsional, namun akan membantu kami dalam pencatatan.</small>
                            <a href="{{ url('penggunaMasjid/donasi/kirimBukti') }}" class="mt-3 w-full bg-orange-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-orange-600 transition-colors duration-300 text-center block">
                                Kirim Bukti Transfer
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
function setSuccessState() {
    const copyButton = document.getElementById('copy-button');
    const copyText = document.getElementById('copy-text');
    const defaultIcon = document.getElementById('copy-icon-default');
    const successIcon = document.getElementById('copy-icon-success');
    const originalText = 'Salin Nomor Rekening';

    copyText.innerText = 'Berhasil Disalin!';
    defaultIcon.classList.add('hidden');
    successIcon.classList.remove('hidden');
    copyButton.classList.remove('bg-emerald-500', 'hover:bg-emerald-600');
    copyButton.classList.add('bg-emerald-700');

    setTimeout(() => {
        copyText.innerText = originalText;
        defaultIcon.classList.remove('hidden');
        successIcon.classList.add('hidden');
        copyButton.classList.add('bg-emerald-500', 'hover:bg-emerald-600');
        copyButton.classList.remove('bg-emerald-700');
    }, 2500);
}

function copyToClipboard() {
    const rekeningElement = document.getElementById('rekening-nomor');
    const rekeningText = rekeningElement.innerText.replace(/\s/g, '');

    if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(rekeningText).then(() => {
            setSuccessState();
        }).catch(err => {
            console.error('Gagal menyalin dengan navigator.clipboard: ', err);
        });
    } else {
        const textArea = document.createElement('textarea');
        textArea.value = rekeningText;
        
        textArea.style.position = 'fixed';
        textArea.style.top = '-9999px';
        textArea.style.left = '-9999px';

        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();

        try {
            document.execCommand('copy');
            setSuccessState();
        } catch (err) {
            console.error('Gagal menyalin dengan metode fallback: ', err);
            alert('Gagal menyalin. Mohon salin secara manual.');
        }

        document.body.removeChild(textArea);
    }
}
</script>
@endsection