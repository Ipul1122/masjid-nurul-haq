@extends('layouts.dkm')

@section('title', 'Atur Running Text')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-1">Atur Running Text di Halaman Utama</h2>
    <p class="text-sm text-gray-500 mb-5">Teks ini akan berjalan di bagian atas halaman utama website. Anda dapat memformat teks dengan <strong>Bold</strong>, <em>Italic</em>, warna, dan tautan.</p>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('dkm.tampilanPenggunaMasjid.runningText.store') }}" method="POST" id="running-text-form">
        @csrf

        {{-- Hidden input yang menyimpan HTML dari editor --}}
        <input type="hidden" name="content" id="content-hidden">

        <div class="mb-4">
            <label class="block mb-2 text-sm font-medium text-gray-900">Isi Teks</label>

            {{-- ===== TOOLBAR ===== --}}
            <div id="editor-toolbar"
                 class="flex flex-wrap items-center gap-1 border border-gray-300 border-b-0 bg-gray-50 rounded-t-lg px-2 py-2">

                {{-- Bold --}}
                <button type="button" data-cmd="bold" title="Bold (Ctrl+B)"
                        class="toolbar-btn w-8 h-8 flex items-center justify-center rounded hover:bg-gray-200 transition font-bold text-gray-700 text-sm">
                    B
                </button>

                {{-- Italic --}}
                <button type="button" data-cmd="italic" title="Italic (Ctrl+I)"
                        class="toolbar-btn w-8 h-8 flex items-center justify-center rounded hover:bg-gray-200 transition italic text-gray-700 text-sm">
                    I
                </button>

                {{-- Divider --}}
                <span class="w-px h-5 bg-gray-300 mx-1"></span>

                {{-- Font Color --}}
                <label class="flex items-center gap-1 cursor-pointer" title="Warna Teks">
                    <span class="text-xs text-gray-600 font-medium">A</span>
                    <input type="color" id="font-color-picker" value="#000000"
                           class="w-6 h-6 rounded cursor-pointer border-0 p-0 bg-transparent"
                           style="min-width: 24px;">
                </label>

                {{-- Divider --}}
                <span class="w-px h-5 bg-gray-300 mx-1"></span>

                {{-- Insert Link --}}
                <button type="button" id="btn-insert-link" title="Sisipkan Tautan"
                        class="toolbar-btn flex items-center gap-1 px-2 h-8 rounded hover:bg-gray-200 transition text-gray-700 text-xs font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                    </svg>
                    Link
                </button>

                {{-- Remove Format --}}
                <button type="button" data-cmd="removeFormat" title="Hapus Format"
                        class="toolbar-btn flex items-center gap-1 px-2 h-8 rounded hover:bg-gray-200 transition text-gray-500 text-xs font-medium ml-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Hapus Format
                </button>
            </div>

            {{-- ===== EDITABLE AREA ===== --}}
            <div id="running-text-editor"
                 contenteditable="true"
                 class="min-h-[100px] p-3 w-full text-sm text-gray-900 bg-white border border-gray-300 rounded-b-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                 data-placeholder="Tulis pengumuman di sini..."
                 style="line-height: 1.6;"
            >{!! old('content', $runningText->content ?? '') !!}</div>
            <p class="text-xs text-gray-400 text-right mt-1">
                <span id="char-count">0</span> / 500 karakter
            </p>
        </div>

        {{-- ===== PREVIEW ===== --}}
        <div class="mb-5">
            <p class="text-xs font-medium text-gray-500 mb-1 uppercase tracking-wide">Preview Running Text:</p>
            <div class="overflow-hidden rounded-lg border border-gray-200 bg-emerald-600 py-3 px-4">
                <p id="running-text-preview" class="whitespace-nowrap text-white text-sm font-medium animate-marquee-preview">
                    {!! old('content', $runningText->content ?? '<span class="opacity-50">Teks akan tampil di sini...</span>') !!}
                </p>
            </div>
        </div>

        <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 transition-colors">
            Simpan Perubahan
        </button>
    </form>
</div>

{{-- Modal Insert Link --}}
<div id="link-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40">
    <div class="bg-white rounded-xl shadow-xl p-6 w-full max-w-sm mx-4">
        <h3 class="text-base font-bold text-gray-800 mb-4">Sisipkan Tautan</h3>
        <div class="mb-3">
            <label class="block text-sm font-medium text-gray-700 mb-1">Teks tampil</label>
            <input type="text" id="link-text-input"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                   placeholder="contoh: Kunjungi website kami">
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">URL</label>
            <input type="url" id="link-url-input"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                   placeholder="https://...">
        </div>
        <div class="flex gap-2 justify-end">
            <button type="button" id="link-cancel"
                    class="px-4 py-2 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg transition">
                Batal
            </button>
            <button type="button" id="link-insert"
                    class="px-4 py-2 text-sm text-white bg-blue-700 hover:bg-blue-800 rounded-lg transition">
                Sisipkan
            </button>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<style>
    #running-text-editor:empty::before {
        content: attr(data-placeholder);
        color: #9ca3af;
        pointer-events: none;
    }
    @keyframes marquee-preview {
        0%   { transform: translateX(100%); }
        100% { transform: translateX(-100%); }
    }
    .animate-marquee-preview {
        display: inline-block;
        animation: marquee-preview 15s linear infinite;
    }
