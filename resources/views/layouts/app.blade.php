<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MeeTopia') - MeeTopia</title>
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
            --gray-50: #F8FAFC;
            --gray-100: #F1F5F9;
            --gray-200: #E2E8F0;
            --gray-300: #CBD5E1;
            --gray-500: #64748B;
            --gray-700: #334155;
            --gray-900: #0F172A;
        }
        * { font-family: 'Inter', sans-serif; }
        body { background-color: var(--gray-50); color: var(--gray-900); }
        .navbar { background: linear-gradient(135deg, var(--primary), var(--primary-dark)); box-shadow: 0 4px 20px rgba(79,70,229,0.15); }
        .navbar-brand { font-weight: 800; font-size: 1.5rem; letter-spacing: -0.5px; }
        .navbar-brand span { color: var(--accent); }
        .nav-link { color: rgba(255,255,255,0.85) !important; font-weight: 500; transition: all 0.2s; }
        .nav-link:hover, .nav-link.active { color: #fff !important; }
        .btn-primary { background: var(--primary); border-color: var(--primary); }
        .btn-primary:hover { background: var(--primary-dark); border-color: var(--primary-dark); }
        .btn-outline-light:hover { background: rgba(255,255,255,0.15); }
        .hero-section {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white; padding: 5rem 0; position: relative; overflow: hidden;
        }
        .hero-section::before {
            content: ''; position: absolute; top: -50%; right: -20%; width: 600px; height: 600px;
            background: rgba(255,255,255,0.05); border-radius: 50%;
        }
        .hero-section::after {
            content: ''; position: absolute; bottom: -30%; left: -10%; width: 400px; height: 400px;
            background: rgba(255,255,255,0.03); border-radius: 50%;
        }
        .card { border: none; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.08); transition: all 0.3s; }
        .card:hover { box-shadow: 0 8px 25px rgba(0,0,0,0.1); transform: translateY(-2px); }
        .event-card .card-img-top { height: 200px; object-fit: cover; border-radius: 12px 12px 0 0; }
        .badge-kategori { background: var(--primary-light); color: white; font-size: 0.75rem; }
        .price-tag { color: var(--primary); font-weight: 700; font-size: 1.25rem; }
        .footer { background: var(--gray-900); color: var(--gray-300); padding: 3rem 0 1.5rem; }
        .footer a { color: var(--gray-300); text-decoration: none; }
        .footer a:hover { color: white; }
        .alert { border-radius: 10px; }
        .stat-card { background: white; border-radius: 16px; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.08); border-left: 4px solid var(--primary); }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">Mee<span>Topia</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('events*') ? 'active' : '' }}" href="{{ route('events.index') }}">Events</a>
                    </li>
                    @auth
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('bookings*') ? 'active' : '' }}" href="{{ route('bookings.index') }}">My Bookings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('my-tickets*') || request()->is('tickets*') ? 'active' : '' }}" href="{{ route('tickets.index') }}">My Tickets</a>
                    </li>
                    @endauth
                </ul>
                <ul class="navbar-nav">
                    @guest
                    <li class="nav-item me-2">
                        <a class="btn btn-outline-light btn-sm" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-warning btn-sm text-dark fw-bold" href="{{ route('register') }}">Register</a>
                    </li>
                    @endguest
                    @auth
                    @if(auth()->user()->isAdmin())
                    <li class="nav-item me-2">
                        <a class="btn btn-warning btn-sm text-dark fw-bold" href="{{ route('admin.dashboard') }}">
                            <i class="bi bi-shield-lock"></i> Admin Panel
                        </a>
                    </li>
                    @endif
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i> {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('bookings.index') }}"><i class="bi bi-bookmark"></i> My Bookings</a></li>
                            <li><a class="dropdown-item" href="{{ route('tickets.index') }}"><i class="bi bi-ticket-perforated"></i> My Tickets</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item text-danger" type="submit"><i class="bi bi-box-arrow-right"></i> Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
    <div class="container mt-3">
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
    @endif
    @if(session('error'))
    <div class="container mt-3">
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
    @endif
    @if(session('info'))
    <div class="container mt-3">
        <div class="alert alert-info alert-dismissible fade show">
            <i class="bi bi-info-circle"></i> {{ session('info') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
    @endif

    @yield('content')

    <!-- Footer -->
    <footer class="footer mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <h5 class="text-white fw-bold">Mee<span class="text-warning">Topia</span></h5>
                    <p class="small">Platform manajemen event MICE terpadu. Memudahkan penyelenggara dan peserta event dalam satu platform digital.</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h6 class="text-white mb-3">Quick Links</h6>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><a href="{{ route('events.index') }}">Browse Events</a></li>
                        <li class="mb-2"><a href="{{ route('home') }}">About Us</a></li>
                        <li class="mb-2"><a href="#">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-3">
                    <h6 class="text-white mb-3">Contact</h6>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><i class="bi bi-envelope"></i> hello@meetopia.com</li>
                        <li class="mb-2"><i class="bi bi-phone"></i> +62 812 3456 7890</li>
                    </ul>
                </div>
            </div>
            <hr style="border-color: var(--gray-700);">
            <p class="text-center small mb-0">&copy; {{ date('Y') }} MeeTopia. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
