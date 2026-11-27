@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <h2>Login</h2>
    <form method="POST" action="{{ route('login') }}" class="card">
        @csrf
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" autocomplete="username" required>
        @error('email') <div class="error">{{ $message }}</div> @enderror

        <label>Password</label>
        <input type="password" name="password" autocomplete="current-password" required>

        <button type="submit" class="btn">Masuk</button>
    </form>
@endsection
