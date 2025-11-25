<body class="bg-[#010001] font-sans text-[#fdfdfd] pt-5">
    <x-navigation>
        <div class="max-w-screen mx-auto">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                <h1 class="text-3xl font-bold text-[#fdfdfd]">Dashboard</h1>
                <p class="text-2xl text-[#fdfdfd] mt-2 md:mt-0">Welcome back, Admin {{Auth::user()->name}}</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

                <div class="dashboard-card">
                    <div class="p-3 bg-blue-200 rounded-xl">
                        <img src="{{ asset('images/memberBlack.png') }}" alt="Members Icon" class="w-20 h-20">
                    </div>
                    <div class="m-2">
                        <h3 class="text-lg font-semibold text-[#fdfdfd]">Total Active Members</h3>
                        <p class="dashboard-stat-number">{{$members}}</p>
                    </div>
                </div>

                <div class="dashboard-card">
                    <div class="p-3 bg-green-200 rounded-xl">
                        <img src="{{ asset('images/accountBlack.png') }}" alt="User Accounts Icon" class="w-20 h-20">
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-[#fdfdfd]">Total User</h3>
                        <p class="dashboard-stat-number">{{$user}}</p>
                    </div>
                </div>

                <div class="dashboard-card">
                    <div class="p-3 bg-violet-200 rounded-xl">
                        <img src="{{ asset('images/membershipBlack.png') }}" alt="Plans Icon" class="w-20 h-20">
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-[#fdfdfd]">Membership Plans</h3>
                        <p class="dashboard-stat-number">{{$plans}}</p>
                    </div>
                </div>

                <div class="dashboard-card">
                    <div class="p-3 bg-yellow-200 rounded-xl">
                        <img src="{{ asset('images/revenueBlack.png') }}" alt="Plans Icon" class="w-20 h-20">
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-[#fdfdfd]">Total Revenue</h3>
                        <p class="dashboard-stat-number">₱ {{ $total}}</p>
                    </div>
                </div>

            </div>

            <div class="flex flex-col lg:flex-row gap-4 mb-8">

                <div class="flex-1 bg-[#292626] p-6 rounded-xl shadow-sm">
                    <div class="flex items-center text-center justify-between mb-4">
                        <h2 class="text-2xl font-semibold text-[#fdfdfd]">Revenue Report</h2>
                    </div>
                    <canvas id="BarGraph" class="h-[500px]"></canvas>
                </div>

                <div
                    class="w-auto lg:w-[auto] bg-[#292626] px-15 py-3 rounded-xl shadow-sm flex flex-col justify-center">

                    <h2 class="text-lg font-semibold text-[#fdfdfd] mb-4 text-center">Today's Session</h2>
                    <div class="flex justify-center">
                        <canvas id="PieChart" class="h-[115px] text-[#fdfdfd]"></canvas>
                    </div>

                    <h2 class="pt-3 text-lg font-semibold text-[#fdfdfd] mb-4 text-center">Members Membership</h2>
                    <div class="flex justify-center">
                        <canvas id="pie2nd" class="h-[115px] text-[#fdfdfd]"></canvas>
                    </div>

                </div>

            </div>

            <div class="flex-1 bg-[#292626] p-6 rounded-xl shadow-sm">
                <div class="flex flex-row justify-between">
                    <h2 class="text-2xl font-semibold text-[#fdfdfd]">Session Reports (Daily)</h2>

                    <form method="GET" class="mb-4">
                        <input type="month" name="month" value="{{ $selectedMonth }}"
                            class="border border-gray-500 text-white rounded rounded-xl p-1">
                        <button class="px-3 py-1 bg-blue-500 text-white rounded">View</button>
                    </form>
                </div>

                <div class="flex justify-center">
                    <canvas id="sessionChart" class="h-[300px] w-full"></canvas>
                </div>
            </div>

        </div>



        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>

            console.log(@json($monthlyRevenue));
            console.log(@json($perPlan));

            console.log(@json($planLabels));
            const sessions = @json($sessions);
            const bar = document.getElementById('BarGraph').getContext('2d');
            const pie = document.getElementById('PieChart').getContext('2d');
            const pie2nd = document.getElementById('pie2nd').getContext('2d');
            const sessionChart = document.getElementById('sessionChart').getContext('2d');
            const gradient = sessionChart.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, "rgba(105,110,210,0.45)");
            gradient.addColorStop(1, "rgba(105,110,210,0.05)");

            new Chart(bar, {
                type: 'bar',
                data: {
                    datasets: [{
                        type: 'bar',
                        label: 'Monthly Revenue',
                        data: @json($monthlyRevenue),
                        backgroundColor: '#696ed2',
                    }],
                    labels: [
                        'January', 'February', 'March', 'April', 'May', 'June',
                        'July', 'August', 'September', 'October', 'November', 'December'
                    ]
                },

                options: {
                    plugins: {
                        legend: {
                            labels: {
                                color: "#ffffff",
                                font: { size: 14 }
                            }
                        },
                        tooltip: {
                            backgroundColor: "#1f1f1f",
                            titleColor: "#fff",
                            bodyColor: "#ccc",
                            borderColor: "#898df5",
                            borderWidth: 1,
                            padding: 10,
                            callbacks: {
                                label: function (context) {
                                    return " Revenue: ₱ " + context.raw;
                                }
                            }
                        }
                    },
                    responsive: true,

                    scales: {
                        x: {
                            ticks: {
                                color: "#ffffff",
                                font: { size: 13 }
                            },
                            grid: {
                                color: "rgba(255,255,255,0.08)"
                            }
                        },

                        y: {
                            beginAtZero: true,
                            ticks: {
                                color: "#ffffff",
                                font: { size: 13 }
                            },
                            grid: {
                                color: "rgba(255,255,255,0.08)"
                            }
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
                options: {
                    plugins: {
                        legend: {
                            labels: {
                                color: "#ffffff",
                                font: { size: 14 }
                            }
                        },
                        tooltip: {
                            titleColor: "#ffffff",
                            bodyColor: "#ffffff", 
                            backgroundColor: "#1f1f1f",
                        }
                    }
                }
            });

            new Chart(pie2nd, {
                type: 'doughnut',
                data: {
                    labels: @json($planLabels),
                    datasets: [{
                        data: @json(array_values($perPlan)),
                        borderWidth: 1
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            labels: {
                                color: "#ffffff",
                                font: { size: 14 }
                            }
                        },
                        tooltip: {
                            titleColor: "#ffffff",
                            bodyColor: "#ffffff", 
                            backgroundColor: "#1f1f1f",
                        }
                    }
                }
            });

            new Chart(sessionChart, {
                type: 'line',
                data: {
                    labels: @json($labels),
                    datasets: [{
                        label: 'Daily Sessions',
                        data: @json($dailySessions),

                        borderColor: '#898df5',
                        backgroundColor: gradient,
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,

                        shadowColor: '#898df5',
                        shadowBlur: 15,

                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#898df5',
                        pointRadius: 5,
                        pointHoverRadius: 7,
                        pointBorderWidth: 2,
                    }],
                },

                options: {
                    responsive: true,
                    maintainAspectRatio: false,

                    plugins: {
                        legend: {
                            labels: {
                                color: "#ffffff",
                                font: { size: 14 }
                            }
                        },
                        tooltip: {
                            backgroundColor: "#1f1f1f",
                            titleColor: "#fff",
                            bodyColor: "#ccc",
                            borderColor: "#898df5",
                            borderWidth: 1,
                            padding: 10,
                            callbacks: {
                                label: function (context) {
                                    return " Sessions: " + context.raw;
                                }
                            }
                        }
                    },

                    scales: {
                        x: {
                            grid: {
                                color: "rgba(255,255,255,0.08)"
                            },
                            ticks: {
                                color: "#e0e0e0",
                                font: { size: 13 }
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: "rgba(255,255,255,0.08)"
                            },
                            ticks: {
                                color: "#e0e0e0",
                                font: { size: 13 }
                            }
                        }
                    }
                }
            });


        </script>

    </x-navigation>
</body>