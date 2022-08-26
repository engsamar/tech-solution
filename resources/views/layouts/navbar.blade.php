<nav class="navbar navbar-expand-lg custom-navbar">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#WafiAdminNavbar"
        aria-controls="WafiAdminNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon">
            <i></i>
            <i></i>
            <i></i>
        </span>
    </button>
    <div class="collapse navbar-collapse" id="WafiAdminNavbar">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link  {{ Request::routeIs('home') ? 'active-page' : '' }} "
                    href="{{ route('home') }}">
                    <i class="icon-devices_other nav-icon"></i>
                    الصفحة الرئيسية
                </a>

            </li>

            <li class="nav-item ">
                <a class="nav-link {{ Request::routeIs('problems.*') ? 'active-page' : '' }}"
                    href="{{ route('problems.index') }}">
                    <i class="icon-package nav-icon"></i>
                    مشكلات التقنية
                </a>

            </li>
            @if (in_array(auth()->user()->type, ['admin']))

                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('employees.*') ? 'active-page' : '' }}"
                        href="{{ route('employees.index') }}">
                        <i class="icon-book-open nav-icon"></i>
                        موظفين التقنية
                    </a>

                </li>
            @endif
            @if (in_array(auth()->user()->type, ['admin', 'employee']))

                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('categories.*') ? 'active-page' : '' }}"
                        href="{{ route('categories.index') }}">
                        <i class="icon-image nav-icon"></i>
                        أقسام المشكلات
                    </a>

                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('users.*') ? 'active-page' : '' }}"
                        href="{{ route('users.index') }}">
                        <i class="icon-edit1 nav-icon"></i>
                        موظفين الوزاره
                    </a>
                </li>
            @endif

            @if (in_array(auth()->user()->type, ['user', 'employee']))

                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('chats.*') ? 'active-page' : '' }}"
                        href="{{ route('chats.index') }}">
                        <i class="icon-chat nav-icon"></i>
                        المحادثات
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('common_problems.*') ? 'active-page' : '' }}"
                        href="{{ route('common_problems.index') }}">
                        <i class="icon-info nav-icon"></i>
                        حلول عامه
                    </a>
                </li>

            @endif

        </ul>
    </div>
</nav>
