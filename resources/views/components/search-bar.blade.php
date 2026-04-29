{{-- Search Bar Component --}}
{{-- Usage: @include('components.search-bar') --}}

<div class="main-search-area">
    <form action="{{ route('listings.index') }}" method="GET" class="search-form">
        <div class="search-wrapper">
            <div class="search-row">
                {{-- Keyword Input --}}
                <div class="search-col keyword-col">
                    <div class="input-group">
                        <i class="fas fa-search"></i>
                        <input type="text" name="keyword" class="form-control" 
                               placeholder="What are you looking for?" 
                               value="{{ request('keyword') }}">
                    </div>
                </div>

                {{-- Location Input --}}
                <div class="search-col location-col">
                    <div class="input-group">
                        <i class="fas fa-map-marker-alt"></i>
                        <input type="text" name="location" class="form-control" 
                               placeholder="Location" 
                               value="{{ request('location') }}">
                    </div>
                </div>

                {{-- Category Dropdown --}}
                <div class="search-col category-col">
                    <div class="input-group">
                        <i class="fas fa-th-list"></i>
                        <select name="category" class="form-control">
                            <option value="">All Categories</option>
                            @isset($categories)
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->slug }}" 
                                        {{ request('category') == $cat->slug ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            @endisset
                        </select>
                    </div>
                </div>

                {{-- Search Button --}}
                <div class="search-col btn-col">
                    <button type="submit" class="btn btn-search">
                        <i class="fas fa-search"></i> Search
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<style>
.main-search-area {
    background: #fff;
    border-radius: 10px;
    padding: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}
.search-row {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}
.search-col {
    flex: 1;
    min-width: 200px;
}
.search-col.btn-col {
    flex: 0 0 auto;
    min-width: auto;
}
.search-col .input-group {
    position: relative;
    display: flex;
    align-items: center;
}
.search-col .input-group i {
    position: absolute;
    left: 15px;
    color: #FF3B30;
    font-size: 14px;
    z-index: 2;
}
.search-col .form-control {
    padding: 12px 15px 12px 40px;
    border: 1px solid #e8e8e8;
    border-radius: 8px;
    font-size: 14px;
    width: 100%;
    height: 48px;
    transition: border-color 0.3s;
}
.search-col .form-control:focus {
    border-color: #FF3B30;
    outline: none;
    box-shadow: 0 0 0 3px rgba(255,59,48,0.1);
}
.search-col select.form-control {
    appearance: none;
    -webkit-appearance: none;
    background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23999' d='M6 8L1 3h10z'/%3E%3C/svg%3E") no-repeat right 15px center;
    cursor: pointer;
}
.btn-search {
    background: #FF3B30;
    color: #fff;
    border: none;
    padding: 12px 30px;
    border-radius: 8px;
    font-size: 15px;
    font-weight: 600;
    height: 48px;
    cursor: pointer;
    transition: background 0.3s;
    white-space: nowrap;
}
.btn-search:hover {
    background: #E0352B;
}
@media (max-width: 768px) {
    .search-row {
        flex-direction: column;
    }
    .search-col {
        width: 100%;
        min-width: 100%;
    }
    .search-col.btn-col {
        width: 100%;
    }
    .btn-search {
        width: 100%;
    }
}
</style>