    <![endif]-->
<nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle hamburger hamburger-close navbar-toggle-left hided" data-toggle="menubar"> <span class="sr-only">Toggle navigation</span> <span class="hamburger-bar"></span> </button>
        <button type="button" class="navbar-toggle collapsed" data-target="#site-navbar-collapse" data-toggle="collapse"> <i class="icon wb-more-horizontal" aria-hidden="true"></i> </button>
        <div class="navbar-brand navbar-brand-center site-gridmenu-toggle  logo-full" data-toggle="gridmenu">
            <img class="navbar-brand-logo" src="/logo.svg" title="Chicopee">
        </div>
         <div class="navbar-brand navbar-brand-center site-gridmenu-toggle logo-small" data-toggle="gridmenu">
            <img class="navbar-brand-logo " src="/logo-small.svg" title="Chicopee">
        </div>
        <button type="button" class="navbar-toggle collapsed" data-target="#site-navbar-search" data-toggle="collapse"> <span class="sr-only">Toggle Search</span> <i class="icon wb-search" aria-hidden="true"></i> </button>
    </div>
    <div class="navbar-container container-fluid">
        <!-- Navbar Collapse -->
        <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
            <!-- Navbar Toolbar Right -->
            <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
                <li class="dropdown">
                    <a class="navbar-avatar dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false" data-animation="scale-up" role="button">
                        <span class="avatar"><img src="/profile.png" alt="..."></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li role="presentation"> <a href="{{ url('/settings') }}" role="menuitem"><i class="icon wb-user" aria-hidden="true"></i> Edit Account</a> </li>
                        <li class="divider" role="presentation"></li>
                        <li role="presentation"> <a href="{{ url('/logout') }}" role="menuitem"><i class="icon wb-power" aria-hidden="true"></i> Logout</a> </li>
                    </ul>
                </li>
            </ul>
            <!-- End Navbar Toolbar Right -->
        </div>
        <!-- End Navbar Collapse -->
        <!-- Site Navbar Seach -->
        <div class="collapse navbar-search-overlap" id="site-navbar-search">
            <form role="search">
                <div class="form-group">
                    <div class="input-search"> <i class="input-search-icon wb-search" aria-hidden="true"></i>
                        <input type="text" class="form-control" name="site-search" placeholder="Search...">
                        <button type="button" class="input-search-close icon wb-close" data-target="#site-navbar-search" data-toggle="collapse" aria-label="Close"></button>
                    </div>
                </div>
            </form>
        </div>
        <!-- End Site Navbar Seach -->
    </div>
</nav>
<div class="site-menubar">
    <div class="site-menubar-body">
        <div>
            <div>
                <ul class="site-menu">
                    <li class="site-menu-category">Assets</li>
                    <li class="site-menu-item">
                        <a href="{{ url('/assets') }}"> <i class="site-menu-icon wb-file" aria-hidden="true"></i> <span class="site-menu-title">View All</span> </a>
                    </li>
                    <li class="site-menu-item has-sub">
                        <a href="javascript:void(0)"> <i class="site-menu-icon wb-tag" aria-hidden="true"></i> <span class="site-menu-title"> View By Type</span> <span class="site-menu-arrow"></span> </a>
                        <ul class="site-menu-sub">
                            {!! recursive_list(App\Category::with('children')->whereNull('parent_id')->orderBy('id')->get(), false) !!}
                        </ul>
                    </li>
                    <li class="site-menu-category">My Account</li>
                    <li class="site-menu-item">
                        <a href="{{ url('/settings') }}"> <i class="site-menu-icon wb-user" aria-hidden="true"></i> <span class="site-menu-title">Edit Account</span> </a>
                    </li>
                    <li class="site-menu-item">
                        <a href=" {{ url('/logout') }}"> <i class="site-menu-icon wb-power" aria-hidden="true"></i> <span class="site-menu-title">Logout</span> </a>
                    </li>
                </ul>
            </div>
        </div>
        <select class="" name="">
            {!! cat_select_options(App\Category::with('children')->whereNull('parent_id')->orderBy('id')->get()) !!}
        </select>
    </div>
    <div class="site-menubar-footer">
        <a href="{{ url('/settings') }}" class="fold-show" data-placement="top" data-toggle="tooltip" data-original-title="Settings"> <span class="icon wb-settings" aria-hidden="true"></span> </a>
       <a class="icon icon-fullscreen" data-toggle="fullscreen" href="#" role="button">
              <span class="sr-only">Toggle fullscreen</span>
            </a>
        <a href="{{ url('/logout') }}" data-placement="top" data-toggle="tooltip" data-original-title="Logout"> <span class="icon wb-power" aria-hidden="true"></span> </a>
    </div>
</div>
