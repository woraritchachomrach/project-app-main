        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <title>Dashboard ระบบขอใช้รถราชการ</title>

            <!-- CSS Libraries -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
            <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
        </head>

        <body class="hold-transition sidebar-mini layout-fixed">
            <div class="wrapper">

                <!-- Navbar -->
                <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" data-widget="pushmenu" href="dashboard" role="button"><i class="fas fa-bars"></i></a>
                        </li>
                        <li class="nav-item d-none d-sm-inline-block">
                            <a href="#" class="nav-link">ยินดีเข้าสู่ระบบขอใช้รถราชการ</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ms-auto">
                        <!-- Notifications -->
                        <li class="nav-item dropdown">
                            <a class="nav-link" data-bs-toggle="dropdown" href="#">
                                <i class="far fa-bell"></i>
                                @php $notificationCount = auth()->user()->unreadNotifications->count(); @endphp
                                @if ($notificationCount > 0)
                                    <span class="badge bg-danger navbar-badge">{{ $notificationCount }}</span>
                                @endif
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                                <span class="dropdown-header">{{ $notificationCount }} การแจ้งเตือน</span>
                                <div class="dropdown-divider"></div>
                                @forelse (auth()->user()->unreadNotifications as $notification)
                                    <a href="{{ route('notifications.read', $notification->id) }}" class="dropdown-item">
                                        <i class="fas fa-car text-primary me-2"></i>
                                        {{ $notification->data['message'] ?? 'ไม่มีข้อความ' }}
                                        <span class="float-end text-muted text-sm">{{ $notification->created_at->diffForHumans() }}</span>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                @empty
                                    <span class="dropdown-item text-muted">ไม่มีการแจ้งเตือนใหม่</span>
                                @endforelse
                                <a href="#" class="dropdown-item dropdown-footer">ดูทั้งหมด</a>
                            </div>
                        </li>

                        <!-- User Profile -->
                        <li class="nav-item dropdown">
                            <a class="nav-link" data-bs-toggle="dropdown" href="#">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D8ABC&color=fff&rounded=true"
                                    class="rounded-circle" width="30" height="30" alt="User Avatar">
                                <span class="ms-2 d-none d-md-inline">{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a href="#" class="dropdown-item">
                                        <i class="fas fa-user me-2"></i> โปรไฟล์
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button class="dropdown-item text-danger" type="submit">
                                            <i class="fas fa-sign-out-alt me-2"></i> ออกจากระบบ
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>

                <!-- Sidebar -->
                <aside class="main-sidebar sidebar-dark-primary elevation-4">
                    <!-- Brand Logo -->
                    <a href="#" class="brand-link">
                        <span class="brand-text font-weight-light">ระบบขอใช้รถราชการ</span>
                    </a>

                    <!-- Sidebar Menu -->
                    <div class="sidebar">
                        <nav class="mt-2">
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">

                                <!-- Dashboard -->
                                <li class="nav-item">
                                    <a href="{{ route('dashboard') }}" class="nav-link active">
                                        <i class="nav-icon fas fa-tachometer-alt"></i>
                                        <p>ตารางปฏิทิน</p>
                                    </a>
                                </li>

                                <!-- ขอใช้รถ -->
                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-clipboard-list"></i>
                                        <p>
                                            ขอใช้รถ
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ route('car-requests.create') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>แบบขอรถ</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('car-requests.list') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>รายการขอรถ</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <!-- เกี่ยวกับรถ -->
                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-car-side"></i>
                                        <p>
                                            เกี่ยวกับรถ
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">

                                        <!-- บันทึกการใช้รถ -->
                                        <li class="nav-item has-treeview">
                                            <a href="#" class="nav-link">
                                                <i class="fas fa-clipboard-check nav-icon"></i>
                                                <p>
                                                    บันทึกการใช้รถ
                                                    <i class="right fas fa-angle-left"></i>
                                                </p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                <li class="nav-item">
                                                    <a href="{{ route('car-usage.create') }}" class="nav-link">
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>เพิ่มบันทึก</p>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="{{ route('car-usage.index') }}" class="nav-link">
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>ดูบันทึก</p>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>                                       

                                        <!-- บันทึกการใช้น้ำมัน -->   
                                        <li class="nav-item has-treeview">
                                            <a href="#" class="nav-link">
                                                <i class="fas fa-gas-pump nav-icon"></i>
                                                <p>
                                                    บันทึกการใช้น้ำมัน
                                                    <i class="right fas fa-angle-left"></i>
                                                </p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                <li class="nav-item">
                                                    <a href="{{ route('fuel.create') }}" class="nav-link">
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>เพิ่มบันทึก</p>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="{{ route('fuel.index') }}" class="nav-link">
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>ดูบันทึก</p>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>

                                <!-- เฉพาะหัวหน้า -->
                                @if (Auth::user()->role === 'chief')
                                <li class="nav-item">
                                    <a href="{{ route('chief.dashboard') }}" class="nav-link">
                                        <i class="fas fa-check-circle nav-icon"></i>
                                        <p>อนุมัติคำร้อง</p>
                                    </a>
                                </li>
                                @endif                                                              
                                                                                                                                                                                        
                                <!-- Logout -->                                                                                             
                                <!--<li class="nav-item mt-auto">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="nav-link text-danger btn btn-link" style="text-align: left;">
                                            <i class="nav-icon fas fa-sign-out-alt"></i>
                                            <p>ออกจากระบบ</p>
                                        </button>
                                    </form>
                                </li>-->
                            </ul>
                        </nav>
                    </div>
                </aside>

                <!-- Content Wrapper -->
                <div class="content-wrapper">
                    @yield('content')
                </div>
            </div>

            <!-- JS Scripts -->
            <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

            @stack('scripts')
            @yield('scripts')
        </body>
        </html>