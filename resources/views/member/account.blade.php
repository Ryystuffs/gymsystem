<x-membernav>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 bg-white p-7 h-screen place-items-center">
        <div class="p-10 bg-[#121212] min-h-[150px] w-[95%] md:w-[75%] md:h-[50%] rounded-lg text-white">
            {{Auth::user()->name}}
        </div>
        <div class="lex flex-col items-center p-10 bg-[#121212] min-h-[150px] w-[95%] md:w-[75%] md:h-[50%] rounded-lg text-white">
            Your membership: 
            <div>
                Start Time: {{$membership->created_at->format('M d, Y')}}
            </div>
            <div>
                Expiry Date: {{$membership->expired_at->format('M d, Y')}}
            </div>
        </div>
        <div class="p-10 bg-[#121212] min-h-[150px] w-[95%] md:w-[75%] md:h-[50%] rounded-lg text-white">
            <div>
                Your active membership: {{$membership->membershipPlan->name}}
            </div>
            <div class="mt-3">
                Perks: {{$membership->membershipPlan->description}}
            </div>
        </div>
    </div>
</x-membernav>
