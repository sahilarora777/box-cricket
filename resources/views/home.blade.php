@extends('layouts.app')

@section('title', 'Box Cricket - Your Ultimate Indoor Cricket Experience')

@section('additional_styles')
    .hero-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        padding: 60px 40px;
        text-align: center;
        margin: 40px 0;
    }
    
    .hero-title {
        font-size: 3.5rem;
        font-weight: bold;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 20px;
    }
    
    .hero-subtitle {
        font-size: 1.3rem;
        color: #6c757d;
        margin-bottom: 30px;
    }
    
    .feature-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        padding: 40px 30px;
        margin: 30px 0;
        transition: all 0.3s ease;
    }
    
    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.15);
    }
    
    .feature-title {
        font-size: 1.8rem;
        font-weight: bold;
        color: #2c3e50;
        margin-bottom: 25px;
        text-align: center;
    }
    
    .feature-list {
        list-style: none;
        padding: 0;
    }
    
    .feature-list li {
        padding: 15px 0;
        border-bottom: 1px solid #f8f9fa;
        display: flex;
        align-items: center;
        font-size: 1.1rem;
    }
    
    .feature-list li:last-child {
        border-bottom: none;
    }
    
    .feature-icon {
        font-size: 1.5rem;
        margin-right: 15px;
        width: 40px;
        text-align: center;
    }
    
    .cta-section {
        text-align: center;
        margin: 60px 0;
    }
    
    .cta-title {
        font-size: 2.5rem;
        font-weight: bold;
        color: #2c3e50;
        margin-bottom: 30px;
    }
    
    .cta-buttons {
        display: flex;
        justify-content: center;
        gap: 20px;
        flex-wrap: wrap;
    }
    
    .btn-book {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        border: none;
        color: white;
        font-size: 1.2rem;
        padding: 15px 30px;
    }
    
    .btn-slots {
        background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
        border: none;
        color: white;
        font-size: 1.2rem;
        padding: 15px 30px;
    }
    
    .btn-contact {
        background: linear-gradient(135deg, #007bff 0%, #6610f2 100%);
        border: none;
        color: white;
        font-size: 1.2rem;
        padding: 15px 30px;
    }
    
    .cricket-icon {
        font-size: 2rem;
        margin-left: 10px;
    }
    
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem;
        }
        
        .cta-buttons {
            flex-direction: column;
            align-items: center;
        }
        
        .btn-custom {
            width: 200px;
        }
    }
@endsection

@section('content')
    <!-- Main Content -->
    <div class="container">
        <!-- Hero Section -->
        <div class="hero-card">
            <h1 class="hero-title">
                Box Cricket
                <span class="cricket-icon">🏏</span>
            </h1>
            <p class="hero-subtitle">Your Ultimate Indoor Box Cricket Experience</p>
        </div>

        <!-- What's Inside Section -->
        <div class="feature-card">
            <h2 class="feature-title">
                🔥 What's Inside?
            </h2>
            <ul class="feature-list">
                <li>
                    <span class="feature-icon">🏆</span>
                    <div>
                        <strong>Book Your Slot:</strong> Choose your time, pay online, and you're all set
                    </div>
                </li>
                <li>
                    <span class="feature-icon">🗓️</span>
                    <div>
                        <strong>Check Availability:</strong> Live slot calendar with real-time updates
                    </div>
                </li>
                <li>
                    <span class="feature-icon">📺</span>
                    <div>
                        <strong>Match Highlights:</strong> Get your best moments captured and shared
                    </div>
                </li>
                <li>
                    <span class="feature-icon">👕</span>
                    <div>
                        <strong>Team Customization:</strong> Add player names and team logos
                    </div>
                </li>
                <li>
                    <span class="feature-icon">🎁</span>
                    <div>
                        <strong>Win Rewards:</strong> Loyalty points, match MVPs, and giveaways
                    </div>
                </li>
            </ul>
        </div>

        <!-- Who Can Play Section -->
        <div class="feature-card">
            <h2 class="feature-title">
                👥 Who Can Play?
            </h2>
            <ul class="feature-list">
                <li>
                    <span class="feature-icon">🧑‍🤝‍🧑</span>
                    <div>
                        <strong>College Friends & Office Buddies</strong>
                    </div>
                </li>
                <li>
                    <span class="feature-icon">🎉</span>
                    <div>
                        <strong>Birthday Bash or Corporate Teams</strong>
                    </div>
                </li>
                <li>
                    <span class="feature-icon">🏏</span>
                    <div>
                        <strong>Hardcore Cricketers or First-Time Players</strong>
                    </div>
                </li>
            </ul>
            <p class="text-center mt-3 mb-0" style="font-size: 1.1rem; color: #6c757d;">
                If you can swing a bat or throw a ball - you're in!
            </p>
        </div>

        <!-- Ready to Play Section -->
        <div class="cta-section">
            <h2 class="cta-title">
                ▶️ Ready to Play?
            </h2>
            <div class="cta-buttons">
                <a href="{{ route('slots.index') }}" class="btn btn-book btn-custom">
                    ✅ Book Now
                </a>
                <a href="{{ route('slots.index') }}" class="btn btn-slots btn-custom">
                    📅 Check Slots
                </a>
                <a href="#" class="btn btn-contact btn-custom">
                    📞 Contact Us
                </a>
            </div>
        </div>
    </div>
@endsection 