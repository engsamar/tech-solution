<header class="header">
    <div class="logo-wrapper">
        <a href="{{ route('home') }}" class="logo">
            <img src="images/logo.png" alt="">
        </a>

    </div>
    <div class="header-items">
        <!-- Custom search start -->
        {{-- <div class="custom-search">
            <input type="text" class="search-query" placeholder="Search here ...">
            <i class="icon-search1"></i>
        </div> --}}
        <!-- Custom search end -->

        <!-- Header actions start -->
        <ul class="header-actions">
            <li class="dropdown">
            </li>
            <li class="dropdown">
            </li>

            <li class="dropdown">
                <a href="#" id="userSettings" class="user-settings" data-toggle="dropdown" aria-haspopup="true">
                    <span class="user-name">{{ auth()->user()->name }}</span>
                    <span class="avatar">{{ substr(auth()->user()->name, 0, 1) }}<span
                            class="status busy"></span></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userSettings">
                    <div class="header-profile-actions">
                        <div class="header-user-profile">
                            <div class="header-user">
                                <img src="{{ auth()->user()->image }}" alt="{{ auth()->user()->name }}">
                            </div>
                            <h5>{{ auth()->user()->name }}</h5>
                            <p>{{ auth()->user()->email }}</p>
                            <p>{{ auth()->user()->phone }}</p>
                            <p>{{ auth()->user()->type }}</p>
                        </div>
                        <a href="{{ route('profile') }}"><i class="icon-user1"></i>
                            صفحتي الشخصية</a>


                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>

                        <a href="{!! route('logout') !!}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                class="icon-log-out1"></i> تسجيل الخروج
                        </a>
                    </div>
                </div>
            </li>

        </ul>
        <!-- Header actions end -->
    </div>
</header>
