<div class="header">
    <!-- BEGIN Header Holder -->
    <div class="header-holder header-holder-desktop sticky-header" id="sticky-header-desktop">
        <div class="header-container container">
            <div class="header-wrap">
                <a href="{{ route('dashboard') }}"><img src="{{asset('assets/images/logo.png')}}" style="width:250px;"></a>
            </div>
            <div class="header-wrap header-wrap-block justify-content-start">
                <!-- BEGIN Nav -->
                    @if (auth()->user()->role == 'admin')
                            <a href="{{ route('perusahaan') }}" data-href="{{ route('perusahaan') }}" class="nav-link"><i class="fas fa-home"></i> <span class="ml-3">Perusahaan</span></a>
                            <div class="dropdown">
                                <a class="dropdown-toggle nav-link" role="button" data-toggle="dropdown" aria-expanded="false">
                                  <span>Kendaraan</span>
                                </a>
                                <div class="dropdown-menu">
                                  <a class="dropdown-item" href="{{ route('kendaraan') }}">Kendaraan</a>
                                  <a class="dropdown-item" href="{{ route('monitoring') }}">Monitoring Kendaraan</a>
                                </div>
                              </div>
                            <a href="{{ route('request-kendaraan') }}" data-href="{{ route('request-kendaraan') }}" class="nav-link"><i class="fas fa-envelope"></i> <span class="ml-3">Permintaan Kendaraan</span></a>
                            <a href="{{ route('log-activity') }}" data-href="{{ route('log-activity') }}" class="nav-link"><i class="fas fa-envelope"></i> <span class="ml-3">Log User</span></a>
                    @elseif (auth()->user()->role == 'pejabat')
                        <a href="{{ route('request-kendaraan') }}" data-href="{{ route('request-kendaraan') }}" class="nav-link"><i class="fas fa-envelope"></i> <span class="ml-3">Permintaan Kendaraan</span></a>
                        <a href="{{ route('log-activity') }}" data-href="{{ route('log-activity') }}" class="nav-link"><i class="fas fa-envelope"></i> <span class="ml-3">Log User</span></a>
                    @endif                 
                </ul>

                <!-- END Nav -->
            </div>
            <div class="header-wrap">
                <!-- BEGIN Dropdown -->
                <div class="dropdown ml-2" style="font-weight:550;">  
                    <button class="btn widget13" data-toggle="dropdown">
                        <div class="widget13-text"><strong>Selamat Datang {{ auth()->user()->username }}</strong>
                        </div>
                        <!-- BEGIN Avatar -->
                        <div class="avatar avatar-info widget13-avatar">
                            <div class="avatar-display">
                                <i class="fa fa-user-alt"></i>
                            </div>
                        </div>
                        <!-- END Avatar -->
                    </button>
                    <div class="dropdown-menu dropdown-menu-wide dropdown-menu-right dropdown-menu-animated overflow-hidden py-0">
                        <!-- BEGIN Portlet -->
                        <div class="portlet border-0">
                            <div class="portlet-header bg-primary rounded-0">
                                <!-- BEGIN Rich List Item -->
                                <div class="rich-list-item w-100 p-0">                                   
                                    <div class="rich-list-content">
                                        <h3 class="rich-list-title text-white"> </h3>
                                        <span class="rich-list-subtitle text-white"></span>
                                    </div>                                    
                                </div>
                                <!-- END Rich List Item -->
                            </div>
                            <div class="portlet-body p-0">
                                <!-- BEGIN Grid Nav -->
                                <div class="grid-nav grid-nav-flush grid-nav-action grid-nav-no-rounded">
                                    <div class="grid-nav-row">
                                        <a href=" {{route('profile') }}" class="grid-nav-item">
                                            <div class="grid-nav-icon">
                                                <i class="far fa-address-card"></i>
                                            </div>
                                            <span class="grid-nav-content">Profile</span>
                                        </a>                                   
                                    </div>                                
                                </div>
                                <!-- END Grid Nav -->
                            </div>
                            <div class="portlet-footer portlet-footer-bordered rounded-0">
                                <button type="button" class="btn btn-label-danger" onclick="document.location.href='{{ route('logout') }}'">Log out</button>
                            </div>
                        </div>
                        <!-- END Portlet -->
                    </div>
                </div>
                <!-- END Dropdown -->               
            </div>
        </div>
    </div>
    <!-- END Header Holder -->
    <!-- BEGIN Header Holder -->
    <div class="header-holder header-holder-mobile sticky-header" id="sticky-header-mobile">
        <div class="header-container container">
            <div class="header-wrap">
                <button class="btn btn-label-info btn-icon" data-toggle="sidemenu" data-target="#sidemenu-navigation">
                    <i class="fa fa-bars"></i>
                </button>
            </div>
            <div class="header-wrap header-wrap-block">
                <h4 class="header-brand">Monitoring</h4>
            </div>
            <div class="header-wrap">
                <!-- BEGIN Dropdown -->
                <div class="dropdown ml-2">
                    <button class="btn btn-flat-primary widget13" data-toggle="dropdown">
                        <div class="widget13-text"> Halooo <strong>{{ auth()->user()->username }}</strong>
                        </div>
                        <!-- BEGIN Avatar -->
                        <div class="avatar avatar-info widget13-avatar">
                            <div class="avatar-display">
                                <i class="fa fa-user-alt"></i>
                            </div>
                        </div>
                        <!-- END Avatar -->
                    </button>
                    <div class="dropdown-menu dropdown-menu-wide dropdown-menu-right dropdown-menu-animated overflow-hidden py-0">
                        <!-- BEGIN Portlet -->
                        <div class="portlet border-0">
                            <div class="portlet-header bg-primary rounded-0">
                                <!-- BEGIN Rich List Item -->
                                <div class="rich-list-item w-100 p-0">                                   
                                    <div class="rich-list-content">
                                        <h3 class="rich-list-title text-white"> </h3>
                                        <span class="rich-list-subtitle text-white"></span>
                                    </div>                                    
                                </div>
                                <!-- END Rich List Item -->
                            </div>
                            <div class="portlet-body p-0">
                                <!-- BEGIN Grid Nav -->
                                <div class="grid-nav grid-nav-flush grid-nav-action grid-nav-no-rounded">
                                    <div class="grid-nav-row">
                                        <a href="{{ route('profile') }}" class="grid-nav-item">
                                            <div class="grid-nav-icon">
                                                <i class="far fa-address-card"></i>
                                            </div>
                                            <span class="grid-nav-content">Profile</span>
                                        </a>                                  
                                    </div>                                
                                </div>
                                <!-- END Grid Nav -->
                            </div>
                            <div class="portlet-footer portlet-footer-bordered rounded-0">
                                <button type="button" class="btn btn-label-danger" onclick="document.location.href='{{ route('logout') }}'">Log out</button>
                            </div>
                        </div>
                        <!-- END Portlet -->
                    </div>
                </div>
                <!-- END Dropdown -->
            </div>
        </div>
    </div>
    <!-- END Header Holder -->
</div>
