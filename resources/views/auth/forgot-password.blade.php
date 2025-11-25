<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Forgot Password</title>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="min-h-screen bg-[#121212] flex flex-column items-center justify-center">
        <div class="bg-white shadow-lg rounded-2xl p-6 w-full max-w-md border-1 border-gray-400">
            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="text-center pt-4 pb-10">
                    <h1 class="text-2xl font-bold">Forgot Password?</h1>
                    <h3 class="text-sm pt-2">Enter Email Address to receive verification link</h3>
                </div>

                <div class="flex flex-col">

                    <input class="relative p-1 pl-8 border border-black rounded-md" type="email" name="email"
                        placeholder="Enter Email Address">
                    <ion-icon class="absolute p-2" name="mail-outline"></ion-icon><br>

                    @if (session('status'))
                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                Swal.fire({
                                    title: 'Success!',
                                    text: "{{ session('status') }}",
                                    icon: 'success',
                                    confirmButtonText: 'OK',
                                    confirmButtonColor: '#4CAF50',
                                    background: '#292626',
                                    color: '#fdfdfd',
                                });
                            });
                        </script>
                    @endif

                    @error('email')
                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                Swal.fire({
                                    title: 'Error!',
                                    text: "{{ $message }}",
                                    icon: 'error',
                                    confirmButtonText: 'OK',
                                    confirmButtonColor: '#d33',
                                    background: '#292626',
                                    color: '#fdfdfd',
                                });
                            });
                        </script>
                    @enderror


                    <button class="p-1 bg-black rounded-md border border-black text-white" type="submit">Send
                        Verification</button><br>
                    <a class="text-center" href="{{ route('login') }}"><button>Back to Login</button></a>
                </div>
            </form>
        </div>

    </div>
</body>

</html>