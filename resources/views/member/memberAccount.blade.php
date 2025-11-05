<x-membernav>

    <div class="flex flex-col h-screen justify-center items-center ">
        <div class="text-black flex flex-col justify-center items-center p-9 bg-[#f3f3f3] rounded-4xl border-2 border-gray-600 w-4/5 min-h-[600px]">
            <div class="flex flex-col justify-center items-center text-center">
                <span class="text-3xl font-bold">Qr Code:</span>
                <img src="{{ asset('storage/' . $user->qrcode) }}" alt="" class="my-5 w-[200px] h-[200px]">
            </div>
            <div class="mt-4">
                <h3 class="text-2xl mb-1.5">Direction of Use:</h3>
                <p>1. Scan the QR code at the gym entrance scanner to check in. </p>
                <p>2. Wait for the confirmation message or blue light before entering.</p>
                <p>3. When leaving the gym, scan the same QR code again at the exit scanner to record your check-out time.</p>
            </div>
        </div>

    </div>

</x-membernav>
