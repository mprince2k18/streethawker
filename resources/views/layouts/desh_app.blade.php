    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8" />
            <title>Dashboard</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
            <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
            <meta content="Coderthemes" name="author" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <meta name="csrf-token" content="{{ csrf_token() }}">



            <!-- App favicon -->
            <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

            <!-- C3 charts css -->
            {{-- <link rel="stylesheet" href=" {{asset('assets/css/imagePreview.css')}} "> --}}
                    <link href="{{asset('assets/plugins/c3/c3.min.css" rel="stylesheet')}}" type="text/css"  />
                    <!-- Sweet Alert -->
                    <link href="{{asset('assets/plugins/sweet-alert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css">

                    <!-- App css -->
                    {{-- <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" /> --}}
                    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}
                    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
                    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
                    <link href="{{ asset('assets/css/metismenu.min.css') }}" rel="stylesheet" type="text/css" />
                    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />
                    {{-- <link href="{{ asset('assets/css/dataTables.css') }}" rel="stylesheet" type="text/css" /> --}}
                    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
                    <link href="{{ asset('assets/tost/toastr.min.css') }}" rel="stylesheet" type="text/css" />
                    {{-- <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet"> --}}
                    @yield('addNewCss')


                    <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>

        </head>


        <body>

            <!-- Begin page -->

            <div id="wrapper">

                <!-- Top Bar Start -->
                <div class="topbar">

                    <!-- LOGO -->
                    <div class="topbar-left">
                        <a href="{{url('/')}}" class="logo">
                                    <span>
                                        <img src=" {{asset('assets/images/logo.png')}} " alt="" height="25">
                                    </span>
                            <i>
                                <img src="{{asset('assets/images/logo_sm.png')}}" alt="" height="28">
                            </i>
                        </a>
                    </div>

                    @php
                        if (Auth::user()->role == 3) {

                            $notificationCount = 0;

                            $brandNotification = App\Brand::where('request',0)->count();
                            $brandNotifyItem = App\Brand::where('request',0)->get();

                            $brandRegisterNotification = App\SalerRegisterBrand::where('approval_status',0)->count();
                            $brandRegisterNotifyItem = App\SalerRegisterBrand::where('approval_status',0)->get();

                            $productNotification = App\product::where('approval',0)->count();
                            $productNotifyItem = App\product::where('approval',0)->get();

                            $notificationCount += $brandNotification;
                            $notificationCount += $brandRegisterNotification;
                            $notificationCount += $productNotification;
                        } else {
                            # code...
                        }
                        // echo $brandNotification;
                    @endphp
                    <nav class="navbar-custom">

                        <ul class="list-inline float-right mb-0">
                            {{-- start notification --}}
                            @if (Auth::user()->role == 3)
                                <li class="list-inline-item dropdown notification-list">
                                    <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button"
                                    aria-haspopup="false" aria-expanded="false">
                                        <i class="dripicons-bell noti-icon"></i>
                                    <span class="badge badge-pink noti-icon-badge">{{$notificationCount}}</span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-lg" aria-labelledby="Preview">
                                        <!-- item-->
                                        <div class="dropdown-item noti-title">
                                        <h5><span class="badge badge-danger float-right">{{$notificationCount}}</span>Notification</h5>
                                        </div>

                                        <!-- item-->
                                        @if ($notificationCount > 0)

                                        @if ($brandNotification > 0)
                                        @foreach ($brandNotifyItem as $item)

                                    <a href="{{_('brandRequest')}}" class="dropdown-item notify-item">
                                            <div class="notify-icon bg-success"><i class="icon-bubble"></i></div>
                                        <p class="notify-details">New Brand Request Has Came.<small class="text-muted">{{$item->updated_at->diffForHumans()}}</small></p>
                                        </a>
                                        @endforeach
                                        @endif

                                        @if ($brandRegisterNotification > 0)
                                        @foreach ($brandRegisterNotifyItem as $item)

                                    <a href="{{_('salerRegisterBrands')}}" class="dropdown-item notify-item">
                                            <div class="notify-icon bg-info"><i class="icon-bubble"></i></div>
                                    <p class="notify-details">{{App\user::findOrFail($item->saler_id)->name}} wants to register a brand<small class="text-muted">{{$item->updated_at->diffForHumans()}}</small></p>
                                        </a>
                                        @endforeach
                                        @endif

                                        @if ($productNotification > 0)
                                        @foreach ($productNotifyItem as $item)
                                        <a href="{{_('allSalerProduct')}}" class="dropdown-item notify-item">
                                                <div class="notify-icon bg-danger"><i class="icon-bubble"></i></div>
                                        <p class="notify-details">{{App\user::findOrFail($item->user_id)->name}} added Product<small class="text-muted">{{($item->updated_at)->diffForHumans()}}</small></p>
                                            </a>
                                        @endforeach
                                        @endif

                                        @endif

                                    </div>
                                </li>
                            @else

                            @endif
                            {{-- end notificatoin --}}

                            <li class="list-inline-item dropdown notification-list">
                                <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                                aria-haspopup="false" aria-expanded="false">
                                @auth
                                    {{Auth::user()->name}}
                                @endauth
                                    <img src=" {{asset('assets/images/users/avatar-1.jpg')}} " alt="user" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview">
                                    <!-- item-->
                                    <div class="dropdown-item noti-title">
                                        <h5 class="text-overflow"><small>Welcome ! @auth{{Auth::user()->name}}@endauth</small> </h5>
                                    </div>

                                    <!-- item-->
                                    <a href="{{route('costomer_profile')}}" class="dropdown-item notify-item">
                                        <i class="zmdi zmdi-account-circle"></i> <span>Profile</span>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="zmdi zmdi-settings"></i> <span>Settings</span>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="zmdi zmdi-lock-open"></i> <span>Lock Screen</span>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        {{-- <i class="zmdi zmdi-power"></i> <span>Logout</span> --}}
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    </a>

                                </div>
                            </li>

                        </ul>

                        <ul class="list-inline menu-left mb-0">
                            <li class="float-left">
                                <button class="button-menu-mobile open-left waves-light waves-effect">
                                    <i class="dripicons-menu"></i>
                                </button>
                            </li>
                            @yield('searchpanel')

                        </ul>

                    </nav>

                </div>
                <!-- Top Bar End -->


                <!-- ========== Left Sidebar Start ========== -->
                <div class="left side-menu">
                    <div class="slimscroll-menu" id="remove-scroll">

                        <!--- Sidemenu -->
                        <div id="sidebar-menu">
                            <!-- Left Menu Start -->
                            <ul class="metismenu" id="side-menu">
                                <li class="menu-title">Navigation</li>
                                <li>
                                    <a href=" {{Route('home')}} ">
                                        <i class="fi-air-play"></i><span class="badge badge-success pull-right">2</span> <span> Dashboard </span>
                                    </a>
                                    {{-- <ul class="nav-second-level" aria-expanded=false>
                                        <li><a href="index.html">Dashboard 1</a></li>
                                        <li><a href="dashboard-2.html">Dashboard 2</a></li>
                                    </ul> --}}
                                </li>
                                <li>
                                    <a href="{{route('myOrders')}}"><i class="fi-paper-stack"></i><span> My Orders </span></a>
                                </li>
                                @if (Auth::user()->role == 3)
                                <li>
                                    <a href="javascript: void(0); "><i class="fi-marquee-plus"></i> <span> Coupon manager </span> <span class="menu-arrow"></span></a>
                                    <ul class="nav-second-level" aria-expanded="false">
                                        <li><a href=" {{Route('allCoupon')}} ">Coupons</a></li>
                                    </ul>
                                </li>
                                @endif
                                @if (Auth::user()->role == 3 || Auth::user()->role == 2)

                                <li>
                                    <a href="javascript: void(0);"><i class="fa fa-cogs"></i> <span> Theme Settings</span> <span class="menu-arrow"></span></a>
                                    <ul class="nav-second-level" aria-expanded="false">
                                        <li><a href=" {{Route('logo')}} ">Logo</a></li>
                                        <li><a href=" {{Route('banner_popup')}} ">Banner Popup</a></li>
                                        <li><a href=" {{Route('slider_background')}} ">Slider Background</a></li>
                                        <li><a href=" {{Route('brand_banner')}} ">Brand Banner</a></li>
                                        <li><a href=" {{Route('big_banner')}} ">Big Banner</a></li>
                                        <li><a href=" {{Route('big_banner_two')}} ">2nd Big Banner</a></li>
                                    </ul>
                                </li>
                                @endif
                                @if (Auth::user()->role == 3 || Auth::user()->role == 2)

                                <li>
                                    <a href="javascript: void(0);"><i class="fi-target"></i> <span> Category </span> <span class="menu-arrow"></span></a>
                                    <ul class="nav-second-level" aria-expanded="false">
                                        <li><a href=" {{Route('manage_categories')}} ">Manage Categories</a></li>
                                        <li><a href=" {{Route('manage_sub_categories')}} ">Manage Sub Categories</a></li>
                                        <li><a href=" {{Route('Manage_promotional_cateogry')}} ">Manage Promotional Cateogry</a></li>
                                    </ul>
                                </li>
                                @endif

                                @if (Auth::user()->role == 3)
                                <li>
                                    <a href=" {{Route('allAdmins')}} "><i class="fi-marquee-plus"></i> <span> All Admins </span> <span class="menu-arrow"></span></a>
                                    {{-- <ul class="nav-second-level" aria-expanded="false">
                                        <li><a href=" {{Route('manage_product')}} ">Manage My Product</a></li>
                                    </ul> --}}
                                </li>
                                @endif
                                @if (Auth::user()->role == 3)
                                <li>
                                    <a href="javascript: void(0); "><i class="fi-marquee-plus"></i> <span> Brand management </span> <span class="menu-arrow"></span></a>
                                    <ul class="nav-second-level" aria-expanded="false">
                                        <li><a href=" {{Route('allBrand')}} ">All Brands</a></li>
                                        <li><a href=" {{Route('brandRequest')}} ">brand Request</a></li>
                                        <li><a href=" {{Route('salerRegisterBrands')}} ">Saler Register Brands</a></li>
                                    </ul>
                                </li>
                                @endif

                                @if (Auth::user()->role == 2 || Auth::user()->role == 3)
                                <li>
                                    <a href=" {{Route('salerbrand')}} "><i class="fi-marquee-plus"></i> <span> My Brands </span> <span class="menu-arrow"></span></a>
                                    {{-- <ul class="nav-second-level" aria-expanded="false">
                                        <li><a href=" {{Route('manage_product')}} ">Manage My Product</a></li>
                                    </ul> --}}
                                </li>
                                @endif
                                @if (Auth::user()->role == 3 || Auth::user()->role == 2)
                                <li>
                                    <a href="javascript: void(0);"><i class="fi-briefcase"></i> <span> My Product </span> <span class="menu-arrow"></span></a>
                                    <ul class="nav-second-level" aria-expanded="false">
                                        <li><a href=" {{Route('manage_product')}} ">Manage My Product</a></li>
                                    </ul>
                                </li>
                                @endif
                                @if (Auth::user()->role == 3)
                                <li>
                                    <a href="javascript: void(0); "><i class="fi-marquee-plus"></i> <span> Manage Hot Deal </span> <span class="menu-arrow"></span></a>
                                    <ul class="nav-second-level" aria-expanded="false">
                                        <li><a href=" {{Route('manageHotDeal')}} ">Hot Deal</a></li>
                                    </ul>
                                </li>
                                @endif
                                @if (Auth::user()->role == 3)
                                <li>
                                    <a href="javascript: void(0);"><i class="fi-help"></i> <span> Saler </span><span class="menu-arrow"></span></a>
                                    <ul class="nav-second-level" aria-expanded="false">
                                        <li><a href=" {{Route('mysaler')}} ">All Salers</a></li>
                                    </ul>
                                </li>
                                @endif

                                @if (Auth::user()->role == 3)
                                <li>
                                    <a href="javascript: void(0);"><i class="fi-box"></i><span> All Saler Product </span> <span class="menu-arrow"></span></a>
                                    <ul class="nav-second-level" aria-expanded="false">
                                        <li><a href=" {{Route('allSalerProduct')}} "> View Saler Product</a></li>
                                    </ul>
                                </li>
                                @endif

                                @if (Auth::user()->role == 3)
                                <li>
                                    <a href="javascript: void(0);"><i class="fa fa-key"></i><span> Secutiry Pin </span> <span class="menu-arrow"></span></a>
                                    <ul class="nav-second-level" aria-expanded="false">
                                        <li><a href="{{Route('unusedPin')}}">Unused Pin</a></li>
                                        <li><a href="{{Route('userRegisteredPin')}}">User Registered Pin</a></li>
                                        <li><a href="{{Route('createSecurityPin')}}">Create Pins</a></li>
                                    </ul>
                                </li>
                                @endif
                                @if (Auth::user()->role == 3)
                                <li>
                                    <a href="javascript: void(0);"><i class="fa fa-users"></i><span>Registered Users</span> <span class="menu-arrow"></span></a>
                                    <ul class="nav-second-level" aria-expanded="false">
                                        <li><a href="{{Route('UserInformation')}}">User Information</a></li>
                                    </ul>
                                </li>
                                @endif



                            </ul>

                        </div>
                        <!-- Sidebar -->
                        <div class="clearfix"></div>

                    </div>
                    <!-- Sidebar -left -->

                </div>
                <!-- Left Sidebar End -->



                <!-- ============================================================== -->
                <!-- Start right Content here -->
                <!-- ============================================================== -->
                <div class="content-page">
                    <!-- Start content -->
                    <div class="content">
                        <div class="container-fluid">

                            <div class="row">
                                <div class="col-12">
                                    <div class="page-title-box">
                                        <h4 class="page-title float-left">@yield('pageHeading')</h4>

                                        <ol class="breadcrumb float-right">
                                            <li class="breadcrumb-item"><a href="#">Adminox</a></li>
                                            <li class="breadcrumb-item"><a href="#">@yield('pageHeading')</a></li>
                                            {{-- <li class="breadcrumb-item active">Dashboard 1</li> --}}
                                        </ol>

                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->


                            @yield('desh_content')



                        </div> <!-- container -->

                    </div> <!-- content -->

                    <footer class="footer text-right">
                        {{ date('Y') }} © Street Hawker
                    </footer>

                </div>


                <!-- ============================================================== -->
                <!-- End Right content here -->
                <!-- ============================================================== -->


            </div>
            <!-- END wrapper -->



            <!-- jQuery  -->

            <script src=" {{asset('assets/js/imagePreview.js')}} "></script>
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
            <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
            <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
            <script src="{{ asset('assets/js/tether.min.js') }}"></script><!-- Tether for Bootstrap -->
            {{-- <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script> --}}
            <script src="{{ asset('assets/js/metisMenu.min.js') }}"></script>
            <script src="{{ asset('assets/js/waves.js') }}"></script>
            <script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>

            <!-- Counter js  -->
            <script src="{{ asset('assets/plugins/waypoints/jquery.waypoints.min.js') }}"></script>
            <script src="{{ asset('assets/plugins/counterup/jquery.counterup.min.js') }}"></script>

            <!--C3 Chart-->
            <script type="text/javascript" src="{{ asset('assets/plugins/d3/d3.min.js') }}"></script>
            <script type="text/javascript" src="{{ asset('assets/plugins/c3/c3.min.js') }}"></script>

            <!--Echart Chart-->
            <script src="{{ asset('assets/plugins/echart/echarts-all.js') }}"></script>

            <!-- Dashboard init -->
            <script src="{{ asset('assets/pages/jquery.dashboard.js') }}"></script>

            <!-- App js -->
            <script src="{{ asset('assets/js/jquery.core.js') }}"></script>
            <script src="{{ asset('assets/js/jquery.app.js') }}"></script>
            {{-- <script src="{{ asset('assets/js/dataTables.js') }}"></script> --}}

            <!-- Sweet-Alert  -->
            <script src="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
            <script src="{{ asset('assets/pages/jquery.sweet-alert.init.js') }}"></script>
            <script src="{{ asset('assets/tost/jquery3.4.1.min.js') }}"></script>
            <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
            <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

            <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
                <script>
                    @if(Session::has('greenStatus'))
                                toastr.success("{{ Session::get('greenStatus') }}");
                    @endif
                </script>
                <script>
                    @if(Session::has('redStatus'))
                    toastr.error("{{ Session::get('redStatus') }}");
                    @endif
                    </script>
                <script>
                    @if(Session::has('yellowStatus'))
                                toastr.warning("{{ Session::get('yellowStatus') }}");
                                @endif
                                </script>
                <script>
                    @if($errors->all())
                            toastr.error("Error Occared ! Please Check The Form Requirements 😢");
                            @foreach ($errors->all() as $item)
                            toastr.warning("{{ $item }}");
                            @endforeach
                            @endif
                            </script>
            @yield('addNewScript');

        </body>
    </html>
