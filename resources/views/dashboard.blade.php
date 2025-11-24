@extends('layouts.app')

@section('content')
    <h2>Selamat Datang di Halaman Utama, {{ $user->nickname }}!</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <p>Ini adalah data profil yang berhasil kamu daftarkan:</p>

    <ul style="list-style-type: none; padding: 0;">
        <li style="margin-bottom: 10px;"><strong>Email:</strong> {{ $user->email }}</li>
        <li style="margin-bottom: 10px;"><strong>Nickname:</strong> {{ $user->nickname }}</li>
        <li style="margin-bottom: 10px;"><strong>Tanggal Lahir:</strong> {{ $user->birth_date }}</li>
        <li style="margin-bottom: 10px;"><strong>Gender:</strong> {{ $user->gender }}</li>
        <li style="margin-bottom: 10px;"><strong>Negara:</strong> {{ $user->country }}</li>
        <li style="margin-bottom: 10px;"><strong>Mencari Teman:</strong> {{ $user->friend_preference_gender }} di lokasi {{ $user->friend_preference_location }}</li>
        <li style="margin-bottom: 10px;"><strong>Minat:</strong>
            @foreach($user->interests as $interest)
                <span style="background-color: #eee; padding: 2px 5px; border-radius: 3px; margin-right: 5px;">{{ $interest->name }}</span>
            @endforeach
        </li>
    </ul>

    <hr>
    
    <a href="{{ route('logout') }}">
        <button>Logout</button>
    </a>
@endsection