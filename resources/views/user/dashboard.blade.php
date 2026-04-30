@extends('layouts.app')

@section('title', 'Dashboard - Listee')

@section('content')

{{-- Breadcrumb --}}
@include('components.breadcrumb', [
    'title' => 'Dashboard',
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Dashboard']
    ]
])

<section class="dashboard-section py-5">
    <div class="container">
        <div class="row">

            {{-- Tab Navigation --}}
            @include('user._sidebar')

            {{-- Main Content --}}
            <div class="col-12">
                {{-- Stats Cards --}}
                <div class="row mb-4">
                    <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
                        <div class="dash-stat-card text-center">
                            <div class="dash-stat-icon">
                                <img src="https://cdn-icons-png.flaticon.com/128/3073/3073465.png" alt="Active Listing">
                            </div>
                            <p class="dash-stat-label">Active Listing</p>
                            <h3 class="dash-stat-value text-primary">{{ $activeListings ?? 500 }}</h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
                        <div class="dash-stat-card text-center">
                            <div class="dash-stat-icon">
                                <img src="https://cdn-icons-png.flaticon.com/128/3073/3073493.png" alt="Total Reviews">
                            </div>
                            <p class="dash-stat-label">Total Reviews</p>
                            <h3 class="dash-stat-value text-success">{{ $totalReviews ?? 15230 }}</h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
                        <div class="dash-stat-card text-center">
                            <div class="dash-stat-icon">
                                <img src="https://cdn-icons-png.flaticon.com/128/3073/3073780.png" alt="Messages">
                            </div>
                            <p class="dash-stat-label">Messages</p>
                            <h3 class="dash-stat-value text-warning">{{ $totalMessages ?? 15 }}</h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
                        <div class="dash-stat-card text-center">
                            <div class="dash-stat-icon">
                                <img src="https://cdn-icons-png.flaticon.com/128/3073/3073614.png" alt="Bookmark">
                            </div>
                            <p class="dash-stat-label">Bookmark</p>
                            <h3 class="dash-stat-value text-danger">{{ $totalBookmarks ?? 30 }}</h3>
                        </div>
                    </div>
                </div>

                {{-- Page Views & Visitor Review --}}
                <div class="row">
                    {{-- Page Views --}}
                    <div class="col-lg-6 mb-4">
                        <div class="dashboard-card">
                            <div class="card-header-custom">
                                <h5>Page Views</h5>
                                <select class="form-select form-select-sm" style="width:auto;">
                                    <option>This week</option>
                                    <option>This month</option>
                                    <option>This year</option>
                                </select>
                            </div>
                            <div class="chart-container">
                                <canvas id="pageViewsChart" width="400" height="300"></canvas>
                            </div>
                        </div>
                    </div>

                    {{-- Visitor Review --}}
                    <div class="col-lg-6 mb-4">
                        <div class="dashboard-card">
                            <div class="card-header-custom">
                                <h5>Visitor Review</h5>
                                <select class="form-select form-select-sm" style="width:auto;">
                                    <option>All Listing</option>
                                    <option>Active Listing</option>
                                </select>
                            </div>
                            @forelse($recentReviews ?? [] as $review)
                                <div class="visitor-review-item">
                                    <div class="visitor-review-avatar">
                                        <img src="{{ $review->user->avatar ? asset('storage/' . $review->user->avatar) : asset('images/default-avatar.png') }}" 
                                             alt="{{ $review->user->name }}">
                                    </div>
                                    <div class="visitor-review-content">
                                        <h6>{{ $review->user->name }}</h6>
                                        <div class="visitor-review-meta">
                                            <div class="review-stars">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fa{{ $i <= $review->rating ? 's' : 'r' }} fa-star"></i>
                                                @endfor
                                            </div>
                                            <span class="review-date-info">
                                                <i class="far fa-calendar-alt"></i> {{ $review->created_at->diffForHumans() }}
                                            </span>
                                            <span class="review-by">by: {{ $review->listing->title ?? 'Demo Test' }}</span>
                                        </div>
                                        <p>{{ $review->comment }}</p>
                                    </div>
                                </div>
                            @empty
                                {{-- Demo reviews when no data --}}
                                <div class="visitor-review-item">
                                    <div class="visitor-review-avatar">
                                        <img src="{{ asset('images/default-avatar.png') }}" alt="Joseph">
                                    </div>
                                    <div class="visitor-review-content">
                                        <h6>Joseph</h6>
                                        <div class="visitor-review-meta">
                                            <div class="review-stars">
                                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                            </div>
                                            <span class="review-date-info"><i class="far fa-calendar-alt"></i> 4 months ago</span>
                                            <span class="review-by">by: Demo Test</span>
                                        </div>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. It has been the industry's standard dummy.</p>
                                    </div>
                                </div>
                                <div class="visitor-review-item">
                                    <div class="visitor-review-avatar">
                                        <img src="{{ asset('images/default-avatar.png') }}" alt="Dev">
                                    </div>
                                    <div class="visitor-review-content">
                                        <h6>Dev</h6>
                                        <div class="visitor-review-meta">
                                            <div class="review-stars">
                                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                            </div>
                                            <span class="review-date-info"><i class="far fa-calendar-alt"></i> 4 months ago</span>
                                            <span class="review-by">by: Demo Test</span>
                                        </div>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. It has been the industry's standard dummy.</p>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>

