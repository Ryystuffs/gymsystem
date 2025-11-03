<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
    <title>GainLab</title>
</head>

<body>

    <header class="fixed w-full bg-black px-5 py-2 z-50">
        <nav class="flex justify-between items-center w-[92%] mx-auto">

            <div>
                <a href="#Home">
                    <img src="{{ asset('images/logo.png') }}" alt="logo.png" class="w-16 cursor-pointer">
                </a>
            </div>

            <div
                class="nav-links fixed md:static top-[-100%] left-0 w-full md:w-auto h-[60vh] md:h-auto bg-black md:bg-transparent flex flex-col md:flex-row items-center px-5 md:px-0 justify-center transition-all duration-500 ease-in-out">
                <ul class="flex flex-col md:flex-row md:items-center gap-8 text-white text-center">
                    <li><a class="hover:underline" href="#Home">Home</a></li>
                    <li><a class="hover:underline" href="#Services">Services</a></li>
                    <li><a class="hover:underline" href="#About">About</a></li>
                </ul>
            </div>

            <div class="flex items-center gap-6">
                <a href="{{ route('auth.index') }}"
                    class="bg-black text-white px-6 py-3 rounded-full border border-[#2d2eb4] font-semibold hover:bg-gray-900">
                    Log in
                </a>
                <ion-icon onclick="onToggleMenu(this)" name="menu"
                    class="text-3xl bg-[#2d2eb4] cursor-pointer md:hidden p-1 rounded-md"></ion-icon>
            </div>
        </nav>
    </header>

    <section id="Home"
        class="flex flex-col md:flex-row items-center h-screen justify-between pt-32 pb-20 bg-black text-white px-6 md:px-20 bg-cover bg-center bg-no-repeat "
        style="background-image: url('{{ asset('images/gymBG.jpg') }}') ;">

        <div class="md:w-1/2 space-y-6 text-center md:text-left">
            <h1 class="text-5xl md:text-6xl font-bold leading-tight">
                FOREVER CHASING <br>
                THE <span class="text-[#2d2eb4]">PUMP</span>
            </h1>
            <p class="max-w-md mx-auto md:mx-0 text-lg">
                — where passion meets discipline, and every rep brings you closer to your strongest self.
            </p>
            <div class="space-x-4">
                <a href="{{ route('auth.index') }}"
                    class="bg-black text-white px-6 py-3 rounded-full border border-[#2d2eb4] font-semibold hover:bg-gray-900 transition">
                    Join Now
                </a>
                <a href="#About"
                    class="bg-black text-white px-6 py-3 rounded-full border border-[#2d2eb4] font-semibold hover:bg-gray-900 transition">
                    Learn More
                </a>
            </div>
        </div>
    </section>


    <section id="Services"
        class="p-9 bg-[#000030] text-white min-h-screen flex flex-col justify-center items-center space-y-12">
        <div class="text-center space-y-4">
            <h1 class="text-3xl md:text-5xl font-bold leading-tight">
                We offer competitive <br> equipment and facilities
            </h1>
            <p class="text-gray-300">
                Experience top-quality equipment and world-class facilities designed to help you train smarter and
                perform better.
            </p>
        </div>

        <div class="flex flex-wrap justify-center items-center gap-6">
            @for ($i = 0; $i < 4; $i++)
                <img class="w-32 sm:w-40 md:w-48 lg:w-56 object-contain" src="{{ asset('images/equipment.png') }}" alt="">
            @endfor
        </div>
    </section>

    <section id="About"
        class="flex flex-col md:flex-row bg-black text-white p-10 min-h-screen justify-center items-center gap-10">
        <div class="w-full md:w-1/2 flex justify-center">
            <img class="w-3/4 md:w-full max-w-sm md:max-w-lg rounded-lg object-contain"
                src="{{ asset('images/equipment.png') }}" alt="">
        </div>
        <div class="w-full md:w-1/2 text-center md:text-left space-y-6">
            <h1 class="text-3xl md:text-5xl font-bold leading-tight">Login. Scan. Train. <br> — Fitness Made Simple.
            </h1>
            <p class="text-gray-300">
                Your membership comes with a unique QR code that gives you secure, contactless entry to the gym.
                No need for keycards — just scan, enter, and start training.
            </p>
        </div>
    </section>

    <footer class="bg-white text-black py-8">
        <div class="max-w-6xl mx-auto px-6 space-y-8">

            <div class="flex flex-col md:flex-row items-center justify-between gap-8">

                <div class="flex flex-col md:flex-row items-center gap-4 text-center md:text-left">
                    <img class="h-16" src="{{ asset('images/logoblack.png') }}" alt="GainLab Logo">
                    <div>
                        <h3 class="font-semibold text-lg">Contact Us:</h3>
                        <div class="flex justify-center md:justify-start gap-4 mt-2 text-xl">
                            <ion-icon name="logo-facebook"></ion-icon>
                            <ion-icon name="logo-instagram"></ion-icon>
                            <ion-icon name="logo-twitter"></ion-icon>
                            <ion-icon name="logo-linkedin"></ion-icon>
                        </div>
                    </div>
                </div>

                <ul class="flex flex-wrap justify-center md:justify-end gap-4 text-sm font-medium text-gray-700">
                    <li><a href="#Home" class="hover:text-[#2d2eb4] transition">Home</a></li>
                    <li><a href="#Services" class="hover:text-[#2d2eb4] transition">Services</a></li>
                    <li><a href="#About" class="hover:text-[#2d2eb4] transition">About</a></li>
                </ul>
            </div>

            <hr class="border-gray-300">

            <div class="text-center text-sm text-gray-700">
                <p>&copy; GainLab 2025. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        const navLinks = document.querySelector('.nav-links');

        function onToggleMenu(icon) {
            icon.name = icon.name === 'menu' ? 'close' : 'menu';

            if (navLinks.style.top === '' || navLinks.style.top === '-100%') {
                navLinks.style.top = '5rem';
            } else {
                navLinks.style.top = '-100%'; 
            }
        }

        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) {
                navLinks.style.top = '0';
            } else {
                navLinks.style.top = '-100%';
            }
        });
    </script>
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</body>

</html>