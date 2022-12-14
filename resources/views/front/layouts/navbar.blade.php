<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{route('front.index')}}">
            <span class="sidebar-brand-text align-middle">
                AdminKit
                <sup><small class="badge bg-primary text-uppercase">Pro</small></sup>
            </span>
            <svg class="sidebar-brand-icon align-middle" width="32px" height="32px" viewBox="0 0 24 24" fill="none"
                stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="square" stroke-linejoin="miter" color="#FFFFFF"
                style="margin-left: -3px">
                <path d="M12 4L20 8.00004L12 12L4 8.00004L12 4Z"></path>
                <path d="M20 12L12 16L4 12"></path>
                <path d="M20 16L12 20L4 16"></path>
            </svg>
        </a>


        <ul class="sidebar-nav">
            @if (Session::has('reader_id'))
                <li class="sidebar-item active">
                    <a class="sidebar-link" href="{{ route('user.dashboard') }}">
                        <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboards</span>
                    </a>

                </li>
            @endif

            <span>NEWS CATEGORIES</span>

            @foreach ($categories as $category)
            <li class="sidebar-item">
                <a class="sidebar-link" href='{{ url("/categorized-news/$category->id") }}'>
                    <i class="align-middle" data-feather="corner-up-right"></i> <span class="align-middle">{{$category->name}}</span>
                </a>
            </li>
            @endforeach





        </ul>

    </div>
</nav>
