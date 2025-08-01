@extends('layouts.admin')

@section('title', 'Create Slots - Box Cricket Admin')

@section('admin_styles')
    .admin-card {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 15px;
    }
    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
@endsection

@section('admin_content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">🏏 Home</a></li>
                    <li class="breadcrumb-item active">Create Slots</li>
                </ol>
            </nav>
            
            <div class="card admin-card">
                <div class="card-header bg-primary text-white">
                    <h3 class="text-center mb-0">⚙️ Create Slots</h3>
                </div>
                <div class="card-body">
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

                    <form action="{{ route('admin.store-slots') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">📅 Date</label>
                                <input type="date" name="date" class="form-control" required min="{{ date('Y-m-d') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">⏰ Start Time</label>
                                <input type="time" name="start_time" class="form-control" required>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">⏰ End Time</label>
                                <input type="time" name="end_time" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">⏱️ Duration (minutes)</label>
                                <input type="number" name="duration" class="form-control" value="60" min="30" max="120" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">💵 Price (INR)</label>
                                <input type="number" name="price" class="form-control" value="0" min="0" step="1" required>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <h6>💡 Instructions:</h6>
                            <ul class="mb-0">
                                <li>Select a date (today or future)</li>
                                <li>Set start and end times (e.g., 6:00 AM to 10:00 PM)</li>
                                <li>Choose slot duration (30-120 minutes)</li>
                                <li>System will create slots automatically</li>
                            </ul>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                ✅ Create Slots
                            </button>
                            <a href="{{ route('admin.slots') }}" class="btn btn-secondary">
                                ← Back to Slots
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection 