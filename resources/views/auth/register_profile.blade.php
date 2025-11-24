@extends('layouts.app')

@section('content')
    <h2>Langkah 2: Lengkapi Profil Anda</h2>
    
    <form action="{{ route('register.profile.handle') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nickname">Nickname</label>
            <input type="text" id="nickname" name="nickname" required>
        </div>
        <div class="form-group">
            <label for="birth_date">Tanggal Lahir</label>
            <input type="date" id="birth_date" name="birth_date" required>
        </div>
        <div class="form-group">
            <label for="gender">Gender Anda</label>
            <select id="gender" name="gender" required>
                <option value="man">Man</option>
                <option value="woman">Woman</option>
            </select>
        </div>
        <div class="form-group">
            <label for="country">Negara</label>
            <input type="text" id="country" name="country" required value="Indonesia">
        </div>
         <div class="form-group">
            <label for="friend_preference_gender">Preferensi Teman (Gender)</label>
            <select id="friend_preference_gender" name="friend_preference_gender" required>
                <option value="man">Man</option>
                <option value="woman">Woman</option>
                <option value="everyone">Everyone</option>
            </select>
        </div>
        <div class="form-group">
            <label for="friend_preference_location">Preferensi Teman (Lokasi)</label>
            <select id="friend_preference_location" name="friend_preference_location" required>
                <option value="local">Negara Sendiri</option>
                <option value="worldwide">Seluruh Dunia</option>
            </select>
        </div>
        <div class="form-group">
            <label for="profile_picture_url">URL Foto Profil (opsional)</label>
            <input type="text" id="profile_picture_url" name="profile_picture_url">
        </div>
        <div class="form-group">
            <label>Minat Anda (Pilih minimal 1)</label>
            @foreach($interests as $interest)
                <div>
                    <input type="checkbox" name="interests[]" value="{{ $interest->id }}" id="interest_{{ $interest->id }}">
                    <label for="interest_{{ $interest->id }}" style="font-weight:normal;">{{ $interest->name }} ({{$interest->category}})</label>
                </div>
            @endforeach
            @error('interests') <div class="error-message">{{ $message }}</div> @enderror
        </div>

        <button type="submit">Selesai & Masuk</button>
    </form>
@endsection