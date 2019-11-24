<header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>T</b>P</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Tâm Phát</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->


        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{asset('img/avatar5.png')}}" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{ \Illuminate\Support\Facades\Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{asset('img/avatar5.png')}}" class="img-circle" alt="User Image">

                            <p>
                               {{ \Illuminate\Support\Facades\Auth::user()->name }}
                                <small>Ngày tạo tài khoản : {{ \Illuminate\Support\Facades\Auth::user()->created_at }}</small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        {{--<li class="user-body">
                            <div class="row">
                                <div class="col-xs-4 text-center">
                                    <a href="#">Followers</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">Sales</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">Friends</a>
                                </div>
                            </div>
                            <!-- /.row -->
                        </li>--}}
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            {{--<div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>--}}
                            <div class="pull-right">
                                <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset('img/avatar5.png')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ \Illuminate\Support\Facades\Auth::user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
    {{-- <form action="#" method="get" class="sidebar-form">
         <div class="input-group">
             <input type="text" name="q" class="form-control" placeholder="Search...">
             <span class="input-group-btn">
             <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
             </button>
           </span>
         </div>
     </form>--}}
    <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        @if(\Illuminate\Support\Facades\Auth::user()->level > 0)
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Menu</li>

            <li class="active">
                <a href="{{ route('dashboard.index') }}">
                    <i class="fa fa-th"></i> <span>Dashboard</span>
                    <span class="pull-right-container">
              <small class="label pull-right bg-red">2019</small>
            </span>
                </a>
            </li>

            <li class="active treeview">
                <a href="#">
                    <i class="fa fa-database"></i> <span>Data Tâm Phát</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>

                <ul class="treeview-menu">

                    <li class="active">
                        <a href="{{route('suppliers.index')}}">
                            <i class="fa fa-circle-o"></i>
                            Danh Sách Nhà Cung Cấp
                        </a></li>

                    <li class="active">
                        <a href="{{route('commodities.index')}}">
                            <i class="fa fa-circle-o"></i>
                            Danh sách hàng hóa
                        </a></li>

                    <li class="active">
                        <a href="{{route('customers.index')}}">
                            <i class="fa fa-circle-o"></i>
                            Danh sách khách hàng
                        </a></li>
                </ul>

            </li>

            <li class="active">
                <a href="{{ route('export.create') }}">
                    <i class="fa fa-th"></i> <span>Bán hàng</span>
                    <span class="pull-right-container">
              <small class="label pull-right bg-red">2019</small>
            </span>
                </a>
            </li>

            <li class="active">
                <a href="{{ route('expense.create') }}">
                    <i class="fa fa-th"></i> <span>Chi Tiêu</span>
                    <span class="pull-right-container">
              <small class="label pull-right bg-red">2019</small>
            </span>
                </a>
            </li>

            <li class="active treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i>
                    <span>Kho</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active">
                        <a href="{{route('import.create')}}">
                            <i class="fa fa-circle-o"></i>
                            Nhập hàng
                        </a>
                    </li>

                    <li class="active">
                        <a href="{{route('warehouse.index')}}">
                            <i class="fa fa-circle-o"></i>
                            Tồn kho
                        </a>
                    </li>
                </ul>


            </li>

            <li class="active treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i>
                    <span>Báo cáo</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active">
                        <a href="{{route('salesreport.index')}}">
                            <i class="fa fa-circle-o"></i>
                            Doanh thu
                        </a>
                    </li>
                </ul>
            </li>


        </ul>
        @endif
    </section>
    <!-- /.sidebar -->
</aside>