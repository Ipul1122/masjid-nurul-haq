@extends('layouts.dkm')

@section('content')
<div class="container py-5">
    <h2>Dashboard Risnha</h2>
    <p>Selamat datang, {{ \App\Models\Risnha::find(session('risnha_id'))->username }} 👋</p>
    <a href="{{ route('risnha.logout') }}" class="btn btn-danger">Logout</a>
</div>
@endsection
