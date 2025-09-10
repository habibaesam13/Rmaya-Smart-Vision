<!-- Menu -->
<!-- Sidenav Menu Start -->
<div class="sidenav-menu">

    <!-- Brand Logo -->
    <a href="{{url(route('admin.main_dashboard.index'))}}" class="logo">
                <span class="logo-light">
                    <span class="logo-lg"><img src="{{asset(all_settings()->getItem('logo'))}}" alt="logo"></span>
                    <span class="logo-sm"><img src="{{asset(all_settings()->getItem('logo'))}}"
                                               alt="small logo"></span>
                </span>

        <span class="logo-dark">
                    <span class="logo-lg"><img src="{{asset(all_settings()->getItem('logo'))}}"
                                               alt="dark logo"></span>
                    <span class="logo-sm"><img src="{{asset(all_settings()->getItem('logo'))}}"
                                               alt="small logo"></span>
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
                {{--                    <div class="dropdown-header noti-title">--}}
                {{--                        <h6 class="text-overflow m-0">Welcome !</h6>--}}
                {{--                    </div>--}}

                {{--                    <!-- item-->--}}
                {{--                    <a href="javascript:void(0);" class="dropdown-item">--}}
                {{--                        <i class="ri-account-circle-line me-1 fs-16 align-middle"></i>--}}
                {{--                        <span class="align-middle">My Account</span>--}}
                {{--                    </a>--}}

                {{--                    <!-- item-->--}}
                {{--                    <a href="javascript:void(0);" class="dropdown-item">--}}
                {{--                        <i class="ri-wallet-3-line me-1 fs-16 align-middle"></i>--}}
                {{--                        <span class="align-middle">Wallet : <span class="fw-semibold">$89.25k</span></span>--}}
                {{--                    </a>--}}

                {{--                    <!-- item-->--}}
                {{--                    <a href="javascript:void(0);" class="dropdown-item">--}}
                {{--                        <i class="ri-settings-2-line me-1 fs-16 align-middle"></i>--}}
                {{--                        <span class="align-middle">Settings</span>--}}
                {{--                    </a>--}}

                {{--                    <!-- item-->--}}
                {{--                    <a href="javascript:void(0);" class="dropdown-item">--}}
                {{--                        <i class="ri-question-line me-1 fs-16 align-middle"></i>--}}
                {{--                        <span class="align-middle">Support</span>--}}
                {{--                    </a>--}}

                {{--                    <div class="dropdown-divider"></div>--}}

                {{--                    <!-- item-->--}}
                {{--                    <a href="javascript:void(0);" class="dropdown-item">--}}
                {{--                        <i class="ri-lock-line me-1 fs-16 align-middle"></i>--}}
                {{--                        <span class="align-middle">Lock Screen</span>--}}
                {{--                    </a>--}}

                <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item active fw-semibold text-danger">
                        <i class="ri-logout-box-line me-1 fs-16 align-middle"></i>
                        <span onclick="window.location.href='{{route('admin.get_admin_logout')}}'" class="align-middle">Sign Out</span>
                    </a>
                </div>
            </div>
        </div>

        <!--- Sidenav Menu -->
        <ul class="side-nav">
            <!------------start original nav ----------------->
        {{--                <li class="side-nav-title">Navigation</li>--}}

        {{--                <li class="side-nav-item">--}}
        {{--                    <a href="index.html" class="side-nav-link">--}}
        {{--                        <span class="menu-icon"><i class="ri-dashboard-3-line"></i></span>--}}
        {{--                        <span class="menu-text"> Dashboard </span>--}}
        {{--                        <span class="badge bg-danger rounded-pill">5</span>--}}
        {{--                    </a>--}}
        {{--                </li>--}}
        {{--                --}}
        {{--                <li class="side-nav-item">--}}
        {{--                    <a href="apps-companies.html" class="side-nav-link">--}}
        {{--                        <span class="menu-icon"><i class="ri-shake-hands-line"></i></span>--}}
        {{--                        <span class="menu-text"> Companies </span>--}}
        {{--                    </a>--}}
        {{--                </li>--}}

        {{--                <li class="side-nav-item">--}}
        {{--                    <a data-bs-toggle="collapse" href="#sidebarInvoice" aria-expanded="false" aria-controls="sidebarInvoice"--}}
        {{--                       class="side-nav-link">--}}
        {{--                        <span class="menu-icon"><i class="ri-file-paper-line"></i></span>--}}
        {{--                        <span class="menu-text"> Invoice</span>--}}
        {{--                        <span class="menu-arrow"></span>--}}
        {{--                    </a>--}}
        {{--                    <div class="collapse" id="sidebarInvoice">--}}
        {{--                        <ul class="sub-menu">--}}
        {{--                            <li class="side-nav-item">--}}
        {{--                                <a href="apps-invoices.html" class="side-nav-link">--}}
        {{--                                    <span class="menu-text">Invoices</span>--}}
        {{--                                </a>--}}
        {{--                            </li>--}}
        {{--                            <li class="side-nav-item">--}}
        {{--                                <a href="apps-invoice-details.html" class="side-nav-link">--}}
        {{--                                    <span class="menu-text">View Invoice</span>--}}
        {{--                                </a>--}}
        {{--                            </li>--}}
        {{--                            <li class="side-nav-item">--}}
        {{--                                <a href="apps-invoice-create.html" class="side-nav-link">--}}
        {{--                                    <span class="menu-text">Create Invoice</span>--}}
        {{--                                </a>--}}
        {{--                            </li>--}}
        {{--                        </ul>--}}
        {{--                    </div>--}}
        {{--                </li>--}}

        {{--                <li class="side-nav-title mt-2">--}}
        {{--                    More--}}
        {{--                </li>--}}

        {{--                <li class="side-nav-item">--}}
        {{--                    <a data-bs-toggle="collapse" href="#sidebarLayouts" aria-expanded="false" aria-controls="sidebarLayouts"--}}
        {{--                       class="side-nav-link">--}}
        {{--                        <span class="menu-icon"><i class="ri-layout-2-line"></i></span>--}}
        {{--                        <span class="menu-text"> Layouts </span>--}}
        {{--                        <span class="menu-arrow"></span>--}}
        {{--                    </a>--}}
        {{--                    <div class="collapse" id="sidebarLayouts">--}}
        {{--                        <ul class="sub-menu">--}}
        {{--                            <li class="side-nav-item">--}}
        {{--                                <a href="layouts-horizontal.html" target="_blank" class="side-nav-link">Horizontal</a>--}}
        {{--                            </li>--}}
        {{--                            <li class="side-nav-item">--}}
        {{--                                <a href="layouts-detached.html" target="_blank" class="side-nav-link">Detached</a>--}}
        {{--                            </li>--}}
        {{--                            <li class="side-nav-item">--}}
        {{--                                <a href="layouts-full.html" target="_blank" class="side-nav-link">Full View</a>--}}
        {{--                            </li>--}}
        {{--                            <li class="side-nav-item">--}}
        {{--                                <a href="layouts-fullscreen.html" target="_blank" class="side-nav-link">Fullscreen View</a>--}}
        {{--                            </li>--}}
        {{--                            <li class="side-nav-item">--}}
        {{--                                <a href="layouts-hover.html" target="_blank" class="side-nav-link">Hover Menu</a>--}}
        {{--                            </li>--}}
        {{--                            <li class="side-nav-item">--}}
        {{--                                <a href="layouts-compact.html" target="_blank" class="side-nav-link">Compact</a>--}}
        {{--                            </li>--}}
        {{--                            <li class="side-nav-item">--}}
        {{--                                <a href="layouts-icon-view.html" target="_blank" class="side-nav-link">Icon View</a>--}}
        {{--                            </li>--}}
        {{--                        </ul>--}}
        {{--                    </div>--}}
        {{--                </li>--}}
        <!------------end original nav ----------------->
{{--            <li class="side-nav-title mt-2">--}}

