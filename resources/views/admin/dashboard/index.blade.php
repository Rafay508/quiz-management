@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('content')

<div class="layout-page">
    @include('admin.layouts.partials.navigation')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-icon">
                                <span class="badge bg-label-primary rounded-pill p-2">
                                    <i class="ti ti-file-text ti-sm"></i>
                                </span>
                            </div>
                            <h5 class="card-title mb-0 mt-2">{{ $totalQuizzes }}</h5>
                            <small class="text-muted">Total Quizzes</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-icon">
                                <span class="badge bg-label-success rounded-pill p-2">
                                    <i class="ti ti-check ti-sm"></i>
                                </span>
                            </div>
                            <h5 class="card-title mb-0 mt-2">{{ $activeQuizzes }}</h5>
                            <small class="text-muted">Active Quizzes</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-icon">
                                <span class="badge bg-label-info rounded-pill p-2">
                                    <i class="ti ti-help ti-sm"></i>
                                </span>
                            </div>
                            <h5 class="card-title mb-0 mt-2">{{ $totalQuestions }}</h5>
                            <small class="text-muted">Total Questions</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-icon">
                                <span class="badge bg-label-warning rounded-pill p-2">
                                    <i class="ti ti-users ti-sm"></i>
                                </span>
                            </div>
                            <h5 class="card-title mb-0 mt-2">{{ $totalUsers }}</h5>
                            <small class="text-muted">Total Users</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-icon">
                                <span class="badge bg-label-danger rounded-pill p-2">
                                    <i class="ti ti-clock ti-sm"></i>
                                </span>
                            </div>
                            <h5 class="card-title mb-0 mt-2">{{ $todayAttempts }}</h5>
                            <small class="text-muted">Today's Attempts</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Quick Actions</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex gap-3 flex-wrap">
                                <a href="{{ route('admin.quizzes.create') }}" class="btn btn-primary">
                                    <i class="ti ti-plus me-1"></i> Create New Quiz
                                </a>
                                <a href="{{ route('admin.questions.create') }}" class="btn btn-label-primary">
                                    <i class="ti ti-help me-1"></i> Add Questions
                                </a>
                                <a href="{{ route('admin.categories.index') }}" class="btn btn-label-secondary">
                                    <i class="ti ti-category me-1"></i> Manage Categories
                                </a>
                                <a href="{{ route('admin.users.index') }}" class="btn btn-label-secondary">
                                    <i class="ti ti-users me-1"></i> Manage Users
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="row mb-4">
                <!-- Quiz Attempts Chart -->
                <div class="col-lg-8 mb-4">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Quiz Attempts (Last 7 Days)</h5>
                        </div>
                        <div class="card-body">
                            <div id="quizAttemptsChart"></div>
                        </div>
                    </div>
                </div>

                <!-- Popular Categories Chart -->
                <div class="col-lg-4 mb-4">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Popular Categories</h5>
                        </div>
                        <div class="card-body">
                            <div id="popularCategoriesChart"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Registrations Chart -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">User Registrations (Last 7 Days)</h5>
                        </div>
                        <div class="card-body">
                            <div id="userRegistrationsChart"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activities -->
            {{-- <div class="row mb-4">
                <!-- Latest Quiz Attempts -->
                <div class="col-lg-6 mb-4">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Latest Quiz Attempts</h5>
                            <a href="{{ route('admin.quizzes.index') }}" class="btn btn-sm btn-label-secondary">View All</a>
                        </div>
                        <div class="card-datatable text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Quiz</th>
                                        <th>Score</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentAttempts as $attempt)
                                        <tr>
                                            <td>{{ $attempt->user ? $attempt->user->name : ($attempt->guest_name ?? 'Guest') }}</td>
                                            <td>{{ $attempt->quiz->title ?? 'N/A' }}</td>
                                            <td>
                                                @if($attempt->score !== null)
                                                    <span class="badge bg-label-{{ $attempt->is_passed ? 'success' : 'warning' }}">
                                                        {{ number_format($attempt->score, 1) }} / {{ $attempt->quiz->total_marks ?? 'N/A' }}
                                                    </span>
                                                @else
                                                    <span class="text-muted">—</span>
                                                @endif
                                            </td>
                                            <td>{{ $attempt->created_at->format('M d, Y H:i') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">No attempts found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Recent User Registrations -->
                <div class="col-lg-6 mb-4">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Recent User Registrations</h5>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-label-secondary">View All</a>
                        </div>
                        <div class="card-datatable text-nowrap">
                            <table class="dt-scrollableTable table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Registration Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentUsers as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->created_at->format('M d, Y') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-center">No users found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
        <!-- / Content -->
        @include('admin.layouts.partials.footer')
        <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->
</div>

@endsection

@section('footer-js')
<script>
    // Chart data from server
    const attemptsData = @json($attemptsData);
    const attemptsLabels = @json($attemptsLabels);
    const categoryLabels = @json($categoryLabels);
    const categoryCounts = @json($categoryCounts);
    const registrationsData = @json($registrationsData);
    const registrationsLabels = @json($registrationsLabels);

    // Quiz Attempts Line Chart
    const quizAttemptsChartEl = document.querySelector('#quizAttemptsChart');
    if (quizAttemptsChartEl) {
        const quizAttemptsChart = new ApexCharts(quizAttemptsChartEl, {
            chart: {
                height: 350,
                type: 'line',
                toolbar: { show: false }
            },
            series: [{
                name: 'Quiz Attempts',
                data: attemptsData
            }],
            stroke: {
                curve: 'smooth',
                width: 3
            },
            colors: ['#7367F0'],
            xaxis: {
                categories: attemptsLabels
            },
            yaxis: {
                title: {
                    text: 'Number of Attempts'
                }
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return val + " attempts";
                    }
                }
            },
            grid: {
                borderColor: '#e0e0e0',
                strokeDashArray: 4
            }
        });
        quizAttemptsChart.render();
    }

    // Popular Categories Pie Chart
    const popularCategoriesChartEl = document.querySelector('#popularCategoriesChart');
    if (popularCategoriesChartEl) {
        const popularCategoriesChart = new ApexCharts(popularCategoriesChartEl, {
            chart: {
                height: 350,
                type: 'pie',
                toolbar: { show: false }
            },
            series: categoryCounts,
            labels: categoryLabels,
            colors: ['#7367F0', '#28C76F', '#EA5455', '#FF9F43', '#00cfe8'],
            legend: {
                position: 'bottom'
            },
            tooltip: {
                y: {
                    formatter: function (val, opts) {
                        const total = categoryCounts.reduce((a, b) => a + b, 0);
                        const percentage = total > 0 ? ((val / total) * 100).toFixed(1) : 0;
                        return val + " quizzes (" + percentage + "%)";
                    }
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function (val, opts) {
                    return opts.w.config.series[opts.seriesIndex] + " (" + val.toFixed(1) + "%)";
                }
            }
        });
        popularCategoriesChart.render();
    }

    // User Registrations Bar Chart
    const userRegistrationsChartEl = document.querySelector('#userRegistrationsChart');
    if (userRegistrationsChartEl) {
        const userRegistrationsChart = new ApexCharts(userRegistrationsChartEl, {
            chart: {
                height: 350,
                type: 'bar',
                toolbar: { show: false }
            },
            series: [{
                name: 'User Registrations',
                data: registrationsData
            }],
            colors: ['#28C76F'],
            xaxis: {
                categories: registrationsLabels
            },
            yaxis: {
                title: {
                    text: 'Number of Users'
                }
            },
            plotOptions: {
                bar: {
                    borderRadius: 4,
                    columnWidth: '60%'
                }
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return val + " users";
                    }
                }
            },
            grid: {
                borderColor: '#e0e0e0',
                strokeDashArray: 4
            }
        });
        userRegistrationsChart.render();
    }
</script>
@endsection
