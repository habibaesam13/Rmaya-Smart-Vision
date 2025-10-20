<!-- Menu -->
<!-- Sidenav Menu Start -->
<div class="sidenav-menu">
    <!-- Sidebar Hover Menu Toggle Button -->
    <button class="button-sm-hover">
        <i class=" ri-circle-line fs-28 align-middle"></i>
    </button>
    <!-- Full Sidebar Menu Close Button -->
    <button class="button-close-fullsidebar">
        <i class=" ri-circle-line fs-24 align-middle"></i>
    </button>
    <div data-simplebar>
        <!-- User -->
        <!-- User -->
    <!--<div class="sidenav-user"><div class="dropdown-center"><a class="topbar-link dropdown-toggle text-reset drop-arrow-none px-2 d-flex align-items-center justify-content-center"
                   data-bs-toggle="dropdown" data-bs-offset="0,19" type="button" aria-haspopup="false"
                   aria-expanded="false"><i class="ri-user-2-fill"></i><span class="d-flex flex-column gap-1 sidebar-user-name m-1"><h4 class="my-0 fw-bold fs-15">{{auth()->user()->name}} x</h4></span><i class="ri-arrow-down-s-line d-block sidebar-user-arrow align-middle ms-2"></i></a><div class="dropdown-menu dropdown-menu-end"><a href="javascript:void(0);" class="dropdown-item active fw-semibold text-danger"><i class="ri-logout-box-line me-1 fs-16 align-middle"></i><span onclick="window.location.href='{{route('admin.get_admin_logout')}}'" class="align-middle">Sign Out</span></a></div></div></div>-->
        <!--- Sidenav Menu -->
        <ul class="side-nav">


            <!------------end original nav ----------------->
            <li class="side-nav-item ">
                <a href="{{url(route('admin.main_dashboard.index'))}}" class="side-nav-link ">
          <span class="menu-icon">
            <i class="ri-line-chart-line"></i>
          </span>
                    <span class="menu-text">الإحصائيات </span>
                </a>
            </li>

            @if(auth()->user()->clubid=='')


                @if(checkModulePermission('settings', 'view'))
                    <li class="side-nav-item ">
                        <a href="{{url(route('admin.settings.edit'))}}" class="side-nav-link ">
          <span class="menu-icon">
            <i class="ri-settings-5-line"></i>
          </span>
                            <span class="menu-text"> @lang('lang.settings') </span>
                        </a>
                    </li> @endif
                @if(checkModulePermission('weapons', 'view'))
                    <li class="side-nav-item @if (request()->routeIs('weapons.*')) active @endif">
                        <a href="{{ route('weapons.index') }}" class="side-nav-link">
                            <span class="menu-icon"><i class="ri-sword-line"></i></span>
                            <span class="menu-text">{{ __('lang.Weapons') }}</span>
                        </a>
                    </li> @endif

                @if(checkModulePermission('clubs', 'view'))
                    {{-- Clubs --}}
                    <li class="side-nav-item @if (request()->routeIs('clubs.*')) active @endif">
                        <a href="{{ route('clubs.index') }}" class="side-nav-link">
                            <span class="menu-icon"><i class="ri-shield-line"></i></span>
                            <span class="menu-text">{{ __('lang.Clubs') }}</span>
                        </a>
                    </li> @endif

                @if(checkModulePermission('members', 'add'))

                    {{-- Personal Registration --}}
                    <li class="side-nav-item @if (request()->routeIs('personal.*')) active @endif">
                        <a href="{{ route('personal-create') }}" class="side-nav-link">
                            <span class="menu-icon"><i class="ri-folder-add-line"></i></span>
                            <span class="menu-text">التسجيل الفردى فى المسابقات</span>
                        </a>
                    </li> @endif


                <li class="side-nav-title mt-2">            وحدة المسجلين                </li>
                @if(checkModulePermission('members', 'view'))
                    {{-- Personal Registered --}}
                    <li class="side-nav-item @if (request()->routeIs('personal.*')) active @endif">
                        <a href="{{ route('personal-registration') }}" class="side-nav-link">
                            <span class="menu-icon"><i class="ri-file-user-line"></i></span>
                            <span class="menu-text">{{ __('lang.Personal') }}</span>
                        </a>
                    </li> @endif


                @if(checkModulePermission('members_groups', 'view'))
                    {{-- Registered Groups --}}
                    <li class="side-nav-item @if (request()->routeIs('groups.*')) active @endif">
                        <a href="{{ route('group-registration') }}" class="side-nav-link">
                            <span class="menu-icon"><i class="ri-team-line"></i></span>
                            <span class="menu-text">{{ __('lang.RegisteredGroups') }}</span>
                        </a>
                    </li> @endif
                @if(checkModulePermission('members_groups', 'rpt'))
                    {{-- Memebrs in Groups --}}
                    <li class="side-nav-item @if (request()->routeIs('groups.*')) active @endif">
                        <a href="{{ route('groups-members') }}" class="side-nav-link">
                            <span class="menu-icon"><i class="ri-file-list-line"></i></span>
                            <span class="menu-text">{{ __('lang.GroupsMembers') }}</span>
                        </a>
                    </li>
                @endif

                @if(checkModulePermission('intial_results', 'view'))

                    <li class="side-nav-title mt-2">            وحدة النتائج الأولية                 </li>
                    @if(checkModulePermission('intial_results', 'daily_rpt'))
                        {{-- تقارير النتائج اليومية --}}
                        <li class="side-nav-item @if (request()->routeIs('results.*')) active @endif">
                            <a href="{{ route('reports-details') }}" class="side-nav-link">
                                <span class="menu-icon"><i class="ri-file-list-line"></i></span>
                                التقارير اليومية للأندية
                            </a>
                        </li>
                    @endif
                    @if(checkModulePermission('intial_results', 'srch'))
                        {{-- search in intial results reports Search_daily_preliminary_results --}}
                        <li class="side-nav-item @if (request()->routeIs('results.*')) active @endif">
                            <a href="{{ route('initial-results-search') }}" class="side-nav-link">
                                <span class="menu-icon"><i class="ri-menu-search-line"></i></span>
                                البحث فى النتائج
                            </a>
                        </li>
                    @endif
                    @if(checkModulePermission('intial_results', 'res_list'))
                        {{-- list of initial results reports List of preliminary results --}}
                        <li class="side-nav-item @if (request()->routeIs('results.*')) active @endif">
                            <a href="{{ route('list-initial-results-reports') }}" class="side-nav-link">
                                <span class="menu-icon"><i class="ri-layout-grid-2-line"></i></span>
                                قائمة النتائج الاولية
                            </a>
                        </li>
                    @endif
                    @if(checkModulePermission('intial_results', 'absents'))
                        {{-- الافراد المتخلفين في النتائج الاولية --}}
                        <li class="side-nav-item @if (request()->routeIs('results.*')) active @endif">
                            <a href="{{ route('individuals-absent-preliminary-results') }}" class="side-nav-link">
                                <span class="menu-icon"><i class="ri-user-minus-line"></i></span>
                                الأفراد المتغيبين - النتائج الاولية
                            </a>
                        </li>
                    @endif
                @endif


                @if(checkModulePermission('final_results', 'view'))
                    <li class="side-nav-title mt-2">            وحدة النتائج النهائية                 </li>

                    @if(checkModulePermission('final_results', 'mem'))
                        {{-- final_results.reports--}}
                        <li class="side-nav-item  @if (request()->routeIs('final_reports.reports')) active @endif  ">

                            <a href="{{ route('final_results.reports') }}" class="side-nav-link">
                                <span class="menu-icon"><i class="ri-bookmark-line"></i></span>
                                قائمة المتأهليين

                            </a>
                        </li>
                    @endif
                    @if(checkModulePermission('final_results', 'add_res_rpt'))
                        {{-- final_results.reports--}}
                        <li class="side-nav-item  @if (request()->routeIs('reports-details_absent_players_final')) active @endif  ">
                            <a href="{{route('reports-details_players_final')}}" class="side-nav-link">
                                <span class="menu-icon"><i class="ri-git-repository-commits-line"></i></span>
                                تقارير النتائج النهائية
                            </a>
                        </li>
                    @endif
                    @if(checkModulePermission('final_results', 'final_results'))
                        {{-- final_results.reports--}}
                        <li class="side-nav-item  @if (request()->routeIs('final_reports.index')) active @endif  ">
                            <a href="{{ route('final_reports.index') }}" class="side-nav-link">
                                <span class="menu-icon"><i class="ri-equal-line"></i></span>
                                نتيجة التصفيات النهائية
                            </a>
                        </li>
                    @endif
                    @if(checkModulePermission('final_results', 'absents'))
                        {{-- final_results.reports--}}
                        <li class="side-nav-item  @if (request()->routeIs('final_results.absents.reports')) active @endif  ">
                            <a href="{{ route('final_results.absents.reports') }}" class="side-nav-link">
                                <span class="menu-icon"><i class="ri-user-minus-line"></i></span>
                                الأفراد المتغيبين - التصفيات النهائية
                            </a>
                        </li>
                    @endif
                @endif

            @endif
            @if(auth()->user()->clubid!='')




                <li class="side-nav-title mt-2">            لوحة تحكم الاندية                   </li>
                @if(checkModulePermission('club_panel', 'reg'))
                    {{-- تسجيل فردي أندية --}}
                    <li class="side-nav-item @if (request()->routeIs('personal-create')) active @endif">
                        <a href="{{ route('personal-create') }}" class="side-nav-link">
                            <span class="menu-icon"><i class="ri-folder-add-line"></i></span>
                            تسجيل فردي اندية
                        </a>
                    </li>
                @endif
                @if(checkModulePermission('club_panel', 'club_mem'))
                    {{--  المسجلين أفراد أندية --}}
                    <li class="side-nav-item @if (request()->routeIs('results.*')) active @endif">
                        <a href="{{ route('results-registered-members') }}" class="side-nav-link">
                            <span class="menu-icon"><i class="ri-file-user-line"></i></span>
                            {{ __('lang.Personal').' - أندية' }}
                        </a>
                    </li>
                @endif
                @if(checkModulePermission('club_panel', 'add_res_rpt'))
                    {{-- تقارير النتائج اليومية --}}
                    <li class="side-nav-item @if (request()->routeIs('results.*')) active @endif">
                        <a href="{{ route('reports-details') }}" class="side-nav-link">
                            <span class="menu-icon"><i class="ri-file-list-line"></i></span>
                            {{ __('lang.reportsDetails') }}
                        </a>
                    </li>
                @endif
                @if(checkModulePermission('club_panel', 'absents'))
                    {{-- الافراد المتخلفين في النتائج الاولية --}}
                    <li class="side-nav-item @if (request()->routeIs('results.*')) active @endif">
                        <a href="{{ route('individuals-absent-preliminary-results') }}" class="side-nav-link">
                            <span class="menu-icon"><i class="ri-user-minus-line"></i></span>
                            الأفراد المتغيبين - النتائج الاولية
                        </a>
                    </li> @endif

        @endif
















        <!--
                      {{-- لوحة تحكم الأندية --}}

            <li
                class="side-nav-item
