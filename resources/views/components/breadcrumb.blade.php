{{-- Breadcrumb Component --}}
{{-- Usage: @include('components.breadcrumb', ['title' => 'Page Title', 'breadcrumbs' => [['name' => 'Home', 'url' => '/'], ['name' => 'Listings']]]) --}}

<section class="breadcrumb-area" style="background-image: url('{{ asset('images/breadcrumb-bg.jpg') }}');">
    <div class="breadcrumb-overlay"></div>
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h2>{{ $title ?? 'Page Title' }}</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    @isset($breadcrumbs)
                        @foreach($breadcrumbs as $crumb)
                            @if(!$loop->last)
                                <li class="breadcrumb-item">
                                    <a href="{{ $crumb['url'] ?? '#' }}">
                                        @if($loop->first)
                                            <i class="fas fa-home"></i>
                                        @endif
                                        {{ $crumb['name'] }}
                                    </a>
                                </li>
                            @else
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{ $crumb['name'] }}
                                </li>
                            @endif
                        @endforeach
                    @else
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}"><i class="fas fa-home"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ $title ?? 'Page' }}
                        </li>
                    @endisset
                </ol>
            </nav>
        </div>
    </div>
</section>

<style>
.breadcrumb-area {
    position: relative;
    padding: 80px 0;
    background-size: cover;
    background-position: center;
    background-color: #1a1a2e;
}
.breadcrumb-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(26, 26, 46, 0.85);
}
.breadcrumb-content {
    position: relative;
    z-index: 2;
}
.breadcrumb-content h2 {
    color: #fff;
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 15px;
}
.breadcrumb {
    background: transparent;
    padding: 0;
    margin: 0;
}
.breadcrumb-item a {
    color: rgba(255,255,255,0.7);
    text-decoration: none;
    font-size: 14px;
    transition: color 0.3s;
}
.breadcrumb-item a:hover {
    color: #FF3B30;
}
.breadcrumb-item a i {
    margin-right: 5px;
}
.breadcrumb-item.active {
    color: #FF3B30;
    font-size: 14px;
}
.breadcrumb-item + .breadcrumb-item::before {
    color: rgba(255,255,255,0.5);
    content: "›";
    font-size: 16px;
}
@media (max-width: 768px) {
    .breadcrumb-area {
        padding: 50px 0;
    }
    .breadcrumb-content h2 {
        font-size: 24px;
    }
}
</style>