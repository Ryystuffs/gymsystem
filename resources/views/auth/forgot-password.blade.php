<form action="{{ route('password.email') }}" method="POST">
    @csrf

    <label for="email">Email</label>
    <input type="email" name="email" placeholder="Email" required>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    @error('email')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    

    <button type="submit">Send</button>
 </form>