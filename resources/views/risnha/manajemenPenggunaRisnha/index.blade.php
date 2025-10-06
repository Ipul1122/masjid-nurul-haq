@extends('layouts.risnha')

@section('title', 'Manajemen Pengguna Risnha')
@section('content')
<div class="container mt-4">
    <h3 class="mb-3">Daftar Pengguna Risnha</h3>

    {{-- ✅ Tombol tambah pengguna hanya muncul jika login sebagai admin --}}
    @if(session('risnha_username') === 'admin')
        <a href="{{ route('risnha.manajemenPenggunaRisnha.create') }}" class="btn btn-primary mb-3">
            Tambah Pengguna
        </a>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($risnhas as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $user->username }}</td>
                    <td>
                        {{-- ✅ Jika admin login --}}
                        @if(session('risnha_username') === 'admin')
                            {{-- Admin bisa edit semua akun --}}
                            <a href="{{ route('risnha.manajemenPenggunaRisnha.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            {{-- Tapi akun admin utama tidak bisa dihapus --}}
                            @if($user->username !== 'admin')
                                <form action="{{ route('risnha.manajemenPenggunaRisnha.destroy', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus pengguna ini?')">Delete</button>
                                </form>
                            @endif

                        {{-- ✅ Jika user biasa, hanya bisa edit/hapus akun sendiri --}}
                        @elseif(session('risnha_id') == $user->id)
                            <a href="{{ route('risnha.manajemenPenggunaRisnha.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('risnha.manajemenPenggunaRisnha.destroy', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus akun Anda?')">Delete</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
