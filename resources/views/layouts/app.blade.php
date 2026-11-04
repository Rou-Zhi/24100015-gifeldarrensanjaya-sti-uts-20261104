
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Sistem Absensi Mahasiswa')</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>     
        body {
            background-color: #f5f7f6;
            font-family: Arial, sans-serif;
        }

        /* Sidebar */
        .sidebar {
            min-height: 100vh;
            background-color: #198754;
            padding: 24px 16px !important;
        }

        .sidebar h5 {
            font-size: 18px;
            font-weight: 600;
            white-space: nowrap;
        }

        .sidebar .nav-link {
            display: flex;
            align-items: center;
            gap: 10px;
            color: rgba(255, 255, 255, 0.85);
            padding: 11px 14px;
            border-radius: 8px;
            font-size: 14px;
            transition: 0.2s;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
        }

        /* Ukuran ikon sidebar */
        .sidebar svg {
            width: 17px;
            height: 17px;
            flex-shrink: 0;
        }

        /* Konten utama */
        .main-content {
            padding: 32px;
        }

        .main-content h4 {
            font-size: 23px;
            margin-bottom: 6px;
        }

        /* Ikon tombol dan tabel */
        .btn svg {
            width: 14px;
            height: 14px;
        }

        .card-header svg {
            width: 17px;
            height: 17px;
        }

        @media (max-width: 767px) {
            .sidebar {
                min-height: auto;
            }

            .main-content {
                padding: 20px 14px;
            }
        }
    </style>

    @stack('styles')
</head>
<body>

    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->
            <aside class="col-md-3 col-lg-2 sidebar p-3">
                <h5 class="text-white mb-4">
                    <x-fas-graduation-cap class="me-2" />
                    Sistem Akademik
                </h5>

                <nav class="nav flex-column gap-2">
                    <a href="{{ route('mahasiswa.index') }}"
                        class="nav-link {{ request()->routeIs('mahasiswa.*') ? 'active' : '' }}">
                        <x-fas-users class="me-2" />
                        Mahasiswa
                    </a>

                    <a href="{{ route('matakuliah.index') }}"
                        class="nav-link {{ request()->routeIs('matakuliah.*') ? 'active' : '' }}">
                        <x-fas-book class="me-2" />
                        Mata Kuliah
                    </a>

                    <a href="{{ route('absensi.index') }}"
                        class="nav-link {{ request()->routeIs('absensi.*') ? 'active' : '' }}">
                        <x-fas-calendar-check class="me-2" />
                        Absensi
                    </a>
                </nav>
            </aside>

            <!-- Main Content -->
            <main class="col-md-9 col-lg-10 main-content">

                <div class="mb-4">
                    <h4 class="fw-bold">@yield('heading', 'Dashboard')</h4>
                    <p class="text-muted mb-0">
                        Sistem Pengelolaan Data Akademik
                    </p>
                </div>

                @yield('content')

            </main>

        </div>
    </div>

    <!-- Bootstrap 5 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>
</html>