<style>
.dash-stat-card {
    background: #fff;
    border: 1px solid #e8e8e8;
    border-radius: 10px;
    padding: 25px 15px;
    transition: transform 0.3s;
}
.dash-stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
}
.dash-stat-icon {
    margin-bottom: 12px;
}
.dash-stat-icon img {
    width: 65px;
    height: 65px;
    object-fit: contain;
}
.dash-stat-label {
    font-size: 14px;
    color: #666;
    margin-bottom: 5px;
    font-weight: 500;
}
.dash-stat-value {
    font-size: 28px;
    font-weight: 700;
    margin: 0;
}
.dash-stat-value.text-primary { color: #d32f2f !important; }
.dash-stat-value.text-success { color: #d32f2f !important; }
.dash-stat-value.text-warning { color: #d32f2f !important; }
.dash-stat-value.text-danger { color: #d32f2f !important; }
.dashboard-card {
    background: #fff;
    border: 1px solid #e8e8e8;
    border-radius: 10px;
    padding: 20px;
}
.card-header-custom {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
    padding-bottom: 12px;
    border-bottom: 1px solid #f0f0f0;
}
.card-header-custom h5 {
    font-size: 18px;
    font-weight: 600;
    margin: 0;
}
.chart-container {
    position: relative;
    width: 100%;
    padding: 10px 0;
}
.visitor-review-item {
    display: flex;
    gap: 15px;
    padding: 15px 0;
    border-bottom: 1px solid #f0f0f0;
}
.visitor-review-item:last-child {
    border-bottom: none;
}
.visitor-review-avatar img {
    width: 55px;
    height: 55px;
    border-radius: 50%;
    object-fit: cover;
}
.visitor-review-content h6 {
    font-size: 15px;
    font-weight: 600;
    margin-bottom: 5px;
}
.visitor-review-meta {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 8px;
    flex-wrap: wrap;
}
.visitor-review-meta .review-stars i {
    font-size: 12px;
    color: #FFC107;
}
.visitor-review-meta .review-date-info {
    font-size: 12px;
    color: #888;
}
.visitor-review-meta .review-date-info i {
    color: #d32f2f;
    margin-right: 3px;
}
.visitor-review-meta .review-by {
    font-size: 12px;
    color: #888;
}
.visitor-review-content p {
    font-size: 13px;
    color: #666;
    margin: 0;
    line-height: 1.5;
}
</style>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById('pageViewsChart');
    if (ctx) {
        new Chart(ctx, {
            type: 'radar',
            data: {
                labels: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                datasets: [{
                    label: 'Page Views',
                    data: [100, 60, 50, 80, 40, 70, 90],
                    backgroundColor: 'rgba(211, 47, 47, 0.15)',
                    borderColor: '#d32f2f',
                    borderWidth: 2,
                    pointBackgroundColor: '#d32f2f',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    r: {
                        beginAtZero: true,
                        max: 120,
                        ticks: {
                            stepSize: 20,
                            font: { size: 11 }
                        },
                        pointLabels: {
                            font: { size: 12 }
                        },
                        grid: {
                            color: 'rgba(0,0,0,0.08)'
                        }
                    }
                }
            }
        });
    }
});
</script>
@endpush

@endsection
