<header id="header">
    <nav class="main-nav">
        <div class="container-fluid">
            <div class="row align-items-center">
                <!-- Brand -->
                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        Banking Application
                    </a>
                </div>

                <!-- Navigation -->
                <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8">
                    <div class="right-nav" id="nav-icons">
                        <ul class="navbar-icons ms-auto">
                            @guest
                            @else
                            <li>
                                <a href="{{ route('home') }}"><i class="fi fi-rr-home"></i> Home</a>
                            </li>
                            <li>
                                <a href="{{ route('deposit.form') }}"><i class="fi fi-rr-cloud-upload-alt"></i> Deposit</a>
                            </li>
                            <li>
                                <a href="{{ route('withdraw.form') }}"><i class="fi fi-rr-cloud-download-alt"></i> Witdraw</a>
                            </li>
                            <li>
                                <a href="{{ route('transfer.form') }}"><i class="fi fi-rr-priority-arrows"></i> Transfer</a>
                            </li>
                            <li>
                                <a href="{{ route('statement.index') }}"><i class="fi fi-rr-file-invoice-dollar"></i> Statement</a>
                            </li>
                            @can('Admin Settings')
                            <!-- Custom Dropdown Menu -->
                            <li class="custom-dropdown">
                                <a href="javascript:void(0);"><i class="fi fi-rr-settings"></i> Management</a>
                                <div class="custom-dropdown-menu">
                                    <a href="{{ url('/users') }}">Users</a>
                                    <a href="{{ url('/roles') }}">Roles</a>
                                </div>
                            </li>
                            @endcan
                            <li>
                                <a class="logout-link" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    <i class="fi fi-rr-exit"></i> Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>