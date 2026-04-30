@section('pageTitle', 'Accounts')
@section('title', 'GainLab')
<div>
    <div
        class="flex flex-col md:flex-row justify-between items-center md:items-end mb-5 mt-7 space-y-4 md:space-y-0">

        <div class="flex flex-wrap items-center gap-2">

            <form wire:submit.prevent="tableFilter" class="flex flex-col space-y-3 mb-0">

                <div>
                    <span class="text-white">Filter By:</span>
                    <input type="text"
                        wire:model.live="searchName"
                        placeholder="Search name..."
                        class="ml-3 h-8 w-52 px-3 py-2 rounded-lg bg-[#403c3c] text-white placeholder-gray-300 border border-[#505050] focus:border-[#7a7adb] focus:outline-none transition">
                </div>

                <div class="flex flex-wrap items-center gap-3">

                    <span class="text-white">Start Date:</span>
                    <input type="date"
                        wire:model="startDate"
                        class="h-8 w-40 px-3 py-2 rounded-lg bg-[#403c3c] text-white border border-[#505050] focus:border-[#7a7adb] focus:outline-none transition">

                    <span class="text-white">End Date:</span>
                    <input type="date"
                        wire:model="endDate"
                        class="h-8 w-40 px-3 py-2 rounded-lg bg-[#403c3c] text-white border border-[#505050] focus:border-[#7a7adb] focus:outline-none transition">

                    <button type="submit"
                        class="h-8 w-20 bg-[#403c3c] hover:bg-[#5d5a5a] text-white border border-[#505050] rounded-lg transition">
                        Filter
                    </button>

                    <button wire:click="resetFilter" type="button"
                        class="h-8 w-20 bg-[#292626] hover:bg-[#5d5a5a] text-white border border-[#393535] rounded-lg transition">
                        Reset
                    </button>

                </div>
            </form>
        </div>
    </div>


    <table class="min-w-full bg-[#292626] border border-[#2d2eb4] mb-3 rounded-lg overflow-hidden">
        <thead class="bg-[#403c3c] font-bold text-white h-14">
            <tr class="text-center">
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Timestamp</th>
            </tr>
        </thead>
        <tbody>
            @foreach($this->users as $user)
                <tr class="text-center border-t border-gray-600">
                    <td class="text-[#fdfdfd] font-bold p-4">
                        {{ $user->name }}
                    </td>
                    <td class="text-[#fdfdfd]">{{ $user->email }}</td>
                    <td class="text-[#fdfdfd] capitalize">{{ $user->role }}</td>
                    <td class="text-[#fdfdfd]">{{ $user->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-5">
        {{ $this->users->links() }}
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: 'Success!',
                    text: "{{ session('success') }}",
                    icon: 'success',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#4CAF50',
                    background: '#292626',
                    color: '#fdfdfd',
                });
            });


        </script>

    @endif
</div>