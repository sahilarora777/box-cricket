@extends('layouts.admin')

@section('title', 'Booked Slots - Box Cricket Admin')

@section('admin_styles')
    .slot-card {
        transition: all 0.3s ease;
        border: 2px solid #e9ecef;
        background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
        color: white;
    }
    .slot-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        border-color: #ff6b6b;
    }
    .time-display {
        font-size: 1.2rem;
        font-weight: bold;
        color: white;
    }
    .loading {
        text-align: center;
        padding: 20px;
    }
    .customer-info {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        padding: 10px;
        margin-top: 10px;
    }
    .no-bookings {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 15px;
        padding: 40px;
        text-align: center;
    }
@endsection

@section('admin_content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center mb-4">📋 Admin - Booked Slots</h1>
            
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
                    <h5 class="card-title">📅 Select Date to View Booked Slots</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" id="datePicker" class="form-control" placeholder="Select a date">
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-primary" onclick="loadBookedSlots()">
                                <span id="loadButtonText">Show Booked Slots</span>
                                <span id="loadingSpinner" style="display: none;">Loading...</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Booked Slots -->
            <div id="bookedSlotsContainer" class="row" style="display: none;">
                <div class="col-12">
                    <h3>📋 Booked Slots for <span id="selectedDate"></span></h3>
                    <div id="bookedSlotsList" class="row">
                        <!-- Booked slots will be loaded here -->
                    </div>
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
                loadBookedSlots();
            }
        });

        function loadBookedSlots() {
            const date = $('#datePicker').val();
            if (!date) {
                alert('Please select a date first');
                return;
            }

            // Show loading state
            $('#loadButtonText').hide();
            $('#loadingSpinner').show();
            $('#bookedSlotsContainer').hide();

            $('#selectedDate').text(formatDate(date));
            
            $.ajax({
                url: '{{ route("admin.booked-slots.get-by-date") }}',
                method: 'POST',
                data: {
                    date: date,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    displayBookedSlots(response);
                },
                error: function() {
                    alert('Error loading booked slots');
                },
                complete: function() {
                    // Hide loading state
                    $('#loadButtonText').show();
                    $('#loadingSpinner').hide();
                }
            });
        }

        function displayBookedSlots(bookedSlots) {
            const container = $('#bookedSlotsList');
            container.empty();

            if (bookedSlots.length === 0) {
                container.html(`
                    <div class="col-12">
                        <div class="no-bookings">
                            <h4>🎉 No Booked Slots</h4>
                            <p>All slots for this date are available for booking.</p>
                            <p>Try selecting a different date or check the regular slots page.</p>
                        </div>
                    </div>
                `);
            } else {
                bookedSlots.forEach(function(slot) {
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
                                    <div class="customer-info">
                                        <p class="mb-1"><strong>👤 ${slot.customer_name}</strong></p>
                                        <p class="mb-1"><small>📧 ${slot.customer_email}</small></p>
                                        <p class="mb-0"><small>📅 Booked: ${slot.booked_at}</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    container.append(slotHtml);
                });
            }

            $('#bookedSlotsContainer').show();
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
    </script>
@endpush 