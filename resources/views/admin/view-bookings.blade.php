@extends('layouts.admin')

@section('title', 'View Bookings - Box Cricket Admin')

@section('admin_styles')
    .admin-card {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 15px;
    }
    .table th {
        background-color: #f8f9fa;
        border-top: none;
        font-weight: 600;
    }
    .time-column {
        font-weight: bold;
        color: #007bff;
    }
    .customer-name {
        font-weight: 600;
        color: #495057;
    }
    .stats-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
    }
@endsection

@section('admin_content')
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">🏏 Home</a></li>
                    <li class="breadcrumb-item active">View Bookings</li>
                </ol>
            </nav>
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>📋 Admin Dashboard - Bookings</h1>
                <a href="{{ route('admin.slots') }}" class="btn btn-primary">🏏 Back to Slots</a>
            </div>

            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="stats-card text-center">
                        <h3>{{ $bookings->count() }}</h3>
                        <p class="mb-0">Total Bookings</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stats-card text-center">
                        <h3>{{ $bookings->where('booking_date', '>=', now()->format('Y-m-d'))->count() }}</h3>
                        <p class="mb-0">Upcoming Bookings</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stats-card text-center">
                        <h3>{{ $bookings->where('booking_date', '<', now()->format('Y-m-d'))->count() }}</h3>
                        <p class="mb-0">Past Bookings</p>
                    </div>
                </div>
            </div>

            @if($bookings->count() > 0)
                <div class="card admin-card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">📊 All Bookings</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>👤 Customer Name</th>
                                        <th>📧 Email</th>
                                        <th>📅 Date</th>
                                        <th>🕐 Time</th>
                                        <th>📝 Booked On</th>
                                        <th>� Price</th>
                                        <th>�📊 Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bookings as $index => $booking)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td class="customer-name">{{ $booking->customer_name }}</td>
                                            <td>{{ $booking->customer_email }}</td>
                                            <td>{{ $booking->booking_date->format('F j, Y') }}</td>
                                            <td class="time-column">
                                                {{ \Carbon\Carbon::parse($booking->slot->start_time)->format('g:i A') }} - 
                                                {{ \Carbon\Carbon::parse($booking->slot->end_time)->format('g:i A') }}
                                            </td>
                                            <td>{{ $booking->created_at }}</td>
                                            <td>₹{{ $booking->slot->price ?? 'N/A' }}</td>
                                            <td>
                                                @if($booking->booking_date > now())
                                                    <span class="badge bg-success">Upcoming</span>
                                                @elseif($booking->booking_date == now()->format('Y-m-d'))
                                                    <span class="badge bg-warning">Today</span>
                                                @else
                                                    <span class="badge bg-secondary">Completed</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
       <div class="mt-4">
    <div class="d-flex justify-content-between align-items-center flex-column flex-md-row px-3">
        <p class="text-muted mb-2 mb-md-0">
            <strong>Total Bookings on this page:</strong> {{ $bookings->count() }}
        </p>
        <div>
            {{ $bookings->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>


                    </div>
                </div>
            @else
                <div class="alert alert-info text-center">
                    <h4>😔 No Bookings Found</h4>
                    <p>No slots have been booked yet.</p>
                    <a href="{{ route('admin.slots') }}" class="btn btn-primary">🏏 Go to Slots</a>
                </div>
            @endif
        </div>
    </div>
@endsection 