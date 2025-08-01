<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Box Cricket - Your Ultimate Indoor Cricket Experience')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        body {
            background-color: #f0f8ff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .navbar-brand .cricket-icon {
            font-size: 1.8rem;
        }
        
        .nav-link {
            color: white !important;
            margin: 0 10px;
            border-radius: 20px;
            padding: 8px 20px !important;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover, .nav-link.active {
            background-color: rgba(255,255,255,0.2);
            transform: translateY(-2px);
        }
        
        .btn-custom {
            border-radius: 25px;
            padding: 8px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        /* Sidebar styles */
        .sidebar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            min-height: 100vh;
            padding: 20px;
        }
        .sidebar .nav-link {
            color: white;
            border-radius: 10px;
            margin-bottom: 10px;
            transition: all 0.3s ease;
        }
        .sidebar .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.2);
            transform: translateX(5px);
        }
        .sidebar .nav-link.active {
            background-color: rgba(255, 255, 255, 0.3);
        }
        .main-content {
            padding: 20px;
        }
        .admin-btn {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 15px;
            border-radius: 10px;
            text-decoration: none;
            display: block;
            margin-bottom: 15px;
            transition: all 0.3s ease;
        }
        .admin-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            transform: translateY(-2px);
        }

        /* Additional styles for specific pages */
        @yield('additional_styles')
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <span class="cricket-icon">🏏</span>
                <span>Box Cricket</span>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('slots.*') ? 'active' : '' }}" href="{{ route('slots.index') }}">Book A Slot</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.*') ? 'active' : '' }}" href="{{ route('admin.slots') }}">Admin Panel</a>
                    </li>
                </ul>
                
            </div>
        </div>
    </nav>

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @stack('scripts')
</body>
</html> 