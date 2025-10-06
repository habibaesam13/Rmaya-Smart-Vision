<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.6.0/css/all.min.css">
<!-- Menu -->
<!-- Sidenav Menu Start -->
<div class="sidenav-menu">

    <!-- Brand Logo -->
    <a href="{{url('/')}}" class="logo">
        <span class="logo-light">
            <span class="logo-lg"><img src="{{asset(all_settings()->getItem('logo'))}}" alt="logo"></span>
            <span class="logo-sm"><img src="{{asset(all_settings()->getItem('logo'))}}" alt="small logo"></span>
        </span>

        <span class="logo-dark">
            <span class="logo-lg"><img src="{{asset(all_settings()->getItem('logo'))}}" alt="dark logo"></span>
            <span class="logo-sm"><img src="{{asset(all_settings()->getItem('logo'))}}" alt="small logo"></span>
        </span>
    </a>

    <!-- Sidebar Hover Menu Toggle Button -->
    <button class="button-sm-hover">
        <i class="ri-circle-line align-middle"></i>
    </button>

    <!-- Full Sidebar Menu Close Button -->
    <button class="button-close-fullsidebar">
        <i class="ri-close-line align-middle"></i>
    </button>

    <div data-simplebar>

        <!-- User -->
        <div class="sidenav-user">
            <div class="dropdown-center">
                <a class="topbar-link dropdown-toggle text-reset drop-arrow-none px-2 d-flex align-items-center justify-content-center"
                    data-bs-toggle="dropdown" data-bs-offset="0,19" type="button" aria-haspopup="false"
                    aria-expanded="false">
                    <img src="{{asset('admin/assets/images/users/user_photo.png')}}" width="42"
                        class="rounded-circle me-2 d-flex" alt="user-image">
                    <span class="d-flex flex-column gap-1 sidebar-user-name">
                        <h4 class="my-0 fw-bold fs-15">{{auth()->user()->name}}</h4>
                        <h6 class="my-0">{{__('lang.Admin Head')}}</h6>
                    </span>
                    <i class="ri-arrow-down-s-line d-block sidebar-user-arrow align-middle ms-2"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item active fw-semibold text-danger">
                        <i class="ri-logout-box-line me-1 fs-16 align-middle"></i>
                        <span onclick="window.location.href='{{route('admin.get_admin_logout')}}'"
                            class="align-middle">Sign Out</span>
                    </a>
                </div>
            </div>
        </div>
        <!-------------------------languages buttons ------------------->
        <ul>
            @foreach(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLocales() as $localeCode =>
            $properties)
            <li class="{{app()->getLocale() === $localeCode ? 'd-none' : ''}}">
                <a rel="alternate" hreflang="{{ $localeCode }}"
                    href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                    {{ $properties['native'] }}
                </a>
            </li>
            @endforeach
        </ul>
        <!-------------------------languages buttons ------------------->

        <!--- Sidenav Menu -->
        <ul class="side-nav">
            <!------------start original nav ----------------->


            @if(checkModulePermission('settings', 'view'))
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarLayouts_settings" aria-expanded="false"
                    aria-controls="sidebarLayouts_2" class="side-nav-link">
                    <span class="menu-icon"><i class="ri-layout-2-line"></i></span>
                    <span class="menu-text"> {{__('lang.settings')}} </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarLayouts_settings">
                    <ul class="sub-menu">
                        {{-- @if(checkModulePermission('roles', 'add'))--}}
                        {{-- <li class="side-nav-item">--}}
                        {{-- <a href="{{url(route('admin.roles.create'))}}"--}}
                        {{-- class="side-nav-link"> {{__('lang.Add Role')}}
                        </a>--}}
                        {{-- </li>--}}
                        {{-- @endif--}}

                        <li class="side-nav-item">
                            <a href="{{url(route('admin.settings.edit'))}}" class="side-nav-link">
                                {{__('lang.Show Setting')}} </a>
                        </li>
                        <li>
                            <a href="{{route('weapons.index')}}" class="side-nav-link"> {{__('lang.Show All Settings')}}
                            </a>
                        </li>

                    </ul>
                </div>
            </li>
            @endif








            @if(checkModulePermission('admins', 'view'))
            <li
                class="side-nav-item  @if (request()->routeIs('admin.users.*') || request()->routeIs('admin.roles.*')  || request()->routeIs('admin.give_module_to_role_show')  ) active   @endif">
                <a data-bs-toggle="collapse" href="#sidebarLayouts_admins" aria-expanded="false"
                    aria-controls="sidebarLayouts_2" class="side-nav-link">
                    <span class="menu-icon"><i class="ri-layout-2-line"></i></span>
                    <span class="menu-text"> {{__('lang.admins')}} </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse  @if (request()->routeIs('admin.users.*')  ||  request()->routeIs('admin.roles.*') || request()->routeIs('admin.give_module_to_role_show')) show   @endif"
                    id="sidebarLayouts_admins">
                    <ul class="sub-menu">
                        @if(checkModulePermission('admins', 'add'))
                        <li class="side-nav-item">
                            <a href="{{url(route('admin.users.create'))}}" class="side-nav-link">
                                {{__('lang.Add Admin')}} </a>
                        </li>
                        @endif

                        <li class="side-nav-item">
                            <a href="{{url(route('admin.users.index'))}}" class="side-nav-link">
                                {{__('lang.Show Admin')}} </a>
                        </li>

                        @if(checkModulePermission('roles', 'view'))
                        <li class="side-nav-item">
                            <a href="{{url(route('admin.roles.index'))}}" class="side-nav-link">
                                {{__('lang.Show Role')}} </a>
                        </li>
                        @endif

                    </ul>
                </div>
            </li>
            @endif

            <ul class="side-nav">

                {{-- Weapons --}}
                <li class="side-nav-item @if (request()->routeIs('weapons.*')) active @endif">
                    <a href="{{ route('weapons.index') }}" class="side-nav-link">
                        <span class="menu-icon"><i class="ri-sword-line"></i></span>
                        <span class="menu-text">{{ __('lang.Weapons') }}</span>
                    </a>
                </li>

                {{-- Clubs --}}
                <li class="side-nav-item @if (request()->routeIs('clubs.*')) active @endif">
                    <a href="{{ route('clubs.index') }}" class="side-nav-link">
                        <span class="menu-icon"><i class="ri-shield-line"></i></span>
                        <span class="menu-text">{{ __('lang.Clubs') }}</span>
                    </a>
                </li>
                {{-- Personal Registered --}}
                <li class="side-nav-item @if (request()->routeIs('personal.*')) active @endif">
                    <a href="{{ route('personal-registration') }}" class="side-nav-link">
                        <span class="menu-icon"><i class="fa-solid fa-user"></i></span>
                        <span class="menu-text">{{ __('lang.Personal') }}</span>
                    </a>
                </li>
                {{-- Personal Registration --}}
                <li class="side-nav-item @if (request()->routeIs('personal.*')) active @endif">
                    <a href="{{ route('personal-create') }}" class="side-nav-link">
                        <span class="menu-icon"><i class="fa-solid fa-person"></i></span>
                        <span class="menu-text">{{ __('lang.PersonalCreate') }}</span>
                    </a>
                </li>
                {{-- Registered Groups --}}
                <li class="side-nav-item @if (request()->routeIs('groups.*')) active @endif">
                    <a href="{{ route('group-registration') }}" class="side-nav-link">
                        <span class="menu-icon"><i class="fa-solid fa-people-group"></i></span>
                        <span class="menu-text">{{ __('lang.RegisteredGroups') }}</span>
                    </a>
                </li>
                {{-- Memebrs in Groups --}}
                <li class="side-nav-item @if (request()->routeIs('groups.*')) active @endif">
                    <a href="{{ route('groups-members') }}" class="side-nav-link">
                        <span class="menu-icon"><i class="fa-solid fa-users-line"></i></span>
                        <span class="menu-text">{{ __('lang.GroupsMembers') }}</span>
                    </a>
                </li>

                {{-- لوحة تحكم الأندية --}}
                <li
                    class="side-nav-item 
                    @if (request()->routeIs('personal.*') || request()->routeIs('results.*') || request()->routeIs('groups.*')) active @endif">

                    <a data-bs-toggle="collapse" href="#sidebarLayouts_clubs" aria-expanded="false"
                        aria-controls="sidebarLayouts_clubs" class="side-nav-link">
                        <span class="menu-icon"><i class="fa-solid fa-layer-group"></i></span>
                        <span class="menu-text">لوحة تحكم الأندية</span>
                        <span class="menu-arrow"></span>
                    </a>

                    <div class="collapse @if (request()->routeIs('personal.*') || request()->routeIs('clubs.*') || request()->routeIs('groups.*')) show @endif"
                        id="sidebarLayouts_clubs">
                        <ul class="sub-menu">
                            {{-- تسجيل فردي أندية --}}
                            <li class="side-nav-item @if (request()->routeIs('personal-create')) active @endif">
                                <a href="{{ route('personal-create') }}" class="side-nav-link">
                                    <i class="fa-solid fa-person me-2"></i>
                                    {{ __('lang.PersonalCreate') }}
                                </a>
                            </li>

                            {{--  المسجلين أفراد أندية --}}
                            <li class="side-nav-item @if (request()->routeIs('results.*')) active @endif">
                                <a href="{{ route('results-registered-members') }}" class="side-nav-link">
                                    <i class="fa-solid fa-users-line me-2"></i>
                                    {{ __('lang.Personal').' - أندية' }}
                                </a>
                            </li>
                            {{-- أضافة تقرير النتائج اليومية للاسلحة --}}
                                <li class="side-nav-item @if (request()->routeIs('results.*')) active @endif">
                                <a href="{{ route('report-members') }}" class="side-nav-link">
                                    <i class="fa-solid fa-users-line me-2"></i>
                                    {{ __('lang.Add Daily Weapons Results Report') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>


            </ul>
            @if(checkModulePermission('logs', 'view'))
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarLayouts_logs" aria-expanded="false"
                    aria-controls="sidebarLayouts_logs" class="side-nav-link">
                    <span class="menu-icon"><i class="ri-layout-2-line"></i></span>
                    <span class="menu-text"> {{__('lang.logs')}} </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarLayouts_logs">
                    <ul class="sub-menu">


                        <li class="side-nav-item">
                            <a href="{{url(route('admin.logs.index'))}}" class="side-nav-link"> {{__('lang.show')}}
                                {{__('lang.logs')}} </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endif


        </ul>


        <!-- Help Box -->
        <div class="help-box text-center">
            {{-- <h5 class="fw-semibold fs-16">Unlimited Access</h5>--}}
            {{-- <p class="mb-3 opacity-75">Upgrade to plan to get access to unlimited reports</p>--}}
            {{-- <a href="javascript: void(0);" class="btn btn-danger btn-sm">Upgrade</a>--}}
        </div>

        <div class="clearfix"></div>
    </div>
</div>
<!-- Sidenav Menu End -->


<!-- Color Top line -->
<div class="color-line"></div>

<!-- Topbar Start -->
<header class="app-topbar">
    <div class="page-container topbar-menu">
        <div class="d-flex align-items-center gap-2">

            <!-- Brand Logo -->
            <a href="#" class="logo">
                <span class="logo-light">
                    <span class="logo-lg"><img src="{{asset('admin/assets/images/logo.png')}}" alt="logo"></span>
                    <span class="logo-sm"><img src="{{asset('admin/assets/images/logo-sm.png')}}"
                            alt="small logo"></span>
                </span>

                <span class="logo-dark">
                    <span class="logo-lg"><img src="{{asset('admin/assets/images/logo-dark.png')}}"
                            alt="dark logo"></span>
                    <span class="logo-sm"><img src="{{asset('admin/assets/images/logo-sm.png')}}"
                            alt="small logo"></span>
                </span>
            </a>

            <!-- Sidebar Menu Toggle Button -->
            <button class="sidenav-toggle-button px-2">
                <i class="ri-menu-5-line fs-24"></i>
            </button>

            <!-- Horizontal Menu Toggle Button -->
            <button class="topnav-toggle-button px-2" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                <i class="ri-menu-5-line fs-24"></i>
            </button>

            <!-- Topbar Page Title -->
            <div class="topbar-item d-none d-md-flex">


                <div>
                    <h4 class="page-title fs-18 fw-bold mb-0">{{all_settings()->getItem('company_name')}}</h4>
                    <h5 class="page-title mt-1 text-primary  fw-bold mb-0">
                        {{all_settings()->getItem('company_department_name')}}
                    </h5>

                </div>

            </div>
        </div>

        <div class="d-flex align-items-center gap-2">

            <!-- Search for small devices -->
            <div class="topbar-item d-flex d-xl-none">
                <button class="topbar-link" data-bs-toggle="modal" data-bs-target="#searchModal" type="button">
                    <i class="ri-search-line fs-22"></i>
                </button>
            </div>


            <!-- User Dropdown -->
            <div class="topbar-item nav-user">
                <div class="dropdown">
                    <a class="topbar-link dropdown-toggle drop-arrow-none px-2" data-bs-toggle="dropdown"
                        data-bs-offset="0,25" type="button" aria-haspopup="false" aria-expanded="false">
                        <img src="{{asset('admin/assets/images/users/user_photo.png')}}" width="32"
                            class="rounded-circle me-lg-2 d-flex" alt="user-image">
                        <span class="d-lg-flex flex-column gap-1 d-none">
                            <h5 class="my-0">{{auth()->user()->name}}</h5>
                        </span>
                        <i class="ri-arrow-down-s-line d-none d-lg-block align-middle ms-2"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item active fw-semibold text-danger">
                            <i class="ri-logout-box-line me-1 fs-16 align-middle"></i>
                            <span onclick="window.location.href='{{route('admin.get_admin_logout')}}'"
                                class="align-middle">Sign Out</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Topbar End -->

<!-- Search Modal -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-transparent">
            <form>
                <div class="card mb-1">
                    <div class="px-3 py-2 d-flex flex-row align-items-center" id="top-search">
                        <i class="ri-search-line fs-22"></i>
                        <input type="search" class="form-control border-0" id="search-modal-input"
                            placeholder="Search for actions, people,">
                        <button type="submit" class="btn p-0" data-bs-dismiss="modal" aria-label="Close">[esc]</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="page-content">