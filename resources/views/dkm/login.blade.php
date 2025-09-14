@extends('layouts.dkm') {{-- nanti kita bikin layout dasar --}}
@section('content')
<div class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-6 rounded-lg shadow w-96">
        <h2 class="text-2xl font-bold mb-4">Login DKM</h2>

        @if($errors->any())
            <div class="bg-red-100 text-red-600 p-2 rounded mb-3">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('dkm.login.submit') }}">
            @csrf
            <div class="mb-4">
                <label class="block mb-1">Username</label>
                <input type="text" name="username" class="w-full border px-3 py-2 rounded" required>
            </div>
            <div class="mb-4">
                <label class="block mb-1">Password</label>
                <input type="password" name="password" class="w-full border px-3 py-2 rounded" required>
            </div>
            <button class="bg-blue-600 text-black w-full py-2 rounded">Login</button>
        </form>
    </div>
</div>
@endsection
