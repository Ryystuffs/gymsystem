<body class="bg-[#010001]">
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


        <div class="p-5">
            <div class="flex justify-between px-2 mt-3 mb-0 h-20">
                <div>
                    <h1 class="title-text">Membership Plans</h1>
                </div>
                <div>
                    <button type="button" class="back-button">
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
</body>