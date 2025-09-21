@extends('layouts.dkm')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Notifikasi Aktivitas</h2>

    <ul class="divide-y">
        @forelse($activities as $activity)
            <li class="py-2">
                <strong>{{ $activity->causer?->name ?? 'Sistem' }}</strong>
                {{ $activity->description }}
                pada <span class="font-semibold">{{ $activity->log_name }}</span>
                <br>
                <small class="text-gray-500">
                    {{ $activity->created_at->diffForHumans() }}
                </small>

                {{-- Jika ingin detail perubahan --}}
                @if($activity->properties->has('attributes'))
                    <div class="text-sm text-gray-600 mt-1">
                        Perubahan: {{ json_encode($activity->properties['attributes']) }}
                    </div>
                @endif
            </li>
        @empty
            <li>Tidak ada aktivitas.</li>
        @endforelse
    </ul>
</div>
@endsection
