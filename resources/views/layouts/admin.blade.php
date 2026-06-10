<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - MeeTopia Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4F46E5;
            --primary-dark: #3730A3;
            --primary-light: #818CF8;
            --secondary: #06B6D4;
            --accent: #F59E0B;
            --success: #10B981;
            --danger: #EF4444;
            --dark: #1E293B;
            --sidebar-width: 260px;
            --gray-50: #F8FAFC;
            --gray-100: #F1F5F9;
            --gray-200: #E2E8F0;
            --gray-300: #CBD5E1;
            --gray-500: #64748B;
            --gray-700: #334155;
            --gray-900: #0F172A;
        }
        * { font-family: 'Inter', sans-serif; }
        body { background-color: var(--gray-100); }

        /* Sidebar */
        .sidebar {
            position: fixed; top: 0; left: 0; bottom: 0; width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--gray-900) 0%, var(--dark) 100%);
            color: white; padding: 0; z-index: 1000; overflow-y: auto;
            transition: all 0.3s;
        }
        .sidebar-brand {
            padding: 1.25rem 1.5rem; font-size: 1.4rem; font-weight: 800;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }
        .sidebar-brand span { color: var(--accent); }
        .sidebar-menu { padding: 1rem 0; }
        .sidebar-menu .menu-label {
            padding: 0.5rem 1.5rem; font-size: 0.7rem; text-transform: uppercase;
            letter-spacing: 1px; color: var(--gray-500); font-weight: 600;
        }
        .sidebar-menu a {
            display: flex; align-items: center; padding: 0.7rem 1.5rem; color: var(--gray-300);
            text-decoration: none; transition: all 0.2s; font-size: 0.9rem; font-weight: 500;
        }
        .sidebar-menu a:hover, .sidebar-menu a.active {
            background: rgba(79,70,229,0.15); color: white;
        }
        .sidebar-menu a.active { border-right: 3px solid var(--primary-light); }
        .sidebar-menu a i { margin-right: 0.75rem; font-size: 1.1rem; width: 20px; text-align: center; }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width); min-height: 100vh;
        }
        .top-bar {
            background: white; padding: 1rem 2rem; border-bottom: 1px solid var(--gray-200);
            display: flex; justify-content: space-between; align-items: center;
            position: sticky; top: 0; z-index: 100;
        }
        .content-area { padding: 2rem; }

        /* Cards */
        .stat-card {
            background: white; border-radius: 16px; padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06); border: none;
            transition: all 0.3s;
        }
        .stat-card:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.08); }
        .stat-card .stat-icon {
            width: 48px; height: 48px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.3rem;
        }
        .stat-card .stat-value { font-size: 1.75rem; font-weight: 700; color: var(--gray-900); }
        .stat-card .stat-label { color: var(--gray-500); font-size: 0.85rem; font-weight: 500; }

        .card { border: none; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.06); }
        .table { color: var(--gray-700); }
        .table thead th { background: var(--gray-50); border-bottom: 2px solid var(--gray-200); font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; color: var(--gray-500); }
        .btn-primary { background: var(--primary); border-color: var(--primary); border-radius: 8px; }
        .btn-primary:hover { background: var(--primary-dark); border-color: var(--primary-dark); }

        /* Badge Styles */
        .badge-pending { background: #FEF3C7; color: #92400E; }
        .badge-confirmed, .badge-verified { background: #D1FAE5; color: #065F46; }
        .badge-cancelled, .badge-rejected { background: #FEE2E2; color: #991B1B; }
        .badge-active { background: #DBEAFE; color: #1E40AF; }
        .badge-used { background: #E0E7FF; color: #3730A3; }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .main-content { margin-left: 0; }
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}" class="text-white text-decoration-none">Mee<span>Topia</span></a>
        </div>
        <div class="sidebar-menu">
            <div class="menu-label">Main</div>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2"></i> Dashboard
            </a>
            <div class="menu-label">Management</div>
            <a href="{{ route('admin.events.index') }}" class="{{ request()->routeIs('admin.events.*') ? 'active' : '' }}">
                <i class="bi bi-calendar-event"></i> Events
            </a>
            <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i> Users
            </a>
            <a href="{{ route('admin.transactions.index') }}" class="{{ request()->routeIs('admin.transactions.*') ? 'active' : '' }}">
                <i class="bi bi-receipt"></i> Transactions
            </a>
            <div class="menu-label">Reports</div>
            <a href="{{ route('admin.reports.index') }}" class="{{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                <i class="bi bi-graph-up"></i> Reports
            </a>
            <div class="menu-label">Account</div>
            <a href="{{ route('home') }}">
                <i class="bi bi-globe"></i> View Site
            </a>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="d-flex align-items-center">
                <button class="btn btn-sm btn-light d-md-none me-3" onclick="document.getElementById('sidebar').classList.toggle('show')">
                    <i class="bi bi-list"></i>
                </button>
                <h5 class="mb-0 fw-bold">@yield('page-title', 'Dashboard')</h5>
            </div>
            <div class="d-flex align-items-center">
                <span class="me-3 text-muted small">{{ now()->format('d M Y') }}</span>
                <div class="dropdown">
                    <a href="#" class="text-decoration-none d-flex align-items-center" data-bs-toggle="dropdown">
                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width:36px;height:36px;font-weight:600;font-size:0.85rem;">
                            {{ strtoupper(auth()->user()->name[0]) }}
                        </div>
                        <span class="ms-2 fw-medium">{{ auth()->user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><span class="dropdown-item-text small text-muted">{{ auth()->user()->email }}</span></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('home') }}"><i class="bi bi-globe"></i> View Site</a></li>
                        <li>
                            <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Flash Messages -->
        @if(session('success'))
        <div class="content-area pb-0">
            <div class="alert alert-success alert-dismissible fade show">
                <i class="bi bi-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
        @endif
        @if(session('error'))
        <div class="content-area pb-0">
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
        @endif

        <!-- Content -->
        <div class="content-area">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
