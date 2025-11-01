<x-navigation>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: 'Success!',
                    text: "{{ session('success') }}",
                    icon: 'success',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#4CAF50'
                });
            });
        </script>
    @endif

    {{--  @if(session('deleted'))
        <script>
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Deleted!",
                        text: "{{ session('deleted') }}",
                        icon: "success"
                    });
                }
            });
        </script>
    @endif
        --}}


    <div>
        <div class="flex justify-between p-5 mb-5 h-20">
            <div>
                <h1 class="title-text">Membership Plans</h1>
            </div>
            <div>
                <button type="button"
                    class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                    <a href="{{ route('admin.membership.create') }}">
                        Create New Membership Tier
                    </a></button>
            </div>
        </div>

        <div class="grid grid-cols-[repeat(auto-fit,minmax(500px,1fr))] gap-4">
            @foreach($membershipPlans as $membershipPlan)
                <x-membershipPlanCard :membershipPlan="$membershipPlan">
                </x-membershipPlanCard>
            @endforeach
        </div>
    </div>
</x-navigation>

