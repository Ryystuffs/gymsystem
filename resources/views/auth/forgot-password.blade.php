<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Forgot Password</title>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
</head>

<body>
    <div class="min-h-screen bg-[#1E1E1E] flex flex-column items-center justify-center">
        <div class="bg-white shadow-lg rounded-2xl p-6 w-full max-w-md border border-gray-100">
            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="text-center pt-4 pb-10">
                    <h1 class="text-2xl font-bold">Forgot Password?</h1>
                    <h3 class="text-sm pt-2">Enter Email Address to receive verification link</h3>
                </div>

                <div class="flex flex-col">
                    
                    <input class="relative p-1 pl-8 border border-black rounded-md" type="email" name="email" placeholder="Enter Email Address" required>
                    <ion-icon class="absolute p-2" name="mail-outline"></ion-icon><br>

                    @if (session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif

                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror


                    <button class="p-1 bg-[#122D3D] rounded-md border border-black text-white" type="submit">Send Verification</button><br>
                    <a class="text-center" href="#"><button>Back to Login</button></a>
                </div>
            </form>
        </div>

    </div>
</body>

</html>