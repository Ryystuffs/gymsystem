<body class="bg-[#151f2f]">
    <x-membernav>
        <div class="mt-8 flex flex-col min-h-screen items-center justify-center px-4 py-2 bg-[#151f2f]">
            <div
                class="bg-[#f3f3f3] border-2 border-gray-600 rounded-3xl shadow-md w-auto max-w-md flex flex-col items-center text-center p-4">
                <img src="{{ asset('storage/' . $user->qrcode) }}" alt="QR Code"
                    class="w-70 h-70 sm:w-48 sm:h-48 my-4 rounded-lg object-contain">
                <span class="text-3xl sm:text-3xl font-bold text-black">Scan Me</span>
            </div>

            <div class="bg-[#151f2f] text-white p-6 mt-6 w-full max-w-md">
                <h3 class="text-xl sm:text-2xl font-semibold mb-3 text-white">Directions for Use:</h3>
                <ol class=" space-y-2 text-base sm:text-lg ">
                    <li>1. Scan the QR code at the gym entrance scanner to check in.</li>
                    <li>2. Wait for the confirmation message or blue light before entering.</li>
                    <li>3. When leaving the gym, scan the same QR code again at the exit scanner to record your
                        check-out
                        time.</li>
                </ol>
            </div>

        </div>
    </x-membernav>
</body>