</style>

<script>
    const editor       = document.getElementById('running-text-editor');
    const hiddenInput  = document.getElementById('content-hidden');
    const preview      = document.getElementById('running-text-preview');
    const form         = document.getElementById('running-text-form');
    const linkModal    = document.getElementById('link-modal');
    const colorPicker  = document.getElementById('font-color-picker');

    // ── Simpan selection sebelum modal dibuka ──
    let savedRange = null;

    function saveSelection() {
        const sel = window.getSelection();
        if (sel && sel.rangeCount > 0) {
            savedRange = sel.getRangeAt(0).cloneRange();
        }
    }
    function restoreSelection() {
        if (!savedRange) return;
        const sel = window.getSelection();
        sel.removeAllRanges();
        sel.addRange(savedRange);
    }

    // ── Toolbar buttons (Bold, Italic, RemoveFormat) ──
    document.querySelectorAll('.toolbar-btn[data-cmd]').forEach(btn => {
        btn.addEventListener('mousedown', e => {
            e.preventDefault(); // jangan hilangkan focus dari editor
            document.execCommand(btn.dataset.cmd, false, null);
            syncPreview();
        });
    });

    // ── Font Color ──
    colorPicker.addEventListener('input', () => {
        restoreSelection();
        document.execCommand('foreColor', false, colorPicker.value);
        syncPreview();
    });

    editor.addEventListener('mouseup', saveSelection);
    editor.addEventListener('keyup', () => { saveSelection(); syncPreview(); updateCharCount(); });
    editor.addEventListener('input', () => { syncPreview(); updateCharCount(); });

    // Simpan selection saat color picker difokus
    colorPicker.addEventListener('focus', saveSelection);

    // ── Insert Link ──
    document.getElementById('btn-insert-link').addEventListener('click', () => {
        saveSelection();
        const sel = window.getSelection();
        document.getElementById('link-text-input').value = sel && !sel.isCollapsed ? sel.toString() : '';
        document.getElementById('link-url-input').value  = '';
        linkModal.classList.remove('hidden');
        linkModal.classList.add('flex');
        document.getElementById('link-url-input').focus();
    });

    document.getElementById('link-cancel').addEventListener('click', closeLinkModal);
    linkModal.addEventListener('click', e => { if (e.target === linkModal) closeLinkModal(); });

    function closeLinkModal() {
        linkModal.classList.add('hidden');
        linkModal.classList.remove('flex');
    }

    document.getElementById('link-insert').addEventListener('click', () => {
        const linkText = document.getElementById('link-text-input').value.trim();
        const linkUrl  = document.getElementById('link-url-input').value.trim();
        if (!linkUrl) { alert('Silakan masukkan URL.'); return; }

        restoreSelection();
        editor.focus();

        const sel = window.getSelection();
        if (sel && !sel.isCollapsed) {
            // Bungkus teks yang dipilih dengan <a>
            document.execCommand('createLink', false, linkUrl);
            // Tambahkan target="_blank" secara manual
            const links = editor.querySelectorAll(`a[href="${linkUrl}"]`);
            links.forEach(a => {
                a.target = '_blank';
                a.rel    = 'noopener noreferrer';
                a.style.color = '#22c55e'; // emerald untuk running text
                a.style.textDecoration = 'underline';
            });
        } else {
            // Tidak ada teks terpilih — sisipkan link baru
            const a = document.createElement('a');
            a.href   = linkUrl;
            a.target = '_blank';
            a.rel    = 'noopener noreferrer';
            a.textContent = linkText || linkUrl;
            a.style.color = '#22c55e';
            a.style.textDecoration = 'underline';

            const range = savedRange || (sel && sel.getRangeAt(0));
            if (range) {
                range.collapse(false);
                range.insertNode(a);
                range.setStartAfter(a);
                range.setEndAfter(a);
                if (sel) { sel.removeAllRanges(); sel.addRange(range); }
            }
        }

        syncPreview();
        closeLinkModal();
    });

    // ── Sync preview & hidden input ──
    function syncPreview() {
        const html = editor.innerHTML;
        hiddenInput.value = html;
        preview.innerHTML = html || '<span style="opacity:.5">Teks akan tampil di sini...</span>';
    }

    // ── Counter karakter visible (tanpa HTML tags) ──
    const MAX_CHARS = 500;
    function updateCharCount() {
        const text  = editor.innerText || '';
        const count = text.replace(/\n/g, '').length;
        const el    = document.getElementById('char-count');
        el.textContent = count;
        if (count > MAX_CHARS) {
            el.classList.add('text-red-500', 'font-semibold');
            el.classList.remove('text-gray-400');
        } else {
            el.classList.remove('text-red-500', 'font-semibold');
            el.classList.add('text-gray-400');
        }
    }

    // Sync saat form disubmit
    form.addEventListener('submit', () => syncPreview());

    // Sync & count awal
    syncPreview();
    updateCharCount();
</script>
@endsection
