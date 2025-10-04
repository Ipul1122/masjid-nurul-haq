@extends('layouts.risnha')

@section('content')
<div class="container mt-4">
    <h3 class="mb-3">Edit Pengguna Risnha</h3>

    <form action="{{ route('risnha.manajemenPenggunaRisnha.update', $risnha->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" id="username" 
                   class="form-control @error('username') is-invalid @enderror" 
                   value="{{ old('username', $risnha->username) }}" required>
            @error('username') 
                <div class="invalid-feedback">{{ $message }}</div> 
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password (kosongkan jika tidak diganti)</label>
            <input type="password" name="password" id="password" 
                   class="form-control @error('password') is-invalid @enderror">
            @error('password') 
                <div class="invalid-feedback">{{ $message }}</div> 
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('risnha.manajemenPenggunaRisnha.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