@if (request()->routeIs('personal.*') || request()->routeIs('results.*') || request()->routeIs('groups.*')  || request()->routeIs('final_results.*')) active @endif">

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

{{-- تقارير النتائج اليومية --}}
            <li class="side-nav-item @if (request()->routeIs('results.*')) active @endif">
                                <a href="{{ route('reports-details') }}" class="side-nav-link">
                                    <i class="fa-solid fa-list"></i>
                                    {{ __('lang.reportsDetails') }}
            </a>
        </li>

{{-- search in intial results reports Search_daily_preliminary_results --}}
            <li class="side-nav-item @if (request()->routeIs('results.*')) active @endif">
                                <a href="{{ route('initial-results-search') }}" class="side-nav-link">
                                    <i class="ri-search-line"></i>
                                    {{ __('lang.Search_daily_preliminary_results') }}
            </a>
        </li>
{{-- list of initial results reports List of preliminary results --}}
            <li class="side-nav-item @if (request()->routeIs('results.*')) active @endif">
                                <a href="{{ route('list-initial-results-reports') }}" class="side-nav-link">
                                    <i class="ri-list-unordered"></i>
                                    {{ __('lang.list_of_initial_results_reports') }}
            </a>
        </li>
{{-- الافراد المتخلفين في النتائج الاولية --}}
            <li class="side-nav-item @if (request()->routeIs('results.*')) active @endif">
                                <a href="{{ route('individuals-absent-preliminary-results') }}" class="side-nav-link">
                                    {{ __('lang.individuals_absent_preliminary_results') }}
            </a>
        </li>
{{-- final_results.reports--}}
            <li class="side-nav-item  @if (request()->routeIs('final_reports.reports')) active @endif  ">
                                <a href="{{ route('final_results.reports') }}" class="side-nav-link">
                                    <i class="fa-solid fa-person me-2"></i>
                                    قائمة الافراد المتأهلين للتصفيات النهائية

                                </a>
                            </li>

                            {{-- final_results.reports--}}
            <li class="side-nav-item  @if (request()->routeIs('final_reports.index')) active @endif  ">
                                <a href="{{ route('final_reports.index') }}" class="side-nav-link">
                                    <i class="fa-solid fa-list me-2"></i>
                                   final reports
                                </a>
                            </li>

                            {{-- final_results.reports--}}
            <li class="side-nav-item  @if (request()->routeIs('final_results.absents.reports')) active @endif  ">
                                <a href="{{ route('final_results.absents.reports') }}" class="side-nav-link">
                                    <i class="fa-solid fa-list me-2"></i>
                                    absent final players
                                </a>
                            </li>

                            {{-- final_results.reports--}}
            <li class="side-nav-item  @if (request()->routeIs('reports-details_absent_players_final')) active @endif  ">
                                <a href="{{route('reports-details_absent_players_final')}}" class="side-nav-link">
                                    <i class="fa-solid fa-list me-2"></i>
                                    final reports has absent players
                                </a>
                            </li>

                             -->




        </ul>
    </div>
    </li>




    </ul>
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

            <!-- Sidebar Menu Toggle Button -->
            <button class="sidenav-toggle-button px-2">
                <i class="ri-menu-5-line fs-24"></i>
            </button>
            <!-- Horizontal Menu Toggle Button -->
            <button class="topnav-toggle-button px-2" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                <i class="ri-menu-5-line fs-24"></i>
            </button>
            <!-- Topbar Page Title -->
            <div class="topbar-item ">

                <!-- Brand Logo -->
                <a href="{{url(route('admin.main_dashboard.index'))}}" class="logo">
    <span class="logo-light">
      <span class="logo-lg">
        <img src="{{asset(all_settings()->getItem('logo'))}}" alt="logo">
      </span>
      <span class="logo-sm">
        <img src="{{asset(all_settings()->getItem('logo'))}}" alt="small logo">
      </span>
    </span>
                    <span class="logo-dark">
      <span class="logo-lg">
        <img src="{{asset(all_settings()->getItem('logo'))}}" alt="dark logo">
      </span>
      <span class="logo-sm">
        <img src="{{asset(all_settings()->getItem('logo'))}}" alt="small logo">
      </span>
    </span>
                </a>

                <div> @if(app()->getLocale() == 'en') <h4 class="page-title fs-18 fw-bold mb-0 d-none d-md-flex">{{ all_settings()->getItem('company_name_en') }}</h4> @if(all_settings()->getItem('company_department_name_en')) <h5 class="page-title fs-13 fw-bold mb-0 m-1 d-none d-md-flex" >{{ all_settings()->getItem('company_department_name_en') }}</h5> @endif @else <h4 class="page-title fs-18 fw-bold mb-0 d-none d-md-flex">{{ all_settings()->getItem('company_name') }}</h4> @if(all_settings()->getItem('company_department_name')) <h5 class="page-title fs-13 fw-bold mb-0 m-1 d-none d-md-flex">{{ all_settings()->getItem('company_department_name') }}</h5> @endif @endif </div>
            </div>
        </div>
        <div class="d-flex align-items-center gap-2">
            <!-- Search for small devices -->
            <!--  <div class="topbar-item d-flex d-xl-none"><button class="topbar-link" data-bs-toggle="modal" data-bs-target="#searchModal" type="button"><i class="ri-search-line fs-22"></i></button></div>-->
            <!-- Button Trigger Search Modal -->
            <!--<div class="topbar-search d-none d-xl-flex gap-2 me-2 align-items-center" data-bs-toggle="modal"
                       data-bs-target="#searchModal" type="button"><i class="ri-search-line fs-18"></i><span class="me-2">Search something..</span></div>-->
            <!-------------------------original template languages buttons ------------------->


            <!-------------------------original template languages buttons ------------------->
        </div>
        <!-- Apps Dropdown -->
        <div class="topbar-item d-none d-sm-flex">
            <div class="dropdown">
                <!-- <button class="topbar-link dropdown-toggle drop-arrow-none" data-bs-toggle="dropdown"
                                    data-bs-offset="0,25" type="button" aria-haspopup="false" aria-expanded="false"><i class="ri-apps-2-add-line fs-22"></i></button>-->
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-lg p-0">
                    <div class="p-2">
                        <div class="row g-0">
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="{{asset('admin/assets/images/brands/slack.svg')}}" alt="slack">
                                    <span>Slack</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="{{asset('admin/assets/images/brands/gitlab.svg')}}" alt="Github">
                                    <span>Gitlab</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="{{asset('admin/assets/images/brands/dribbble.svg')}}" alt="dribbble">
                                    <span>Dribbble</span>
                                </a>
                            </div>
                        </div>
                        <div class="row g-0">
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="{{asset('admin/assets/images/brands/bitbucket.svg')}}" alt="bitbucket">
                                    <span>Bitbucket</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="{{asset('admin/assets/images/brands/dropbox.svg')}}" alt="dropbox">
                                    <span>Dropbox</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="{{asset('admin/assets/images/brands/google-cloud.svg')}}" alt="G Suite">
                                    <span>G Cloud</span>
                                </a>
                            </div>
                        </div>
                        <!-- end row-->
                        <div class="row g-0">
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="{{asset('admin/assets/images/brands/aws.svg')}}" alt="bitbucket">
                                    <span>AWS</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="{{asset('admin/assets/images/brands/digital-ocean.svg')}}" alt="dropbox">
                                    <span>Server</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="{{asset('admin/assets/images/brands/bootstrap.svg')}}" alt="G Suite">
                                    <span>Bootstrap</span>
                                </a>
                            </div>
                        </div>
                        <!-- end row-->
                    </div>
                </div>
            </div>
        </div>
        <!-- Button Trigger Customizer Offcanvas -->
        <!-- <div class="topbar-item d-none d-sm-flex"><button class="topbar-link" data-bs-toggle="offcanvas" data-bs-target="#theme-settings-offcanvas"
                            type="button"><i class="ri-settings-4-line fs-22"></i></button></div>-->
        <!-- Light/Dark Mode Button -->
        <!-- <div class="topbar-item d-none d-sm-flex"><button class="topbar-link" id="light-dark-mode" type="button"><i class="ri-moon-line fs-22"></i></button></div>-->
        <!-- User Dropdown -->
        <div class="topbar-item nav-user">
            <!-- Notification Dropdown -->
            <div class="topbar-item">
                <div class="dropdown">
                    @php  $roleIds = auth()->user()->roles->pluck('id');
                use App\Models\Noti; $noti = Noti::whereIn('roles_id', $roleIds)->where('viewed','no')->get()->count();
                    @endphp
                    <button class="topbar-link btn btn-soft-success btn-icon btn-sm rounded-circle" onclick="window.location.href='{{route('noti.index')}}'" type="button">
                        <i class="ri-notification-snooze-line  fs-18 animate-ring "></i>
                        <span class="noti-icon-badge rounded-circle">{{$noti}}</span>
                    </button>
                    <!---->
                </div>
            </div>
            <div class="drop-down">
                <div id="dropDown" class="drop-down__button">
          <span class="drop-down__name">
            <i class="ri-arrow-down-s-line"></i> {{auth()->user()->name}}
            <i class="ri-user-2-fill ri-user-2-fill fs-16 btn btn-soft-secondary btn-icon btn-sm rounded-circle  float-start"></i>
          </span>
                </div>
                <div class="drop-down__menu-box">
                    <ul class="drop-down__menu"> @foreach(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <!--<li class="{{app()->getLocale() === $localeCode ? 'd-none' : ''}} drop-down__item">
              <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                {{ $properties['native'] }}
                            <i class="ri-earth-line drop-down__item-icon"></i>
                          </a>
                        </li> -->@endforeach <li class=" drop-down__item">
                            <a href="javascript:void(0);">
                                <span onclick="window.location.href='{{route('admin.get_admin_logout')}}'">Sign Out</span>
                                <i  onclick="window.location.href='{{route('admin.get_admin_logout')}}'" class="ri-logout-box-line drop-down__item-icon"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </div>
</header>
<!-- Search Modal -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-transparent">
            <form>
                <div class="card mb-1">
                    <div class="px-3 py-2 d-flex flex-row align-items-center" id="top-search">
                        <i class="ri-search-line fs-22"></i>
                        <input type="search" class="form-control border-0" id="search-modal-input" placeholder="Search for actions, people,">
                        <button type="submit" class="btn p-0" data-bs-dismiss="modal" aria-label="Close">[esc]</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="page-content">
