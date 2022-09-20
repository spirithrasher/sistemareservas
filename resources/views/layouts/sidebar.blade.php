    <div class="left-sidenav">
        <!-- LOGO -->
        <div class="brand">
            <a href="index" class="logo">
                <span>
                    <h2>SR</h2>
                    <!-- <img src="{{ URL::asset('assets/images/logo-sm.png') }}" alt="logo-small" class="logo-sm"> -->
                </span>
                <span>
                    <!-- <img src="{{ URL::asset('assets/images/logo.png') }}" alt="logo-large" class="logo-lg logo-light"> -->
                    <!-- <img src="{{ URL::asset('assets/images/logo-dark.png') }}" alt="logo-large" class="logo-lg logo-dark"> -->
                </span>
            </a>
        </div>
        <!--end logo-->
        <div class="menu-content h-100" data-simplebar>
            <ul class="metismenu left-sidenav-menu">
                <li class="menu-label mt-0">Menu</li>
                <li>
                    <a href="{{ url('index') }}"> <i data-feather="home"
                            class="align-self-center menu-icon"></i><span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);"><i data-feather="list"
                            class="align-self-center menu-icon"></i><span>Reservas</span><span class="menu-arrow"><i
                                class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li class="nav-item"><a class="nav-link" href="{{ route('reservas.listado') }}"><i
                                    class="ti-control-record"></i>Lstado</a></li>
                        <li class="nav-item"><a class="nav-link" href="apps-chat"><i
                                    class="ti-control-record"></i>Nueva</a></li>
                        
                        <li class="nav-item"><a class="nav-link" href="apps-calendar"><i
                                    class="ti-control-record"></i>Calendario</a></li>
                    </ul>
                </li>
                <hr class="hr-dashed hr-menu">
            </ul>
        </div>
    </div>