{{--            </li>--}}


            @if(checkModulePermission('settings', 'view'))
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarLayouts_settings" aria-expanded="false"
                       aria-controls="sidebarLayouts_2"
                       class="side-nav-link">
                        <span class="menu-icon"><i class="ri-layout-2-line"></i></span>
                        <span class="menu-text"> {{__('lang.settings')}} </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarLayouts_settings">
                        <ul class="sub-menu">
                            {{--                            @if(checkModulePermission('roles', 'add'))--}}
                            {{--                                <li class="side-nav-item">--}}
                            {{--                                    <a href="{{url(route('admin.roles.create'))}}"--}}
                            {{--                                       class="side-nav-link"> {{__('lang.Add Role')}} </a>--}}
                            {{--                                </li>--}}
                            {{--                            @endif--}}

                            <li class="side-nav-item">
                                <a href="{{url(route('admin.settings.edit'))}}"
                                   class="side-nav-link"> {{__('lang.Show Setting')}} </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif


            @if(checkModulePermission('events', 'view'))
                <li class="side-nav-item @if (request()->routeIs('admin.events.*')) active   @endif ">
                    <a data-bs-toggle="collapse" href="#sidebarLayouts_1" aria-expanded="false"
                       aria-controls="sidebarLayouts_1"
                       class="side-nav-link">
                        <span class="menu-icon"><i class="ri-layout-2-line"></i></span>
                        <span class="menu-text"> {{__('lang.Events')}} </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse @if (request()->routeIs('admin.events.*')) show   @endif "
                         id="sidebarLayouts_1">
                        <ul class="sub-menu">

                            @if(checkModulePermission('events', 'add'))
                                <li class="side-nav-item">
                                    <a href="{{url(route('admin.events.create'))}}"
                                       class="side-nav-link"> {{__('lang.Add Event')}} </a>
                                </li>
                            @endif
                            <li class="side-nav-item">
                                <a href="{{url(route('admin.events.index'))}}"
                                   class="side-nav-link"> {{__('lang.Show Events')}} </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif

            @if(checkModulePermission('event_places', 'view'))
                <li class="side-nav-item  @if (request()->routeIs('admin.event_places.*')) active   @endif">
                    <a data-bs-toggle="collapse" href="#sidebarLayouts_2" aria-expanded="false"
                       aria-controls="sidebarLayouts_2"
                       class="side-nav-link">
                        <span class="menu-icon"><i class="ri-layout-2-line"></i></span>
                        <span class="menu-text"> {{__('lang.Event Places')}} </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse  @if (request()->routeIs('admin.event_places.*')) show   @endif"
                         id="sidebarLayouts_2">
                        <ul class="sub-menu">
                            @if(checkModulePermission('event_places', 'add'))
                                <li class="side-nav-item">
                                    <a href="{{url(route('admin.event_places.create'))}}"
                                       class="side-nav-link"> {{__('lang.Add Event Place')}} </a>
                                </li>
                            @endif

                            <li class="side-nav-item">
                                <a href="{{url(route('admin.event_places.index'))}}"
                                   class="side-nav-link"> {{__('lang.Show Event Place')}} </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif

            @if(checkModulePermission('event_types', 'view'))
                <li class="side-nav-item  @if (request()->routeIs('admin.event_types.*')) active   @endif">
                    <a data-bs-toggle="collapse" href="#sidebarLayouts_3" aria-expanded="false"
                       aria-controls="sidebarLayouts_3"
                       class="side-nav-link">
                        <span class="menu-icon"><i class="ri-layout-2-line"></i></span>
                        <span class="menu-text">  {{__('lang.Event Types')}}  </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse  @if (request()->routeIs('admin.event_types.*')) show   @endif"
                         id="sidebarLayouts_3">
                        <ul class="sub-menu">
                            @if(checkModulePermission('event_types', 'add'))
                                <li class="side-nav-item">
                                    <a href="{{url(route('admin.event_types.create'))}}"
                                       class="side-nav-link"> {{__('lang.Add Event Type')}} </a>
                                </li>
                            @endif


                            <li class="side-nav-item">
                                <a href="{{url(route('admin.event_types.index'))}}"
                                   class="side-nav-link"> {{__('lang.Show Event Type')}} </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif

            @if(checkModulePermission('visitors', 'view'))
                <li class="side-nav-item  @if (request()->routeIs('admin.visitors.*')) active   @endif">
                    <a data-bs-toggle="collapse" href="#sidebarLayouts_4" aria-expanded="false"
                       aria-controls="sidebarLayouts_4"
                       class="side-nav-link">
                        <span class="menu-icon"><i class="ri-layout-2-line"></i></span>
                        <span class="menu-text">  {{__('lang.Visitors')}}  </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse  @if (request()->routeIs('admin.visitors.*')) show   @endif"
                         id="sidebarLayouts_4">
                        <ul class="sub-menu">
                            <li class="side-nav-item">
                                <a href="{{url(route('admin.visitors.index'))}}"
                                   class="side-nav-link"> {{__('lang.show')}}   {{__('lang.Visitors')}} </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif

            @if(checkModulePermission('reports', 'view')   && checkModulePermission('events', 'view'))
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarLayouts_reports" aria-expanded="false"
                       aria-controls="sidebarLayouts_reports"
                       class="side-nav-link">
                        <span class="menu-icon"><i class="ri-layout-2-line"></i></span>
                        <span class="menu-text">  {{__('lang.Reports')}}  </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarLayouts_reports">
                        <ul class="sub-menu">
                            <li class="side-nav-item">
                                <a href="{{url(route('admin.events_reports.get'))}}"
                                   class="side-nav-link">{{__('lang.show')}} {{__('lang.events_reports')}}</a>
                            </li>


                            <li class="side-nav-item">
                                <a href="{{url(route('admin.events_prices_reports.get'))}}"
                                   class="side-nav-link">{{__('lang.show')}} {{__('lang.events_prices_reports')}}</a>
                            </li>


                            <li class="side-nav-item">
                                <a href="{{url(route('admin.events_insurance_payments_reports.get'))}}"
                                   class="side-nav-link">{{__('lang.show')}} {{__('lang.events_insurance_payments')}}</a>
                            </li>


                            <li class="side-nav-item">
                                <a href="{{url(route('admin.event_approval_periods_reports.get'))}}"
                                   class="side-nav-link">{{__('lang.show')}} {{__('lang.event_approval_periods_reports')}}</a>
                            </li>


                            <li class="side-nav-item">
                                <a href="{{url(route('admin.event_application_time_reports.get'))}}"
                                   class="side-nav-link">{{__('lang.show')}} {{__('lang.event_application_time_reports')}}</a>
                            </li>


                            {{--                            <li class="side-nav-item">--}}
                            {{--                                <a href="{{url(route('admin.event_application_approval_time_reports.get'))}}"--}}
                            {{--                                   class="side-nav-link">{{__('lang.show')}} {{__('lang.event_application_approval_time_reports')}}</a>--}}
                            {{--                            </li>--}}


                            <li class="side-nav-item">
                                <a href="{{url(route('admin.event_application_rating_reports.get'))}}"
                                   class="side-nav-link">{{__('lang.show')}} {{__('lang.event_application_rating_reports')}}</a>
                            </li>


                            {{--                            get_admin_logout--}}


                        </ul>
                    </div>
                </li>
            @endif

            @if(checkModulePermission('admins', 'view'))
                <li class="side-nav-item  @if (request()->routeIs('admin.users.*') || request()->routeIs('admin.roles.*')  || request()->routeIs('admin.give_module_to_role_show')  ) active   @endif">
                    <a data-bs-toggle="collapse" href="#sidebarLayouts_admins" aria-expanded="false"
                       aria-controls="sidebarLayouts_2"
                       class="side-nav-link">
                        <span class="menu-icon"><i class="ri-layout-2-line"></i></span>
                        <span class="menu-text"> {{__('lang.admins')}} </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div
                        class="collapse  @if (request()->routeIs('admin.users.*')  ||  request()->routeIs('admin.roles.*') || request()->routeIs('admin.give_module_to_role_show')) show   @endif"
                        id="sidebarLayouts_admins">
                        <ul class="sub-menu">
                            @if(checkModulePermission('admins', 'add'))
                                <li class="side-nav-item">
                                    <a href="{{url(route('admin.users.create'))}}"
                                       class="side-nav-link"> {{__('lang.Add Admin')}} </a>
                                </li>
                            @endif

                            <li class="side-nav-item">
                                <a href="{{url(route('admin.users.index'))}}"
                                   class="side-nav-link"> {{__('lang.Show Admin')}} </a>
                            </li>

                            @if(checkModulePermission('roles', 'view'))
                                <li class="side-nav-item">
                                    <a href="{{url(route('admin.roles.index'))}}"
                                       class="side-nav-link"> {{__('lang.Show Role')}} </a>
                                </li>
                            @endif

                        </ul>
                    </div>
                </li>
            @endif


            {{--            @if(checkModulePermission('roles', 'view'))--}}
            {{--                <li class="side-nav-item">--}}
            {{--                    <a data-bs-toggle="collapse" href="#sidebarLayouts_roles" aria-expanded="false"--}}
            {{--                       aria-controls="sidebarLayouts_2"--}}
            {{--                       class="side-nav-link">--}}
            {{--                        <span class="menu-icon"><i class="ri-layout-2-line"></i></span>--}}
            {{--                        <span class="menu-text"> {{__('lang.roles')}} </span>--}}
            {{--                        <span class="menu-arrow"></span>--}}
            {{--                    </a>--}}
            {{--                    <div class="collapse" id="sidebarLayouts_roles">--}}
            {{--                        <ul class="sub-menu">--}}
            {{--                            @if(checkModulePermission('roles', 'add'))--}}
            {{--                                <li class="side-nav-item">--}}
            {{--                                    <a href="{{url(route('admin.roles.create'))}}"--}}
            {{--                                       class="side-nav-link"> {{__('lang.Add Role')}} </a>--}}
            {{--                                </li>--}}
            {{--                            @endif--}}

            {{--                            <li class="side-nav-item">--}}
            {{--                                <a href="{{url(route('admin.roles.index'))}}"--}}
            {{--                                   class="side-nav-link"> {{__('lang.Show Role')}} </a>--}}
            {{--                            </li>--}}
            {{--                        </ul>--}}
            {{--                    </div>--}}
            {{--                </li>--}}
            {{--            @endif--}}
            @if(checkModulePermission('pages', 'view'))
                <li class="side-nav-item  @if (request()->routeIs('admin.pages.*')) active   @endif">
                    <a data-bs-toggle="collapse" href="#sidebarLayouts_pages" aria-expanded="false"
                       aria-controls="sidebarLayouts_pages"
                       class="side-nav-link">
                        <span class="menu-icon"><i class="ri-layout-2-line"></i></span>
                        <span class="menu-text"> {{__('lang.pages')}} </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse  @if (request()->routeIs('admin.pages.*')) show   @endif"
                         id="sidebarLayouts_pages">
                        <ul class="sub-menu">
                            {{--                            @if(checkModulePermission('pages', 'add'))--}}
                            {{--                                <li class="side-nav-item">--}}
                            {{--                                    <a href="{{url(route('admin.pages.create'))}}"--}}
                            {{--                                       class="side-nav-link"> {{__('lang.Add Page')}} </a>--}}
                            {{--                                </li>--}}
                            {{--                            @endif--}}

                            <li class="side-nav-item">
                                <a href="{{url(route('admin.pages.index'))}}"
                                   class="side-nav-link"> {{__('lang.Show Page')}} </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif

            @if(checkModulePermission('sliders', 'view'))
                <li class="side-nav-item  @if (request()->routeIs('admin.sliders.*')) active   @endif">
                    <a data-bs-toggle="collapse" href="#sidebarLayouts_sliders" aria-expanded="false"
                       aria-controls="sidebarLayouts_sliders"
                       class="side-nav-link">
                        <span class="menu-icon"><i class="ri-layout-2-line"></i></span>
                        <span class="menu-text"> {{__('lang.sliders')}} </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse  @if (request()->routeIs('admin.sliders.*')) show   @endif"
                         id="sidebarLayouts_sliders">
                        <ul class="sub-menu">
                            @if(checkModulePermission('sliders', 'add'))
                                <li class="side-nav-item">
                                    <a href="{{url(route('admin.sliders.create'))}}"
                                       class="side-nav-link"> {{__('lang.Add slider')}} </a>
                                </li>
                            @endif

                            <li class="side-nav-item">
                                <a href="{{url(route('admin.sliders.index'))}}"
                                   class="side-nav-link"> {{__('lang.Show sliders')}} </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif




            @if(checkModulePermission('contact_us', 'view'))
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarLayouts_contact_us" aria-expanded="false"
                       aria-controls="sidebarLayouts_contact_us"
                       class="side-nav-link">
                        <span class="menu-icon"><i class="ri-layout-2-line"></i></span>
                        <span class="menu-text">  {{__('lang.contact_us_messages')}}  </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarLayouts_contact_us">
                        <ul class="sub-menu">


                            <li class="side-nav-item">
                                <a href="{{url(route('admin.contact_us.index'))}}"
                                   class="side-nav-link"> {{__('lang.show')}}   {{__('lang.contact_us_messages')}} </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif


            @if(checkModulePermission('logs', 'view'))
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarLayouts_logs" aria-expanded="false"
                       aria-controls="sidebarLayouts_logs"
                       class="side-nav-link">
                        <span class="menu-icon"><i class="ri-layout-2-line"></i></span>
                        <span class="menu-text">  {{__('lang.logs')}}  </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarLayouts_logs">
                        <ul class="sub-menu">


                            <li class="side-nav-item">
                                <a href="{{url(route('admin.logs.index'))}}"
                                   class="side-nav-link"> {{__('lang.show')}}  {{__('lang.logs')}} </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif


        </ul>


        <!-- Help Box -->
        <div class="help-box text-center">
{{--            <h5 class="fw-semibold fs-16">Unlimited Access</h5>--}}
{{--            <p class="mb-3 opacity-75">Upgrade to plan to get access to unlimited reports</p>--}}
{{--            <a href="javascript: void(0);" class="btn btn-danger btn-sm">Upgrade</a>--}}
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
                            <span class="logo-lg"><img src="{{asset('admin/assets/images/logo.png')}}"
                                                       alt="logo"></span>
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
                    <h5 class="page-title mt-1 text-primary  fw-bold mb-0">{{all_settings()->getItem('company_department_name')}}</h5>

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

        {{--            <!-- Button Trigger Search Modal -->--}}
        {{--            <div class="topbar-search d-none d-xl-flex gap-2 me-2 align-items-center" data-bs-toggle="modal"--}}
        {{--                 data-bs-target="#searchModal" type="button">--}}
        {{--                <i class="ri-search-line fs-18"></i>--}}
        {{--                <span class="me-2">Search something..</span>--}}
        {{--            </div>--}}


        <!-------------------------original template languages buttons ------------------->
        {{--                <!-- Language Dropdown -->--}}
        {{--                <div class="topbar-item">--}}
        {{--                    <div class="dropdown">--}}
        {{--                        <button class="topbar-link" data-bs-toggle="dropdown" data-bs-offset="0,32" type="button"--}}
        {{--                                aria-haspopup="false" aria-expanded="false">--}}
        {{--                            <img src="{{asset('admin/assets/images/flags/us.svg')}}" alt="user-image" class="w-100 rounded" height="18"--}}
        {{--                                 id="selected-language-image">--}}
        {{--                        </button>--}}

        {{--                        <div class="dropdown-menu dropdown-menu-end">--}}
        {{--                            <!-- item-->--}}
        {{--                            <a href="javascript:void(0);" class="dropdown-item" data-translator-lang="en">--}}
        {{--                                <img src="{{asset('admin/assets/images/flags/us.svg')}}" alt="user-image" class="me-1 rounded" height="18"--}}
        {{--                                     data-translator-image> <span class="align-middle">English</span>--}}
        {{--                            </a>--}}

        {{--                            <!-- item-->--}}
        {{--                            <a href="javascript:void(0);" class="dropdown-item" data-translator-lang="hi">--}}
        {{--                                <img src="{{asset('admin/assets/images/flags/in.svg')}}" alt="user-image" class="me-1 rounded" height="18"--}}
        {{--                                     data-translator-image> <span class="align-middle">Hindi</span>--}}
        {{--                            </a>--}}

        {{--                            <!-- item-->--}}
        {{--                            <a href="javascript:void(0);" class="dropdown-item">--}}
        {{--                                <img src="{{asset('admin/assets/images/flags/de.svg')}}" alt="user-image" class="me-1 rounded" height="18">--}}
        {{--                                <span class="align-middle">German</span>--}}
        {{--                            </a>--}}

        {{--                            <!-- item-->--}}
        {{--                            <a href="javascript:void(0);" class="dropdown-item">--}}
        {{--                                <img src="{{asset('admin/assets/images/flags/it.svg')}}" alt="user-image" class="me-1 rounded" height="18">--}}
        {{--                                <span class="align-middle">Italian</span>--}}
        {{--                            </a>--}}

        {{--                            <!-- item-->--}}
        {{--                            <a href="javascript:void(0);" class="dropdown-item">--}}
        {{--                                <img src="{{asset('admin/assets/images/flags/es.svg')}}" alt="user-image" class="me-1 rounded" height="18">--}}
        {{--                                <span class="align-middle">Spanish</span>--}}
        {{--                            </a>--}}

        {{--                            <!-- item-->--}}
        {{--                            <a href="javascript:void(0);" class="dropdown-item">--}}
        {{--                                <img src="{{asset('admin/assets/images/flags/ru.svg')}}" alt="user-image" class="me-1 rounded" height="18">--}}
        {{--                                <span class="align-middle">Russian</span>--}}
        {{--                            </a>--}}


        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        <!-------------------------original template languages buttons ------------------->


            <!-------------------------languages buttons ------------------->
            <ul>
                @foreach(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <li class="{{app()->getLocale() === $localeCode ? 'd-none' : ''}}">
                        <a rel="alternate" hreflang="{{ $localeCode }}"
                           href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            {{ $properties['native'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
            <!-------------------------languages buttons ------------------->

            <!-----start deleted icons ----------------->
        {{--            <!-- Notification Dropdown -->--}}
        {{--            <div class="topbar-item">--}}
        {{--                <div class="dropdown">--}}
        {{--                    <button class="topbar-link dropdown-toggle drop-arrow-none" data-bs-toggle="dropdown"--}}
        {{--                            data-bs-offset="0,25" type="button" data-bs-auto-close="outside" aria-haspopup="false"--}}
        {{--                            aria-expanded="false">--}}
        {{--                        <i class="ri-notification-snooze-line animate-ring fs-22"></i>--}}
        {{--                        <span class="noti-icon-badge"></span>--}}
        {{--                    </button>--}}

        {{--                    <div class="dropdown-menu p-0 dropdown-menu-end dropdown-menu-lg" style="min-height: 300px;">--}}
        {{--                        <div class="p-2 border-bottom position-relative border-dashed">--}}
        {{--                            <div class="row align-items-center">--}}
        {{--                                <div class="col">--}}
        {{--                                    <h6 class="m-0 fs-16 fw-semibold"> Notifications</h6>--}}
        {{--                                </div>--}}
        {{--                                <div class="col-auto">--}}
        {{--                                    <div class="dropdown">--}}
        {{--                                        <a href="#" class="dropdown-toggle drop-arrow-none link-dark"--}}
        {{--                                           data-bs-toggle="dropdown" data-bs-offset="0,15" aria-expanded="false">--}}
        {{--                                            <i class="ri-settings-2-line fs-22 align-middle"></i>--}}
        {{--                                        </a>--}}
        {{--                                        <div class="dropdown-menu dropdown-menu-end">--}}
        {{--                                            <!-- item-->--}}
        {{--                                            <a href="javascript:void(0);" class="dropdown-item">Mark as Read</a>--}}
        {{--                                            <!-- item-->--}}
        {{--                                            <a href="javascript:void(0);" class="dropdown-item">Delete All</a>--}}
        {{--                                            <!-- item-->--}}
        {{--                                            <a href="javascript:void(0);" class="dropdown-item">Do not Disturb</a>--}}
        {{--                                            <!-- item-->--}}
        {{--                                            <a href="javascript:void(0);" class="dropdown-item">Other Settings</a>--}}
        {{--                                        </div>--}}
        {{--                                    </div>--}}
        {{--                                </div>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}

        {{--                        <div class="position-relative rounded-0" style="max-height: 300px;" data-simplebar>--}}
        {{--                            <!-- item-->--}}
        {{--                            <div class="dropdown-item notification-item py-2 text-wrap active" id="notification-1">--}}
        {{--                                        <span class="d-flex align-items-center">--}}
        {{--                                            <span class="me-3 position-relative flex-shrink-0">--}}
        {{--                                                <img src="{{asset('admin/assets/images/users/avatar-2.jpg')}}"--}}
        {{--                                                     class="avatar-lg rounded-circle"--}}
        {{--                                                     alt=""/>--}}
        {{--                                            </span>--}}
        {{--                                            <span class="flex-grow-1 text-muted">--}}
        {{--                                                <span class="fw-medium text-body">Glady Haid</span> commented on <span--}}
        {{--                                                    class="fw-medium text-body">Highdmin admin status</span>--}}
        {{--                                                <br/>--}}
        {{--                                                <span class="fs-12">25m ago</span>--}}
        {{--                                            </span>--}}
        {{--                                            <span class="notification-item-close">--}}
        {{--                                                <button type="button"--}}
        {{--                                                        class="btn btn-ghost-danger rounded-circle btn-sm btn-icon"--}}
        {{--                                                        data-dismissible="#notification-1">--}}
        {{--                                                    <i class="ri-close-line fs-16"></i>--}}
        {{--                                                </button>--}}
        {{--                                            </span>--}}
        {{--                                        </span>--}}
        {{--                            </div>--}}

        {{--                            <!-- item-->--}}
        {{--                            <div class="dropdown-item notification-item py-2 text-wrap" id="notification-2">--}}
        {{--                                        <span class="d-flex align-items-center">--}}
        {{--                                            <span class="me-3 position-relative flex-shrink-0">--}}
        {{--                                                <img src="{{asset('admin/assets/images/users/avatar-4.jpg')}}"--}}
        {{--                                                     class="avatar-lg rounded-circle"--}}
        {{--                                                     alt=""/>--}}
        {{--                                            </span>--}}
        {{--                                            <span class="flex-grow-1 text-muted">--}}
        {{--                                                <span class="fw-medium text-body">Tommy Berry</span> donated <span--}}
        {{--                                                    class="text-success">$100.00</span> for <span--}}
        {{--                                                    class="fw-medium text-body">Carbon removal program</span>--}}
        {{--                                                <br/>--}}
        {{--                                                <span class="fs-12">58m ago</span>--}}
        {{--                                            </span>--}}
        {{--                                            <span class="notification-item-close">--}}
        {{--                                                <button type="button"--}}
        {{--                                                        class="btn btn-ghost-danger rounded-circle btn-sm btn-icon"--}}
        {{--                                                        data-dismissible="#notification-2">--}}
        {{--                                                    <i class="ri-close-line fs-16"></i>--}}
        {{--                                                </button>--}}
        {{--                                            </span>--}}
        {{--                                        </span>--}}
        {{--                            </div>--}}

        {{--                            <!-- item-->--}}
        {{--                            <div class="dropdown-item notification-item py-2 text-wrap" id="notification-3">--}}
        {{--                                        <span class="d-flex align-items-center">--}}
        {{--                                            <div class="avatar-lg flex-shrink-0 me-3">--}}
        {{--                                                <span--}}
        {{--                                                    class="avatar-title bg-success-subtle text-success rounded-circle fs-22">--}}
        {{--                                                    <iconify-icon icon="solar:wallet-money-bold-duotone"></iconify-icon>--}}
        {{--                                                </span>--}}
        {{--                                            </div>--}}
        {{--                                            <span class="flex-grow-1 text-muted">--}}
        {{--                                                You withdraw a <span class="fw-medium text-body">$500</span> by <span--}}
        {{--                                                    class="fw-medium text-body">New York ATM</span>--}}
        {{--                                                <br/>--}}
        {{--                                                <span class="fs-12">2h ago</span>--}}
        {{--                                            </span>--}}
        {{--                                            <span class="notification-item-close">--}}
        {{--                                                <button type="button"--}}
        {{--                                                        class="btn btn-ghost-danger rounded-circle btn-sm btn-icon"--}}
        {{--                                                        data-dismissible="#notification-3">--}}
        {{--                                                    <i class="ri-close-line fs-16"></i>--}}
        {{--                                                </button>--}}
        {{--                                            </span>--}}
        {{--                                        </span>--}}
        {{--                            </div>--}}

        {{--                            <!-- item-->--}}
        {{--                            <div class="dropdown-item notification-item py-2 text-wrap" id="notification-4">--}}
        {{--                                        <span class="d-flex align-items-center">--}}
        {{--                                            <span class="me-3 position-relative flex-shrink-0">--}}
        {{--                                                <img src="{{asset('admin/assets/images/users/avatar-7.jpg')}}"--}}
        {{--                                                     class="avatar-lg rounded-circle"--}}
        {{--                                                     alt=""/>--}}
        {{--                                            </span>--}}
        {{--                                            <span class="flex-grow-1 text-muted">--}}
        {{--                                                <span--}}
        {{--                                                    class="fw-medium text-body">Richard Allen</span> followed you in <span--}}
        {{--                                                    class="fw-medium text-body">Facebook</span>--}}
        {{--                                                <br/>--}}
        {{--                                                <span class="fs-12">3h ago</span>--}}
        {{--                                            </span>--}}
        {{--                                            <span class="notification-item-close">--}}
        {{--                                                <button type="button"--}}
        {{--                                                        class="btn btn-ghost-danger rounded-circle btn-sm btn-icon"--}}
        {{--                                                        data-dismissible="#notification-4">--}}
        {{--                                                    <i class="ri-close-line fs-16"></i>--}}
        {{--                                                </button>--}}
        {{--                                            </span>--}}
        {{--                                        </span>--}}
        {{--                            </div>--}}

        {{--                            <!-- item-->--}}
        {{--                            <div class="dropdown-item notification-item py-2 text-wrap" id="notification-5">--}}
        {{--                                        <span class="d-flex align-items-center">--}}
        {{--                                            <span class="me-3 position-relative flex-shrink-0">--}}
        {{--                                                <img src="{{asset('admin/assets/images/users/avatar-10.jpg')}}"--}}
        {{--                                                     class="avatar-lg rounded-circle"--}}
        {{--                                                     alt=""/>--}}
        {{--                                            </span>--}}
        {{--                                            <span class="flex-grow-1 text-muted">--}}
        {{--                                                <span class="fw-medium text-body">Victor Collier</span> liked you recent photo--}}
        {{--                                                in <span class="fw-medium text-body">Instagram</span>--}}
        {{--                                                <br/>--}}
        {{--                                                <span class="fs-12">10h ago</span>--}}
        {{--                                            </span>--}}
        {{--                                            <span class="notification-item-close">--}}
        {{--                                                <button type="button"--}}
        {{--                                                        class="btn btn-ghost-danger rounded-circle btn-sm btn-icon"--}}
        {{--                                                        data-dismissible="#notification-5">--}}
        {{--                                                    <i class="ri-close-line fs-16"></i>--}}
        {{--                                                </button>--}}
        {{--                                            </span>--}}
        {{--                                        </span>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}

        {{--                        <!-- All-->--}}
        {{--                        <a href="javascript:void(0);"--}}
        {{--                           class="dropdown-item position-absolute bottom-0 notification-item text-center text-reset text-decoration-underline fw-bold notify-item border-top border-light py-2">--}}
        {{--                            View All--}}
        {{--                        </a>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}

        {{--            <!-- Apps Dropdown -->--}}
        {{--            <div class="topbar-item d-none d-sm-flex">--}}
        {{--                <div class="dropdown">--}}
        {{--                    <button class="topbar-link dropdown-toggle drop-arrow-none" data-bs-toggle="dropdown"--}}
        {{--                            data-bs-offset="0,25" type="button" aria-haspopup="false" aria-expanded="false">--}}
        {{--                        <i class="ri-apps-2-add-line fs-22"></i>--}}
        {{--                    </button>--}}
        {{--                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-lg p-0">--}}
        {{--                        <div class="p-2">--}}
        {{--                            <div class="row g-0">--}}
        {{--                                <div class="col">--}}
        {{--                                    <a class="dropdown-icon-item" href="#">--}}
        {{--                                        <img src="{{asset('admin/assets/images/brands/slack.svg')}}" alt="slack">--}}
        {{--                                        <span>Slack</span>--}}
        {{--                                    </a>--}}
        {{--                                </div>--}}
        {{--                                <div class="col">--}}
        {{--                                    <a class="dropdown-icon-item" href="#">--}}
        {{--                                        <img src="{{asset('admin/assets/images/brands/gitlab.svg')}}" alt="Github">--}}
        {{--                                        <span>Gitlab</span>--}}
        {{--                                    </a>--}}
        {{--                                </div>--}}
        {{--                                <div class="col">--}}
        {{--                                    <a class="dropdown-icon-item" href="#">--}}
        {{--                                        <img src="{{asset('admin/assets/images/brands/dribbble.svg')}}" alt="dribbble">--}}
        {{--                                        <span>Dribbble</span>--}}
        {{--                                    </a>--}}
        {{--                                </div>--}}
        {{--                            </div>--}}

        {{--                            <div class="row g-0">--}}
        {{--                                <div class="col">--}}
        {{--                                    <a class="dropdown-icon-item" href="#">--}}
        {{--                                        <img src="{{asset('admin/assets/images/brands/bitbucket.svg')}}"--}}
        {{--                                             alt="bitbucket">--}}
        {{--                                        <span>Bitbucket</span>--}}
        {{--                                    </a>--}}
        {{--                                </div>--}}
        {{--                                <div class="col">--}}
        {{--                                    <a class="dropdown-icon-item" href="#">--}}
        {{--                                        <img src="{{asset('admin/assets/images/brands/dropbox.svg')}}" alt="dropbox">--}}
        {{--                                        <span>Dropbox</span>--}}
        {{--                                    </a>--}}
        {{--                                </div>--}}
        {{--                                <div class="col">--}}
        {{--                                    <a class="dropdown-icon-item" href="#">--}}
        {{--                                        <img src="{{asset('admin/assets/images/brands/google-cloud.svg')}}"--}}
        {{--                                             alt="G Suite">--}}
        {{--                                        <span>G Cloud</span>--}}
        {{--                                    </a>--}}
        {{--                                </div>--}}
        {{--                            </div> <!-- end row-->--}}

        {{--                            <div class="row g-0">--}}
        {{--                                <div class="col">--}}
        {{--                                    <a class="dropdown-icon-item" href="#">--}}
        {{--                                        <img src="{{asset('admin/assets/images/brands/aws.svg')}}" alt="bitbucket">--}}
        {{--                                        <span>AWS</span>--}}
        {{--                                    </a>--}}
        {{--                                </div>--}}
        {{--                                <div class="col">--}}
        {{--                                    <a class="dropdown-icon-item" href="#">--}}
        {{--                                        <img src="{{asset('admin/assets/images/brands/digital-ocean.svg')}}"--}}
        {{--                                             alt="dropbox">--}}
        {{--                                        <span>Server</span>--}}
        {{--                                    </a>--}}
        {{--                                </div>--}}
        {{--                                <div class="col">--}}
        {{--                                    <a class="dropdown-icon-item" href="#">--}}
        {{--                                        <img src="{{asset('admin/assets/images/brands/bootstrap.svg')}}" alt="G Suite">--}}
        {{--                                        <span>Bootstrap</span>--}}
        {{--                                    </a>--}}
        {{--                                </div>--}}
        {{--                            </div> <!-- end row-->--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}

        {{--            <!-- Button Trigger Customizer Offcanvas -->--}}
        {{--            <div class="topbar-item d-none d-sm-flex">--}}
        {{--                <button class="topbar-link" data-bs-toggle="offcanvas" data-bs-target="#theme-settings-offcanvas"--}}
        {{--                        type="button">--}}
        {{--                    <i class="ri-settings-4-line fs-22"></i>--}}
        {{--                </button>--}}
        {{--            </div>--}}

        {{--            <!-- Light/Dark Mode Button -->--}}
        {{--            <div class="topbar-item d-none d-sm-flex">--}}
        {{--                <button class="topbar-link" id="light-dark-mode" type="button">--}}
        {{--                    <i class="ri-moon-line fs-22"></i>--}}
        {{--                </button>--}}
        {{--            </div>--}}
        <!-----end deleted icons ----------------->

            <!-- User Dropdown -->
            <div class="topbar-item nav-user">
                <div class="dropdown">
                    <a class="topbar-link dropdown-toggle drop-arrow-none px-2" data-bs-toggle="dropdown"
                       data-bs-offset="0,25" type="button" aria-haspopup="false" aria-expanded="false">
                        <img src="{{asset('admin/assets/images/users/user_photo.png')}}" width="32"
                             class="rounded-circle me-lg-2 d-flex"
                             alt="user-image">
                        <span class="d-lg-flex flex-column gap-1 d-none">
                                    <h5 class="my-0">{{auth()->user()->name}}</h5>
                                </span>
                        <i class="ri-arrow-down-s-line d-none d-lg-block align-middle ms-2"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                    {{--                        <div class="dropdown-header noti-title">--}}
                    {{--                            <h6 class="text-overflow m-0">Welcome !</h6>--}}
                    {{--                        </div>--}}

                    {{--                        <!-- item-->--}}
                    {{--                        <a href="javascript:void(0);" class="dropdown-item">--}}
                    {{--                            <i class="ri-account-circle-line me-1 fs-16 align-middle"></i>--}}
                    {{--                            <span class="align-middle">My Account</span>--}}
                    {{--                        </a>--}}

                    {{--                        <!-- item-->--}}
                    {{--                        <a href="javascript:void(0);" class="dropdown-item">--}}
                    {{--                            <i class="ri-wallet-3-line me-1 fs-16 align-middle"></i>--}}
                    {{--                            <span class="align-middle">Wallet : <span class="fw-semibold">$89.25k</span></span>--}}
                    {{--                        </a>--}}

                    {{--                        <!-- item-->--}}
                    {{--                        <a href="javascript:void(0);" class="dropdown-item">--}}
                    {{--                            <i class="ri-settings-2-line me-1 fs-16 align-middle"></i>--}}
                    {{--                            <span class="align-middle">{{__('lang.Settings')}}</span>--}}
                    {{--                        </a>--}}

                    {{--                        <!-- item-->--}}
                    {{--                        <a href="javascript:void(0);" class="dropdown-item">--}}
                    {{--                            <i class="ri-question-line me-1 fs-16 align-middle"></i>--}}
                    {{--                            <span class="align-middle">Support</span>--}}
                    {{--                        </a>--}}

                    {{--                        <div class="dropdown-divider"></div>--}}

                    {{--                        <!-- item-->--}}
                    {{--                        <a href="javascript:void(0);" class="dropdown-item">--}}
                    {{--                            <i class="ri-lock-line me-1 fs-16 align-middle"></i>--}}
                    {{--                            <span class="align-middle">Lock Screen</span>--}}
                    {{--                        </a>--}}

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
