@extends('layouts.admin-dashboard') @section('title', 'Admin Dashboard')
@section('content')

<div class="space-y-6">
    <!-- Greeting -->
    <div class="card bg-primary text-primary-content">
        <div class="card-body">
            <div class="flex items-center gap-4">
                <div class="bg-white/10 p-4 rounded-full">
                    <i data-lucide="shield" class="w-8 h-8"></i>
                </div>
                <div>
                    <h2 class="card-title text-2xl">
                        Welcome, {{ auth()->user()->name }}!
                    </h2>
                    <p class="text-primary-content/80">
                        Here's your graduate tracking overview
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <!-- Students -->
        <div
            class="card bg-base-100 shadow-sm border hover:shadow-md transition-shadow"
        >
            <div class="card-body">
                <div class="flex items-center gap-3">
                    <div class="bg-primary/10 p-3 rounded-lg">
                        <i data-lucide="users" class="w-6 h-6 text-primary"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-lg">Total Students</h3>
                        <p class="text-2xl font-bold">{{ $userCount }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Surveys -->
        <div
            class="card bg-base-100 shadow-sm border hover:shadow-md transition-shadow"
        >
            <div class="card-body">
                <div class="flex items-center gap-3">
                    <div class="bg-secondary/10 p-3 rounded-lg">
                        <i
                            data-lucide="clipboard-check"
                            class="w-6 h-6 text-secondary"
                        ></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-lg">Total Surveys</h3>
                        <p class="text-2xl font-bold">{{$response->count()}}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Employed -->
        <div
            class="card bg-base-100 shadow-sm border hover:shadow-md transition-shadow"
        >
            <div class="card-body">
                <div class="flex items-center gap-3">
                    <div class="bg-success/10 p-3 rounded-lg">
                        <i
                            data-lucide="briefcase"
                            class="w-6 h-6 text-success"
                        ></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-lg">Employed</h3>
                        <p class="text-2xl font-bold">{{ $employed }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Not Employed -->
        <div
            class="card bg-base-100 shadow-sm border hover:shadow-md transition-shadow"
        >
            <div class="card-body">
                <div class="flex items-center gap-3">
                    <div class="bg-error/10 p-3 rounded-lg">
                        <i data-lucide="user-x" class="w-6 h-6 text-error"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-lg">Not Employed</h3>
                        <p class="text-2xl font-bold">{{ $notEmployed }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Job Statistics -->
        <div class="card bg-base-100 shadow-sm border">
            <div class="card-body">
                <div class="flex items-center gap-3 mb-4">
                    <div class="bg-primary/10 p-3 rounded-lg">
                        <i
                            data-lucide="bar-chart-2"
                            class="w-6 h-6 text-primary"
                        ></i>
                    </div>
                    <h2 class="card-title">Job Statistics</h2>
                </div>
                <div class="h-[250px] w-full">
                    <canvas id="barCharts"></canvas>
                </div>
            </div>
        </div>

        <!-- Employment Status -->
        <div class="card bg-base-100 shadow-sm border">
            <div class="card-body">
                <div class="flex items-center gap-3 mb-4">
                    <div class="bg-secondary/10 p-3 rounded-lg">
                        <i
                            data-lucide="pie-chart"
                            class="w-6 h-6 text-secondary"
                        ></i>
                    </div>
                    <h2 class="card-title">Employment Status</h2>
                </div>
                <div class="flex justify-center items-center h-[300px]">
                    <div class="w-[280px] h-[280px]">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(auth()->user()->type === 'admin')
    <!-- Show all departments for super admin -->
    @foreach(['ccms', 'ceng', 'cba'] as $dept)
    <div class="card bg-base-100 shadow-sm border">
        <div class="card-body">
            <div class="flex items-center gap-3 mb-4">
                <div class="bg-primary/10 p-3 rounded-lg">
                    <i data-lucide="building" class="w-6 h-6 text-primary"></i>
                </div>
                <h2 class="card-title">
                    {{ strtoupper($dept) }} Courses (Answered Survey)
                </h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                @php $colors = ['primary', 'secondary', 'accent', 'info']; $i =
                0; @endphp @foreach($coursePercentages[$dept] as $course =>
                $percentage)
                <div class="stat bg-base-200 rounded-lg p-4">
                    <div class="stat-title">{{ $course }}</div>
                    <div
                        class="stat-value text-{{ $colors[$i++ % count($colors)] }}"
                    >
                        {{ $percentage }}%
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endforeach @else
    <!-- Show specific department for department users -->
    @if(in_array(auth()->user()->name, ['ccms', 'ceng', 'cba']))
    <div class="card bg-base-100 shadow-sm border">
        <div class="card-body">
            <div class="flex items-center gap-3 mb-4">
                <div class="bg-primary/10 p-3 rounded-lg">
                    <i data-lucide="building" class="w-6 h-6 text-primary"></i>
                </div>
                <h2 class="card-title">Courses (Answered Survey)</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                @php $colors = ['primary', 'secondary', 'accent', 'info']; $i =
                0; $dept = strtolower(auth()->user()->name); @endphp
                @foreach($coursePercentages[$dept] as $course => $percentage)
                <div class="stat bg-base-200 rounded-lg p-4">
                    <div class="stat-title">{{ $course }}</div>
                    <div
                        class="stat-value text-{{ $colors[$i++ % count($colors)] }}"
                    >
                        {{ $percentage }}%
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif @endif
</div>

<script>
            document.addEventListener('DOMContentLoaded', function() {
                // Destroy existing charts
                Chart.helpers.each(Chart.instances, function(instance) {
                    instance.destroy();
                });

                // Job Statistics Chart
                const barCharts = document.getElementById('barCharts');
    if (barCharts) {
        new Chart(barCharts, {
            type: 'bar',
            data: {
                labels: {!! json_encode($positionLabels) !!},
                datasets: [{
                    label: 'Number of Graduates',
                    data: {!! json_encode($positionCounts) !!},
                    backgroundColor: [
                        '#3b82f6',
                        '#06b6d4',
                        '#6366f1',
                        '#8b5cf6',
                        '#ec4899'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Top Positions',
                        padding: {
                            bottom: 30
                        },
                        font: {
                            size: 16
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    },
                    x: {
                        ticks: {
                            maxRotation: 45,
                            minRotation: 45
                        }
                    }
                }
            }
        });
    }

                // Employment Status Chart
                const barChart = document.getElementById('barChart');
            if (barChart) {
                const totalStudents = {{$employed}} + {{$notEmployed}};
                const employedPercentage = Math.round(({{$employed}} / totalStudents) * 100);
                const notEmployedPercentage = Math.round(({{$notEmployed}} / totalStudents) * 100);

                new Chart(barChart, {
                    type: 'doughnut',
                    data: {
                        labels: ['Employed', 'Not Employed'],
                        datasets: [{
                            data: [{{$employed}}, {{$notEmployed}}],
                            backgroundColor: ['#0ea5e9', '#f43f5e'],
                            borderWidth: 0,
                            hoverOffset: 10
                        }]
                    },
                    options: {
                        cutout: '65%',
                        responsive: true,
                        maintainAspectRatio: true,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    padding: 20,
                                    font: {
                                        size: 14
                                    },
                                    generateLabels: (chart) => {
                                        const datasets = chart.data.datasets;
                                        return datasets[0].data.map((data, i) => ({
                                            text: `${chart.data.labels[i]} (${Math.round((data / totalStudents) * 100)}%)`,
                                            fillStyle: datasets[0].backgroundColor[i],
                                            strokeStyle: datasets[0].backgroundColor[i],
                                            lineWidth: 0,
                                            hidden: false,
                                            index: i
                                        }));
                                    }
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: (context) => {
                                        const label = context.label || '';
                                        const value = context.parsed || 0;
                                        const percentage = Math.round((value / totalStudents) * 100);
                                        return `${label}: ${value} (${percentage}%)`;
                                    }
                                }
                            }
                        }
                    },
                    plugins: [{
            id: 'centerText',
            beforeDraw: (chart) => {
                const width = chart.width;
                const height = chart.height;
                const ctx = chart.ctx;

                ctx.restore();
                ctx.textBaseline = 'middle';
                ctx.textAlign = 'center';

                // Center point
                const centerX = width / 2;
                const centerY = height / 3;

                // Optional: Add subtle background circle
                ctx.beginPath();
                ctx.arc(centerX, centerY, 40, 0, 2 * Math.PI);
                ctx.fillStyle = 'rgba(255, 255, 255, 0.8)';
                ctx.fill();

                // Draw "Total" text
                ctx.font = '16px Inter, sans-serif';
                ctx.fillStyle = '#6b7280';
                ctx.fillText('Total', centerX, centerY - 15);

                // Draw total number
                ctx.font = 'bold 24px Inter, sans-serif';
                ctx.fillStyle = '#111827';
                ctx.fillText(`${totalStudents}`, centerX, centerY + 15);

                ctx.save();
            }
        }]
                });
            }
            });
</script>

@endsection
