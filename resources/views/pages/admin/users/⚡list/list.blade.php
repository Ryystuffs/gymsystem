<div>
    <div class="flex flex-col md:flex-row justify-between items-center md:items-end mb-5 mt-7 space-y-4 md:space-y-0">
        <div class="flex flex-wrap items-center gap-2">
            <form wire:submit.prevent="applyFilter" class="flex flex-col space-y-3 mb-0">
                <div>
                    <span class="text-white">Filter By:</span>
                    <input type="text"
                        wire:model.live.debounce.300ms="searchName"
                        placeholder="Search name..."
                        class="ml-3 h-8 w-52 px-3 py-2 rounded-lg bg-[#403c3c] text-white border border-[#505050] focus:outline-none">
                </div>

                <div class="flex flex-wrap items-center gap-3">
                    <span class="text-white">Start Date:</span>
                    <input type="date" wire:model.live="startDate" class="h-8 w-40 rounded-lg bg-[#403c3c] text-white border border-[#505050]">

                    <span class="text-white">End Date:</span>
                    <input type="date" wire:model.live="endDate" class="h-8 w-40 rounded-lg bg-[#403c3c] text-white border border-[#505050]">

                    <button type="submit" class="h-8 w-20 bg-[#403c3c] text-white rounded-lg hover:bg-[#5d5a5a] transition">
                        Filter
                    </button>

                    <button wire:click="resetFilter" type="button" class="h-8 w-20 bg-[#292626] text-white rounded-lg hover:bg-[#5d5a5a] transition">
                        Reset
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-[#292626] border border-[#2d2eb4] mb-3 rounded-lg">
            <thead class="bg-[#403c3c] font-bold text-white h-14">
                <tr class="text-center">
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Timestamp</th>
                </tr>
            </thead>
            <tbody>
                @forelse($this->users as $user)
                    <tr wire:key="users-{{ $user->id }}" class="text-center border-t border-gray-600">
                        <td class="text-[#fdfdfd] font-bold p-4">{{ $user->name }}</td>
                        <td class="text-[#fdfdfd]">{{ $user->email }}</td>
                        <td class="text-[#fdfdfd] capitalize">{{ $user->role }}</td>
                        <td class="text-[#fdfdfd]">{{ $user->created_at->format('M d, Y g:i A') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-4 text-white text-center">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5" wire:key="pagination-container">
        {{ $this->users->links() }}
    </div>
</div>