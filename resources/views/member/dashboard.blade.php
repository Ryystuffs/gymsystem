<x-membernav>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 bg-black p-7 h-screen place-items-center">
        <div class="p-10 bg-[#121212] min-h-[150px] w-[95%] md:w-[75%] md:h-[50%] rounded-lg text-white">
            Name: {{$user->name}}
        </div>
        <div class="p-10 bg-[#121212] min-h-[150px] w-[95%] md:w-[75%] md:h-[50%] rounded-lg text-white">
            Email: {{$user->email}}
        </div>
        <div class="p-10 bg-[#121212] min-h-[150px] w-[95%] md:w-[75%] md:h-[50%] rounded-lg text-white">
            Your active membership:{{$membership->membershipPlan->name}}
        </div>
    </div>
</x-membernav>
