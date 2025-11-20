<body class="bg-[#010001]">
    <x-navigation>
        <div class="p-1">
            <div class="flex justify-between p-5 ">
                <h1 class="text-3xl font-bold text-[#fdfdfd]">Add New Membership Plan</h1>

                <a href="{{ route('admin.membership.index') }}" class="back-button">Back to Membership Plan</a>
            </div>

            <div class="bg-[#292626] p-8 rounded-lg shadow-md">

                <form method="POST" action="{{ route('admin.membership.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="PlanName" class="label-design">Plan Name</label>
                        <input type="text" id="PlanName" name="name" placeholder="Enter Plan Name" class="input-design"
                            required>
                    </div>

                    <div class="mb-4">
                        <label for="price" class="label-design">Price</label>
                        <input type="text" id="price" name="price" placeholder="Enter Price" class="input-design"
                            required>
                    </div>

                    <div class="mb-4">
                        <label for="expired_at" class="label-design">Duration</label>
                        <input type="number" id="duration" name="duration" placeholder="Duration in Days"
                            class="input-design" value="" required>
                    </div>

                    <div class="mb-6">
                        <label for="description" class="label-design">Description</label>
                        <textarea id="description" name="description" placeholder="Description"
                            class="resize-y-8 input-design" required></textarea>
                    </div>

                    <button type="submit" class="submit-design"> Create Membership Plan </button>
                </form>
            </div>
        </div>
    </x-navigation>
</body>