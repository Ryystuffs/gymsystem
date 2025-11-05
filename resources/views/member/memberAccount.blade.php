<x-membernav >

    <div class="flex flex-col h-screen justify-center items-center ">
        <div class="text-black flex flex-col justify-center items-center p-9 bg-white rounded-4xl border-2 border-gray-600 w-4/5 min-h-[600px]">   
            <div class="flex flex-col justify-center items-center text-center">
                <span class="text-3xl font-bold">Qr Code:</span>
                <img src="{{ asset('storage/' . $user->qrcode) }}" alt="" class="my-5 w-[200px] h-[200px]">
            </div>
            <div class="mt-4">
                <h3>Direction of use:</h3>
                <p>1. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptas eos</p>
                <p> 2. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corrupti eos ipsum quo sapiente maxime,</p>
                <p>3. corrupti deserunt incidunt et, veniam at est, assumenda dignissimos architecto dolorum iste tempore qui eius fugit! Voluptatibus, sit!</p>
            </div>
        </div>

    </div>

</x-membernav>
