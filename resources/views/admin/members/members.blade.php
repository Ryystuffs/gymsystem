<x-navigation>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session('created'))
        <div class="flex justify-center items-center text-center text-3xl text-green-500 p-5 mb-5 max-w-1xl">
            {{session('created')}}
        </div>
    @endif

    @if (session('success'))
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
        <div id="deleted-message">
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
        </div>
    @endif

    @if ($errors->any())
                    <div id="validation-errors" class="hidden">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

    <script>
        const errorContainer = document.getElementById('validation-errors');
            if (errorContainer) {
                const messages = Array.from(errorContainer.querySelectorAll('p')).map(p => p.textContent);
                if (messages.length > 0) {
                    Swal.fire({
                        title: 'Validation Error',
                        html: messages.join('<br>'),
                        icon: 'error',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#e3342f'
                    });
                }
        }
    </script>

    <div >
        <div class="flex justify-between p-5 ">
            <div>
                <h1 class="title-text">Members</h1>
            </div>
            <a href="{{ route('admin.members.create') }}"
                class="back-button">
                Add New Member
            </a>
        </div>

        <div class="grid grid-cols-[repeat(auto-fit,minmax(250px,1fr))] gap-4">
            @foreach($userMemberships as $userMembership)
                <x-membersCard :userMembership="$userMembership" :membershipPlans="$membershipPlans " :payments="$payments">
                </x-membersCard>
            @endforeach
        </div>
    </div>

    <div class="mt-5">
        {{ $userMemberships->links() }}
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
    @endpush

</x-navigation>
