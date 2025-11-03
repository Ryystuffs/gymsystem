<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <title>Reset Password</title>
</head>

<body>
    <div class="min-h-screen bg-[#1E1E1E] flex flex-column items-center justify-center">
        <div class="bg-white shadow-lg rounded-2xl p-6 pb-10 w-full max-w-md border border-gray-100">
            <form action="{{ route('password.update') }}" method="POST">

                <div class="flex flex-col">
                    @csrf

                    <div class="text-center pt-4 pb-10">
                        <h1 class="text-2xl font-bold">Reset Password</h1>
                        <h3 class="text-sm pt-2">Enter Your New Password</h3>
                    </div>

                    <input class="relative p-1 pl-8 border border-black rounded-md" type="email" name="email" id="email"
                        placeholder="Enter Email Address" required>
                    <ion-icon class="absolute pt-31 pl-2" name="mail-outline"></ion-icon><br>

                    <input class="relative p-1 pl-8 border border-black rounded-md" type="password" name="password"
                        id="password" placeholder="Enter Password" required>
                    <ion-icon class="absolute pt-46 pl-2" name="lock-closed-outline"></ion-icon><br>

                    <input class="relative p-1 pl-8 border border-black rounded-md" type="password"
                        name="password_confirmation" id="password_confirmation" placeholder="Password Confirmation"
                        required>
                    <ion-icon class="absolute pt-60 pl-2" name="lock-closed-outline"></ion-icon><br>
                 <!-- 
                    <div class="">
                        <label class="text-black text-sm">
                            <input type="checkbox" onclick="togglePassword()" class="h-3 w-3">
                            <span>Show Password</span>
                        </label>
                    </div>
                -->  
                        <input type="hidden" name="token" value="{{ $token }}">

                        <button class="p-1 bg-[#122D3D] rounded-md border border-black text-white" type="submit">Save
                            Password</button>

                        @if (session('status'))
                            <div>{{ session('status') }}</div>
                        @endif

                        @error('email')
                            <div>{{ $message }}</div>
                        @enderror
                    </div>
            </form>
        </div>
    </div>
    </div>
</body>

</html>