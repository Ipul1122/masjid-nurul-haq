@php
    // Mengambil data running text dari database
    $runningText = \App\Models\TampilanPenggunaMasjid\RunningText::first();
@endphp

{{-- Kondisi ini hanya akan menampilkan div jika data ada DAN content-nya tidak kosong --}}
@if($runningText && !empty($runningText->content))
<div class="shadow-lg sticky top-16 z-20 overflow-hidden" style="background-color: {{ $runningText->background_color }}; color: {{ $runningText->text_color }};">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="py-3">
            <p class="whitespace-nowrap animate-marquee">
                {{ $runningText->content }}
            </p>
        </div>
    </div>
</div>

<style>
@keyframes marquee {
    0% { transform: translateX(100%); }
    100% { transform: translateX(-100%); }
}
.animate-marquee {
    display: inline-block;
    padding-left: 100%; 
    animation: marquee 30s linear infinite;
}
</style>
@endif