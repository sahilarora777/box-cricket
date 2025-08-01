<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Slot - Box Cricket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .booking-card {
            max-width: 500px;
            margin: 0 auto;
        }
        .slot-details {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .time-display {
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card booking-card">
                    <div class="card-header">
                        <h3 class="text-center">🏏 Book Your Slot</h3>
                    </div>
                    <div class="card-body">
                        <!-- Slot Details -->
                        <div class="slot-details">
                            <h5 class="text-center mb-3">📅 Slot Details</h5>
                            <div class="row text-center">
                                <div class="col-6">
                                    <strong>Date:</strong><br>
                                    {{ $slot->date->format('F j, Y') }}
                                </div>
                                <div class="col-6">
                                    <strong>Day:</strong><br>
                                    {{ $slot->date->format('l') }}
                                </div>
                            </div>
                            <div class="time-display">
                                {{ \Carbon\Carbon::parse($slot->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($slot->end_time)->format('g:i A') }}
                            </div>
                        </div>

                        <!-- Booking Form -->
                        <form action="{{ route('bookings.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="slot_id" value="{{ $slot->id }}">
                            
                            <div class="mb-3">
                                <label for="customer_name" class="form-label">👤 Full Name *</label>
                                <input type="text" class="form-control @error('customer_name') is-invalid @enderror" 
                                       id="customer_name" name="customer_name" value="{{ old('customer_name') }}" 
                                       placeholder="Enter your full name" required>
                                @error('customer_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="customer_email" class="form-label">📧 Email Address *</label>
                                <input type="email" class="form-control @error('customer_email') is-invalid @enderror" 
                                       id="customer_email" name="customer_email" value="{{ old('customer_email') }}" 
                                       placeholder="Enter your email address" required>
                                @error('customer_email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    ✅ Confirm Booking
                                </button>
                                <a href="{{ route('slots.index') }}" class="btn btn-secondary">
                                    ← Back to Slots
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 