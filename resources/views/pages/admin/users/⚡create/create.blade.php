@section('pageTitle', 'Create Account')
@section('title', 'Create Account | GainLab')
<div>
    <div class="p-5">
        <div class="flex justify-between px-2 mt-5 mb-5 ">
            <h1 class="title-text">Create New Account</h1>
        </div>
        <div class="bg-[#292626] p-8 rounded-lg shadow-md">



            <form id="createForm" method="POST" action="{{ route('admin.createAnAccount.store') }}">
                @csrf

                <div class="mb-4">
                    <label for="name" class="label-design">Full Name</label>
                    <input type="text" id="fname" name="name" placeholder="Enter Full Name" class="input-design"
                        required value="{{ old('name') }}">
                </div>

                <div class="mb-4">
                    <label for="email" class="label-design">Enter Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter Email" class="input-design"
                        required value="{{ old('email') }}">
                </div>

                <div class="mb-4">
                    <label for="password" class="label-design">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter Password"
                        class="input-design" required>
                </div>

                <div class="">
                    <label for="confirm_password" class="label-design">Confirm
                        Password
                    </label>
                    <input type="password" id="confirm_password" name="password_confirmation"
                        placeholder="Confirm Password" class="input-design" required>
                </div>

                <div class="mb-4 mt-2">
                    <input class="accent-black" type="checkbox" onclick="togglePassword()">
                    <span class="text-[#fdfdfd]">Show Password</span>
                </div>

                <button type="submit" class="submit-design"> Create Account </button>
            </form>
        </div>
    </div>

    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const messages = @json($errors->all());
                Swal.fire({
                    title: 'Validation Error',
                    html: messages.join('<br>'),
                    icon: 'error',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#e3342f',
                    background: '#292626',
                    color: '#fdfdfd',
                });
            });
        </script>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const confirmPasswordField = document.getElementById('confirm_password');
            passwordField.type = passwordField.type === 'password' ? 'text' : 'password';
            confirmPasswordField.type = confirmPasswordField.type === 'password' ? 'text' : 'password';
        }

        document.addEventListener('DOMContentLoaded', function () {

            const form = document.getElementById('createForm');

            form.addEventListener('submit', function (e) {

                const password = document.getElementById('password').value;
                const confirm = document.getElementById('confirm_password').value;

                if (password !== confirm) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Validation Error',
                        text: 'Passwords do not match.',
                        icon: 'error',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#e3342f',
                        background: '#292626',
                        color: '#fdfdfd',
                    });
                    return;
                }

                const errorContainer = document.getElementById('validation-errors');
                if (errorContainer) {
                    const messages = Array.from(errorContainer.querySelectorAll('p'))
                        .map(p => p.textContent);

                    if (messages.length > 0) {
                        e.preventDefault();
                        Swal.fire({
                            title: 'Validation Error',
                            html: messages.join('<br>'),
                            icon: 'error',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#e3342f',
                            background: '#292626',
                            color: '#fdfdfd',
                        });
                    }
                }

            });
        });
    </script>
</div>