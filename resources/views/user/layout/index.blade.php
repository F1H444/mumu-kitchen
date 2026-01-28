<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>User Panel | Mumu Kitchen</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="{{ asset('assetsadmin/css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        :root {
            --primary: #FF8C00;
            --primary-dark: #cc7000;
            --accent: #FF3B3B;
            --dark-bg: #121212;
            --card-bg: #1e1e1e;
            --text-main: #ffffff;
            --text-muted: #a0a0a0;
            --border-color: #333333;
            --glass: rgba(255, 255, 255, 0.05);
        }

        body {
            font-family: 'Outfit', sans-serif !important;
            background-color: var(--dark-bg);
            color: var(--text-main);
        }

        /* Overrides for SB Admin */
        .sb-topnav {
            background-color: #000000 !important;
            border-bottom: 1px solid var(--border-color);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }

        .sb-sidenav-dark {
            background-color: #000000 !important;
            border-right: 1px solid var(--border-color);
        }

        .sb-sidenav-dark .sb-sidenav-menu .nav-link {
            color: var(--text-muted);
            transition: 0.3s;
            border-left: 3px solid transparent;
        }

        .sb-sidenav-dark .sb-sidenav-menu .nav-link:hover {
            color: var(--primary);
            background: rgba(255, 140, 0, 0.1);
        }

        .sb-sidenav-dark .sb-sidenav-menu .nav-link.active {
            color: var(--primary);
            background: rgba(255, 140, 0, 0.15);
            border-left: 3px solid var(--primary);
        }

        .sb-sidenav-menu-heading {
            color: #666 !important;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Cards */
        .card {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            background-color: rgba(255, 255, 255, 0.02);
            border-bottom: 1px solid var(--border-color);
            color: var(--text-main);
            font-weight: 600;
        }

        /* Tables */
        .table {
            color: var(--text-main);
        }

        .table-bordered {
            border-color: var(--border-color);
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(255, 255, 255, 0.02);
        }

        .table-hover tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.05);
            color: var(--text-main);
        }

        .datatable-selector,
        .datatable-input {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            color: var(--text-main);
        }

        .datatable-wrapper .datatable-container {
            color: var(--text-main);
        }

        .breadcrumb-item.active {
            color: var(--text-muted);
        }

        .dropdown-menu {
            background-color: #1a1a1a !important;
            border: 1px solid var(--border-color) !important;
            border-radius: 12px !important;
            padding: 0.5rem !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5) !important;
        }

        .dropdown-item {
            color: #ccc !important;
            border-radius: 8px !important;
            padding: 0.6rem 1rem !important;
            transition: all 0.2s ease !important;
            font-size: 0.9rem !important;
        }

        .dropdown-item:hover {
            background-color: rgba(255, 140, 0, 0.1) !important;
            color: var(--primary) !important;
            padding-left: 1.25rem !important;
        }

        .dropdown-divider {
            border-top: 1px solid var(--border-color) !important;
            margin: 0.5rem 0 !important;
            opacity: 1 !important;
        }

        /* EMBER PREMIUM TABLE DESIGN */
        .table {
            border-collapse: separate;
            border-spacing: 0 15px;
            /* Spacing between rows */
            margin-top: 0;
        }

        .table thead th {
            border: none;
            background: linear-gradient(45deg, #FF8C00, #FF5E00);
            color: white;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 1px;
            padding: 18px 20px;
            font-weight: 800;
            box-shadow: 0 4px 15px rgba(255, 140, 0, 0.3);
            border-bottom: none;
        }

        .table thead th:first-child {
            border-top-left-radius: 12px;
            border-bottom-left-radius: 12px;
        }

        .table thead th:last-child {
            border-top-right-radius: 12px;
            border-bottom-right-radius: 12px;
        }

        .table tbody tr {
            background: #1a1a1a;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 12px;
        }

        .table tbody tr:hover {
            transform: translateY(-5px) scale(1.01);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.4);
            background: #222;
            z-index: 10;
            position: relative;
        }

        .table tbody td {
            vertical-align: middle;
            border: none;
            padding: 20px 25px;
            color: #e0e0e0;
            background: transparent;
            /* Let TR background show */
        }

        .table tbody td:first-child {
            border-top-left-radius: 12px;
            border-bottom-left-radius: 12px;
            font-weight: bold;
            color: var(--primary);
        }

        .table tbody td:last-child {
            border-top-right-radius: 12px;
            border-bottom-right-radius: 12px;
        }

        /* Pagination Customization */
        .page-item .page-link {
            background: #1a1a1a;
            border: 1px solid rgba(255, 140, 0, 0.2);
            color: white;
            border-radius: 8px;
            margin: 0 3px;
        }

        .page-item.active .page-link {
            background: var(--primary);
            border-color: var(--primary);
            box-shadow: 0 0 15px rgba(255, 140, 0, 0.4);
        }

        /* Badge Pills Override */
        .badge {
            padding: 8px 16px;
            border-radius: 30px;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.7rem;
            letter-spacing: 0.5px;
        }

        /* Modal Premium Overrides */
        .modal-content {
            background-color: #101010 !important;
            border: 1px solid var(--border-color) !important;
            border-radius: 20px !important;
            overflow: hidden;
        }

        .modal-header {
            border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important;
            padding: 20px 25px !important;
        }

        .modal-title {
            color: var(--primary) !important;
            font-weight: 700 !important;
            letter-spacing: 0.5px;
        }

        .btn-close {
            filter: invert(1) grayscale(100%) brightness(200%);
        }

        .modal-footer {
            border-top: 1px solid rgba(255, 255, 255, 0.05) !important;
            padding: 15px 25px !important;
        }
    </style>
    @yield('style')
</head>

<body class="sb-nav-fixed">
    @include('user.partials.navbar')
    <div id="layoutSidenav" class="d-block">
        <div id="layoutSidenav_nav">
            @include('user.partials.sidebar')
        </div>
        <div id="layoutSidenav_content">
            <main>
                @yield('container')
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('assetsadmin/js/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="{{ asset('assetsadmin/js/datatables-simple-demo.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('script')
</body>

</html>
