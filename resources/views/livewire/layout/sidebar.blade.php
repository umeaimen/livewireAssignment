<div class="nk-sidebar nk-sidebar-fixed is-light " data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-sidebar-brand">
            <a href="html/index.html" class="logo-link nk-sidebar-logo">
                <img class="logo-light logo-img" src="{{ url('/assets/images/logo.png')}}" srcset="{{ url('/assets/images/logo2x.png 2x')}}" alt="logo">
                <img class="logo-dark logo-img" src="{{ url('/assets/images/logo-dark.png')}}" srcset="{{ url('/assets/images/logo-dark2x.png 2x')}}" alt="logo-dark">
                <img class="logo-small logo-img logo-img-small" src="{{ url('/assets/images/logo-small.png')}}" srcset="{{ url('/assets/images/logo-small2x.png 2x')}}" alt="logo-small">
            </a>
        </div>
        <div class="nk-menu-trigger me-n2">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
            <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
        </div>
    </div>
    <!-- .nk-sidebar-element -->
    <div class="nk-sidebar-element">
        <div class="nk-sidebar-content">
            <div class="nk-sidebar-menu" data-simplebar>
                <ul class="nk-menu">
                    <li class="nk-menu-item">
                        <a href="{{route('users')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-users"></em></span>
                            <span class="nk-menu-text">Users</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item">
                        <a href="{{route('companies')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-company"></em></span>
                            <span class="nk-menu-text">Company</span>
                        </a>
                    </li><!-- .nk-menu-item -->
              
                </ul><!-- .nk-menu -->
            </div><!-- .nk-sidebar-menu -->
        </div><!-- .nk-sidebar-content -->
    </div>
    <!-- .nk-sidebar-element -->
</div>