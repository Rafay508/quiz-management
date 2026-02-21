<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo text-center" style="margin: 0px; padding-left: 30px; padding-right: 15px;">
        <a href="{{ route('admin.dashboard.index') }}" class="app-brand-link text-center">
            <span class="app-brand-logo demo text-center">
                <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                        fill="#7367F0" />
                    <path
                        opacity="0.06"
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z"
                        fill="#161616" />
                    <path
                        opacity="0.06"
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z"
                        fill="#161616" />
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                        fill="#7367F0" />
                </svg>
            </span>
            <span class="app-brand-text text-center demo menu-text fw-bold">{{ config('app.name', 'Laravel') }}</span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
        <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
        <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>
    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1" style="">
        <!-- Dashboards -->
        <li class="menu-item {{ request()->segment(2) == 'dashboard' ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>

        @if(auth()->user()->is_system_admin == 1)
        <!-- Administrators -->
        <li class="menu-item {{ request()->segment(2) == 'administrators' ? 'active' : '' }}">
            <a href="{{ route('admin.administrators.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-users"></i>
                <div data-i18n="Administrators">Administrators</div>
            </a>
        </li>
        @endif

        <!-- Users -->
        <li class="menu-item {{ request()->segment(2) == 'users' ? 'active' : '' }}">
            <a href="{{ route('admin.users.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-users"></i>
                <div data-i18n="Users">Users</div>
            </a>
        </li>

        <!-- Categories -->
        <li class="menu-item {{ request()->segment(2) == 'categories' ? 'active' : '' }}">
            <a href="{{ route('admin.categories.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-category"></i>
                <div data-i18n="Categories">Categories</div>
            </a>
        </li>

        <!-- Quiz Management -->
        <li class="menu-item {{ request()->segment(2) == 'quizzes' ? 'active' : '' }}">
            <a href="{{ route('admin.quizzes.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-file-text"></i>
                <div data-i18n="Quiz Management">Quiz Management</div>
            </a>
        </li>

        <!-- Settings -->
        <li class="menu-item {{ request()->segment(2) == 'meta-details' ? 'active open' : '' }} {{ request()->segment(2) == 'currencies' ? 'open' : '' }} {{ request()->segment(2) == 'site-settings' ? 'open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-settings-search"></i>
                <div data-i18n="Settings">Settings</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->segment(2) == 'site-settings' ? 'active' : '' }}">
                    <a href="{{ route('admin.site-settings.index') }}" class="menu-link">
                        <div data-i18n="Site Customization">Site Customization</div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>
<!-- / Menu -->
