@extends('layouts.app')

@section('additional_styles')
    /* Admin layout specific styles */
    .admin-container {
        display: flex;
        min-height: calc(100vh - 76px); /* Subtract navbar height */
    }
    
    .admin-sidebar {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        width: 250px;
        padding: 20px;
        box-shadow: 2px 0 10px rgba(0,0,0,0.1);
    }
    
    .admin-main-content {
        flex: 1;
        padding: 20px;
        background-color: #f0f8ff;
    }
    
    .sidebar-header {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 30px;
        padding-top: 10px;
        text-align: left;
    }
    
    .sidebar-header .cricket-icon {
        font-size: 1.8rem;
    }
    
    .sidebar-header h4 {
        margin: 0;
        font-size: 1.2rem;
        font-weight: bold;
    }
    
    .sidebar-header p {
        margin: 0;
        font-size: 0.8rem;
        opacity: 0.8;
    }
    
    .admin-section {
        margin-bottom: 30px;
    }
    
    .admin-section h6 {
        text-align: left;
        margin-bottom: 15px;
        font-size: 0.9rem;
        opacity: 0.9;
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
    
    /* Additional styles for specific admin pages */
    @yield('admin_styles')
@endsection

@section('content')
    <div class="admin-container">
        <!-- Admin Sidebar -->
        <div class="admin-sidebar">
            <div class="sidebar-header">
                <!-- <span class="cricket-icon">🏏</span> -->
                <div>
                    <!-- <h4>Box Cricket</h4> -->
                    <!-- <p>Admin Panel</p> -->
                </div>
            </div>
            
            <div class="admin-section">
                <h6 style="font-size: 1.3rem; font-weight: bold; text-transform: uppercase; letter-spacing: 1px;">👤 Admin Panel</h6>
                
                <a href="{{ route('admin.slots') }}" class="admin-btn">
                    <div class="d-flex align-items-center">
                        <span class="me-2">📅</span>
                        <div>
                            <strong>Manage Slots</strong>
                            <small class="d-block">View and manage slots</small>
                        </div>
                    </div>
                </a>
                
                <a href="{{ route('admin.booked-slots') }}" class="admin-btn">
                    <div class="d-flex align-items-center">
                        <span class="me-2">📋</span>
                        <div>
                            <strong>Booked Slots</strong>
                            <small class="d-block">View booked slots by date</small>
                        </div>
                    </div>
                </a>
                
                <a href="{{ route('admin.create-slots') }}" class="admin-btn">
                    <div class="d-flex align-items-center">
                        <span class="me-2">⚙️</span>
                        <div>
                            <strong>Create Slots</strong>
                            <small class="d-block">Add new time slots</small>
                        </div>
                    </div>
                </a>
                
                <a href="{{ route('admin.view-bookings') }}" class="admin-btn">
                    <div class="d-flex align-items-center">
                        <span class="me-2">📋</span>
                        <div>
                            <strong>View Bookings</strong>
                            <small class="d-block">Manage all bookings</small>
                        </div>
                    </div>
                </a>
            </div>

            <div class="text-center">
                <small>© 2024 Box Cricket</small>
            </div>
        </div>

        <!-- Admin Main Content -->
        <div class="admin-main-content">
            @yield('admin_content')
        </div>
    </div>
@endsection 