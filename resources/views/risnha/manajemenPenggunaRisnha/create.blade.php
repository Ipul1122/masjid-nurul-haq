@extends('layouts.risnha')

@section('title', 'Tambah Pengguna Risnha')
@section('content')
<div class="container mt-4">
    <h3 class="mb-3">Tambah Pengguna Risnha</h3>

    <form action="{{ route('risnha.manajemenPenggunaRisnha.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" id="username" 
                   class="form-control @error('username') is-invalid @enderror" 
                   value="{{ old('username') }}" required>
            @error('username') 
                <div class="invalid-feedback">{{ $message }}</div> 
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" 
                   class="form-control @error('password') is-invalid @enderror" required>
            @error('password') 
                <div class="invalid-feedback">{{ $message }}</div> 
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('risnha.manajemenPenggunaRisnha.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
