<body class="bg-gray-100 font-sans text-gray-800 pt-5">
    <x-navigation>
        <div class="max-w-screen mx-auto">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
                <p class="text-2xl text-gray-500 mt-2 md:mt-0">Welcome back, Admin {{Auth::user()->name}}</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

                <div class="flex items-center gap-4 p-0 bg-white">
                    <div class="p-3 bg-blue-200">
                        <img src="{{ asset('images/memberBlack.png') }}" alt="Members Icon" class="w-20 h-20">
                    </div>
                    <div class="m-2">
                        <h3 class="text-lg font-semibold text-gray-700">Total Active Members</h3>
                        <p class="text-2xl font-bold text-indigo-600">{{$members}}</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 p-0 bg-white">
                    <div class="p-3 bg-green-200">
                        <img src="{{ asset('images/accountBlack.png') }}" alt="User Accounts Icon" class="w-20 h-20">
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700">Total User</h3>
                        <p class="text-2xl font-bold text-green-600">{{$user}}</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 p-0 bg-white">
                    <div class="p-3 bg-violet-200">
                        <img src="{{ asset('images/membershipBlack.png') }}" alt="Plans Icon" class="w-20 h-20">
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700">Membership Plans</h3>
                        <p class="text-2xl font-bold text-violet-600">{{$plans}}</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 p-0 bg-white">
                    <div class="p-3 bg-yellow-200">
                        <img src="{{ asset('images/revenueBlack.png') }}" alt="Plans Icon" class="w-20 h-20">
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700">Total Revenue</h3>
                        <p class="text-2xl font-bold text-yellow-600">₱ {{ $total}}</p>
                    </div>
                </div>

            </div>

            <div class="flex flex-col lg:flex-row gap-4 mb-8">

                <div class="flex-1 bg-white p-6 rounded-xl shadow-sm">
                    <div class="flex items-center text-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-gray-700">Revenue</h2>
                    </div>
                    <canvas id="BarGraph" class="h-[500px]"></canvas>
                </div>

                <div class="w-auto lg:w-[auto] bg-white px-15 py-3 rounded-xl shadow-sm flex flex-col justify-center">
                    
                    <h2 class="text-lg font-semibold text-gray-700 mb-4 text-center">Today's Session</h2>
                    <div class="flex justify-center">
                        <canvas id="PieChart" class="h-[115px]"></canvas>
                    </div>

                    <h2 class="pt-3 text-lg font-semibold text-gray-700 mb-4 text-center">Today's Session</h2>
                    <div class="flex justify-center">
                        <canvas id="pie2nd" class="h-[115px]"></canvas>
                    </div>

                </div>

            </div>

        </div>



        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>

            console.log(@json($monthlyRevenue));

            console.log(@json($planLabels));
            const sessions = @json($sessions);
            const bar = document.getElementById('BarGraph').getContext('2d');
            const pie = document.getElementById('PieChart').getContext('2d');
            const pie2nd = document.getElementById('pie2nd').getContext('2d');

            new Chart(bar, {
                type: 'bar',
                data: {
                    datasets: [{
                        type: 'line',
                        label: 'Monthly Revenue',
                        data: @json($monthlyRevenue)
                    }],
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']
                },
                options: {
                    scales: {
                        y: {
                            suggestedMin: 5000,
                            suggestedMax: 20000
                        }
                    }   
                }
            });

            new Chart(pie, {
                type: 'pie',
                data: {
                    labels: ['Member', 'Non-Member'],
                    datasets: [{
                        data: sessions,
                        borderWidth: 1
                    }]
                },
            });

            new Chart(pie2nd, {
                type: 'doughnut',
                data: {
                    labels: @json($planLabels),
                    datasets: [{
                        data: [12, 19, 20, 30, 21, 34],
                        borderWidth: 1
                    }]
                },
            });

        </script>

    </x-navigation>
</body>