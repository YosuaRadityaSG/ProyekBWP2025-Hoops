@extends('layouts.app')

@section('content')
    <h2>Selamat Datang di Hooks!</h2>
    <p>Silahkan masuk dengan akun yang sudah terdaftar atau buat akun baru.</p>

    {{-- TAMBAHAN: Untuk menampilkan pesan error atau sukses --}}
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <hr>
    <h4>Pilih Akun:</h4>
    @foreach($users as $user)
        <form action="{{ route('login.handle') }}" method="POST" style="margin-bottom:10px;">
            @csrf
            <input type="hidden" name="email" value="{{ $user->email }}">
            <button type="submit">
                Masuk sebagai {{ $user->nickname }} ({{ $user->email }})
            </button>
        </form>
    @endforeach

    <hr>
    <h4>Belum punya akun?</h4>
    <a href="{{ route('register.email') }}">
        <button>Buat Akun Baru</button>
    </a>
@endsection