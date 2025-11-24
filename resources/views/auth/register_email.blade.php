@extends('layouts.app')

@section('content')
    <h2>Langkah 1: Buat Akun</h2>
    <p>Ini adalah simulasi membuat akun Google baru.</p>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('register.email.handle') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="{{ old('username') }}">
            @error('username') <div class="error-message">{{ $message }}</div> @enderror
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}">
            <div id="email-error" class="error-message"></div> <!-- Untuk pesan AJAX -->
            @error('email') <div class="error-message">{{ $message }}</div> @enderror
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
            @error('password') <div class="error-message">{{ $message }}</div> @enderror
        </div>
        <button type="submit">Lanjutkan</button>
    </form>
    
    <script>
        document.getElementById('email').addEventListener('blur', function() {
            let email = this.value;
            let errorElement = document.getElementById('email-error');
            
            if (email.length > 0) {
                fetch('{{ route("ajax.checkEmail") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ email: email })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.exists) {
                        errorElement.textContent = 'Email ini sudah terpakai!';
                    } else {
                        errorElement.textContent = '';
                    }
                });
            }
        });
    </script>
@endsection