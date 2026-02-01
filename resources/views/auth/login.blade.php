@extends('layout.layout')
@section('title','index')
@section('content')

<form method="POST" action="{{ route('process.login') }}">
    @csrf

    <div>
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required autofocus>
        @error('email') <span>{{ $message }}</span> @enderror
    </div>

    <div>
        <label>Password</label>
        <input type="password" name="password" required>
        @error('password') <span>{{ $message }}</span> @enderror
    </div>

    <div>
        <input type="checkbox" name="remember">
        <label>Remember Me</label>
    </div>

    <button type="submit">Login</button>
</form>

@endsection
