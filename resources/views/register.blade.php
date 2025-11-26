<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
</head>
<body>
    <div class="p-5">
        <div class="flex justify-between px-2 mt-5 mb-5 ">
            <h1 class="title-text"> Create an Admin Account</h1>
        </div>
        <div class="bg-[#292626] p-8 rounded-lg shadow-md">

            @if ($errors->any())
                <div id="validation-errors" class="hidden">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form id="createForm" method="POST" action="{{ route('register.store') }}">
                @csrf

                <div class="mb-4">
                    <label for="name" class="label-design">Full Name</label>
                    <input type="text" id="fname" name="name" placeholder="Enter Full Name" class="input-design"
                        required value="{{ old('name') }}">
                </div>

                <div class="mb-4">
                    <label for="email" class="label-design">Enter Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter Email" class="input-design" required
                        value="{{ old('email') }}">
                </div>

                <div class="mb-4">
                    <label for="password" class="label-design">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter Password"
                        class="input-design" required>
                </div>

                <div class="">
                    <label for="confirm_password" class="label-design">Confirm
                        Password
                    </label>
                    <input type="password" id="confirm_password" name="password_confirmation"
                        placeholder="Confirm Password" class="input-design" required>
                </div>

                <button type="submit" class="submit-design mt-5"> Create Account </button>
            </form>
    </div>
</body>

</html>