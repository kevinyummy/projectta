<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
    <a href="{{route('admin-pages-history')}}" class="app-brand-link">
        <span class="app-brand-text demo menu-text fw-bolder ms-2">Admin Page</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Layouts -->
        <li class="menu-item {{ request()->is('history') || request()->is('history/*') ? 'active' : '' }}">
            <a href="{{route('admin-pages-history')}}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-history"></i>
            <div data-i18n="Analytics">History</div>
            </a>
        </li>

        <!-- Layouts -->
        <li class="menu-item {{ request()->is('admin/*') || request()->is('admin') ? 'active' : '' }}">
            <a href="{{route('admin-pages-admin')}}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-user"></i>
            <div data-i18n="Analytics">Admin</div>
            </a>
        </li>
    </ul>
</aside>
<!-- / Menu -->