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

    @if(session('deleted'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: 'Success!',
                    text: "{{ session('deleted') }}",
                    icon: 'success',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#4CAF50'
                });
            });
        </script>
    @endif

    <div>
        <div class="flex justify-between p-5 mb-5 h-20">
            <div>
                <h1 class="title-text">Membership Plans</h1>
            </div>
            <div>
                <a href="{{ route('admin.membership.create') }}"
                    class="text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                    Create New Membership Tier
                </a>
            </div>
        </div>

        @foreach($membershipPlans as $membershipPlan)
            <x-membershipPlanCard :membershipPlan="$membershipPlan">
            </x-membershipPlanCard>
        @endforeach
    </div>
</x-navigation>