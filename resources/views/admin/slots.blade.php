@extends('layouts.admin')

@section('title', 'Admin - Manage Slots')

@section('admin_styles')
    .slot-card {
        transition: all 0.3s ease;
        border: 2px solid #e9ecef;
    }
    .slot-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        border-color: #007bff;
    }
    .booked-slot {
        opacity: 0.6;
        background-color: #f8f9fa;
    }
    .time-display {
        font-size: 1.2rem;
        font-weight: bold;
        color: #007bff;
    }
    .loading {
        text-align: center;
        padding: 20px;
    }
    .booking-modal .modal-content {
        border-radius: 15px;
    }
    .slot-details {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
    }
    .time-display-modal {
        font-size: 1.5rem;
        font-weight: bold;
        text-align: center;
        margin: 10px 0;
    }
@endsection

@section('admin_content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center mb-4">🏏 Admin - Manage Slots</h1>
            
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Date Selection -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">📅 Select Date</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" id="datePicker" class="form-control" placeholder="Select a date">
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-primary" onclick="loadSlots()">
                                <span id="loadButtonText">Show Available Slots</span>
                                <span id="loadingSpinner" style="display: none;">Loading...</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Available Slots -->
            <div id="slotsContainer" class="row" style="display: none;">
                <div class="col-12">
                    <h3>🎯 Available Slots for <span id="selectedDate"></span></h3>
                    <div id="slotsList" class="row">
                        <!-- Slots will be loaded here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Booking Modal -->
    <div class="modal fade booking-modal" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookingModalLabel">🏏 Book Your Slot</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Slot Details -->
                    <div class="slot-details">
                        <h5 class="text-center mb-3">📅 Slot Details</h5>
                        <div class="row text-center">
                            <div class="col-6">
                                <strong>Date:</strong><br>
                                <span id="modalDate"></span>
                            </div>
                            <div class="col-6">
                                <strong>Day:</strong><br>
                                <span id="modalDay"></span>
                            </div>
                        </div>
                        <div class="time-display-modal">
                            <span id="modalTime"></span>
                        </div>
                    </div>

                    <!-- Booking Form -->
                    <form id="bookingForm" action="{{ route('bookings.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="slot_id" id="modalSlotId">
                        
                        <div class="mb-3">
                            <label for="customer_name" class="form-label">👤 Full Name *</label>
                            <input type="text" class="form-control" id="customer_name" name="customer_name" 
                                   placeholder="Enter your full name" required>
                        </div>

                        <div class="mb-3">
                            <label for="customer_email" class="form-label">📧 Email Address *</label>
                            <input type="email" class="form-control" id="customer_email" name="customer_email" 
                                   placeholder="Enter your email address" required>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                ✅ Confirm Booking
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Initialize date picker
        flatpickr("#datePicker", {
            dateFormat: "Y-m-d",
            minDate: "today",
            onChange: function(selectedDates, dateStr, instance) {
                loadSlots();
            }
        });

        function loadSlots() {
            const date = $('#datePicker').val();
            if (!date) {
                alert('Please select a date first');
                return;
            }

            // Show loading state
            $('#loadButtonText').hide();
            $('#loadingSpinner').show();
            $('#slotsContainer').hide();

            $('#selectedDate').text(formatDate(date));
            
            $.ajax({
                url: '{{ route("slots.get-by-date") }}',
                method: 'POST',
                data: {
                    date: date,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    displaySlots(response);
                },
                error: function() {
                    alert('Error loading slots');
                },
                complete: function() {
                    // Hide loading state
                    $('#loadButtonText').show();
                    $('#loadingSpinner').hide();
                }
            });
        }

        function displaySlots(slots) {
            const container = $('#slotsList');
            container.empty();

            if (slots.length === 0) {
                container.html(`
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            <h4>😔 No Available Slots</h4>
                            <p>All slots for this date are already booked or not available.</p>
                            <p>Try selecting a different date.</p>
                        </div>
                    </div>
                `);
            } else {
                slots.forEach(function(slot) {
                    const slotHtml = `
                        <div class="col-md-4 mb-3">
                            <div class="card slot-card">
                                <div class="card-body text-center">
                                    <div class="time-display mb-2">
                                        ${slot.formatted_start_time} - ${slot.formatted_end_time}
                                    </div>
                                    <div class="mb-2" style="font-size:1.1rem; color:#28a745; font-weight:500;">
                                        Price: ₹${slot.price}
                                    </div>
                                    <p class="card-text text-muted">Available for booking</p>
                                    <button class="btn btn-primary" onclick="openBookingModal(${slot.id}, '${slot.date}', '${slot.formatted_start_time}', '${slot.formatted_end_time}')">
                                        🏏 Book Now
                                    </button>
                                </div>
                            </div>
                        </div>
                    `;
                    container.append(slotHtml);
                });
            }

            $('#slotsContainer').show();
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('en-US', { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric' 
            });
        }

        function openBookingModal(slotId, date, startTime, endTime) {
            // Set modal content
            $('#modalSlotId').val(slotId);
            $('#modalDate').text(formatDate(date));
            $('#modalDay').text(formatDay(date));
            $('#modalTime').text(startTime + ' - ' + endTime);
            
            // Clear form
            $('#bookingForm')[0].reset();
            
            // Show modal
            const modal = new bootstrap.Modal(document.getElementById('bookingModal'));
            modal.show();
        }

        function formatDay(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('en-US', { weekday: 'long' });
        }

        // Handle form submission
        $('#bookingForm').on('submit', function(e) {
            e.preventDefault();
            
            const formData = $(this).serialize();
            
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                success: function(response) {
                    // Close modal
                    const modal = bootstrap.Modal.getInstance(document.getElementById('bookingModal'));
                    modal.hide();
                    
                    // Show success message
                    showAlert('Booking confirmed successfully!', 'success');
                    
                    // Reload slots to update availability
                    loadSlots();
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        // Validation errors
                        const errors = xhr.responseJSON.errors;
                        let errorMessage = 'Please fix the following errors:\n';
                        for (let field in errors) {
                            errorMessage += errors[field][0] + '\n';
                        }
                        alert(errorMessage);
                    } else {
                        alert('Error creating booking. Please try again.');
                    }
                }
            });
        });

        function showAlert(message, type) {
            const alertHtml = `
                <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            `;
            $('.admin-main-content').prepend(alertHtml);
        }
    </script>
@endpush 