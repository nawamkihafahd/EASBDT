<header class="app-header navbar">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
      </button>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
      </button>
    <ul class="nav navbar-nav d-md-down-none">

    </ul>
    <ul class="nav navbar-nav ml-auto mr-4">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <img class="img-avatar" src="{{url('static/admin/img/avatars/9.png')}}" alt="admin@bootstrapmaster.com">
          </a>
            <div class="dropdown-menu dropdown-menu-right">
                <!--a class="dropdown-item" href="#">
                    <i class="fa fa-lock"></i>Pengaturan Akun
                </a-->
                <a class="dropdown-item" href="{{route('admin.auth.logout')}}">
                    <i class="fa fa-lock"></i>Keluar Sistem
                </a>
            </div>
        </li>
    </ul>
</header>
