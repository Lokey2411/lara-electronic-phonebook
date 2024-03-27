<nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-between">
    <div class="container-fluid">
        <a class="navbar-brand" style="width:25%" href="{{ route('home') }}"><img class="w-100 h-50"
                src="https://www.tlu.edu.vn/Portals/_default/skins/tluvie/images/logo.png" alt=""></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 fs-6 ">
                <li class="nav-item">
                    <a class="nav-link" href="#">Liên hệ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Tin tức &amp; sự kiện</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Danh sách danh bạ
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('department.index') }}">Danh
                                bạ đơn vị</a></li>
                        <li><a class="dropdown-item" href="{{ route('employee.index') }}">Danh
                                bạ giảng viên</a></li>
                    </ul>
                </li>
                {{-- not log in --}}
                @if (session('user'))
                    @if (session('role') == 'Admin')
                        <li class="nav-item"><a class="nav-link" href={{ route('admin') }}>Admin</a></li>
                    @endif
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false"> Xin chào, <b>
                                {{ Str::substr(session('user')['FullName'], 0, 10) }}
                            </b>
                            <img src="{{ file_exists(public_path('uploads/' . session('user')['Avatar'])) ? asset('uploads/' . session('user')['Avatar']) : 'https://w7.pngwing.com/pngs/178/595/png-transparent-user-profile-computer-icons-login-user-avatars-thumbnail.png' }}"
                                width="30" height="30" class="rounded-circle" id="js-avatar">
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="{{ route('user.profile') }}">Thông tin</a></li>
                            <li>
                                <a href="{{ route('logout') }}" class="dropdown-item">Đăng xuất</a>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Đăng
                            Nhập</a>
                    </li>
                @endif
            </ul>
        </div>
        <form class="d-flex" action="{{ route('search') }}" method="get">
            <input type="hidden" name="controller" value="Pages">
            <input type="hidden" name="action" value="Search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="js-search"
                name="item">
            <button class="btn btn-outline-success" type="submit">
                Search
            </button>
        </form>
    </div>
</nav>
