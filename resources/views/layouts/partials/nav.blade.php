<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('pages.home') }}">
                Sirce.info
            </a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <p class="navbar-text">Find sketches by:</p>

            <ul class="nav navbar-nav">
                <li class="{{ Route::is('boards.*') ? 'active' : '' }}"><a href="{{ route('boards.index') }}">MCU Boards</a></li>
                <li class="{{ Route::is('components.*') ? 'active' : '' }}"><a href="{{ route('components.index') }}">Components</a></li>
                <li class="{{ Route::is('sketches.*') ? 'active' : '' }}"><a href="{{ route('sketches.index') }}">All Sketches</a></li>
            </ul>


            @if (Auth::user())
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('sketches.create') }}">New Sketch</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ route('profiles.index') }}">My Profile</a></li>
                            <li><a href="{{ route('profiles.sketches') }}">My Sketches</a></li>
                            <li><a href="{{ route('profiles.starred') }}">Starred Sketches</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ route('auth.logout') }}">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            @else
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ route('auth.index') }}">Login / Register</a></li>
                </ul>
            @endif

        </div>
    </div>
</nav>