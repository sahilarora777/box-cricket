<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Bookings - Box Cricket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .booking-table {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .table th {
            background-color: #f8f9fa;
            border-top: none;
        }
        .time-column {
            font-weight: bold;
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1>📋 All Bookings</h1>
                    <a href="{{ route('slots.index') }}" class="btn btn-primary">🏏 Back to Slots</a>
                </div>

                @if($bookings->count() > 0)
                    <div class="card booking-table">
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($bookings as $index => $booking)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td><strong>{{ $booking->customer_name }}</strong></td>
                                                <td>{{ $booking->customer_email }}</td>
                                                <td>{{ $booking->booking_date->format('F j, Y') }}</td>
                                                <td class="time-column">
                                                    {{ \Carbon\Carbon::parse($booking->slot->start_time)->format('g:i A') }} - 
                                                    {{ \Carbon\Carbon::parse($booking->slot->end_time)->format('g:i A') }}
                                                </td>
                                                <td>{{ $booking->created_at->format('M j, Y g:i A') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="mt-3 text-center">
                                <p class="text-muted">
                                    <strong>Total Bookings:</strong> {{ $bookings->count() }}
                                </p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="alert alert-info text-center">
                        <h4>😔 No Bookings Found</h4>
                        <p>No slots have been booked yet.</p>
                        <a href="{{ route('slots.index') }}" class="btn btn-primary">🏏 Go to Slots</a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 