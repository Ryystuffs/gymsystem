<form action="{{ route('password.update') }}" method="POST">

@csrf
<input type="email" name="email" id="email" required>
<input type="password" name="password" id="password" required>
<input type="password_confirmation" name="password_confirmation" id="password_confirmation" required>
<input type="hidden" name="token" value="{{ $token }}">

<button type="submit">Reset Password</button>

@if (session('status'))
    <div>{{ session('status') }}</div>
@endif

@error('email')
    <div>{{ $message }}</div>
@enderror
</form>