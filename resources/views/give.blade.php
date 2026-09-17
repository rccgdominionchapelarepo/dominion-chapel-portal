@extends('layouts.public')

@section('title', 'Give Online — RCCG Dominion Chapel')

@section('content')
  <main id="main-content" class="give-page">
    <div class="wrap">
      <div class="give-intro">
        <a href="{{ url('/') }}" class="back-link">← Back to Home</a>
        <h1>Tithing &amp; Giving</h1>
        <p>Your generosity fuels the work of God in Arepo. "Every man according as he purposeth in his heart, so let him give; not grudgingly, or of necessity: for God loveth a cheerful giver." — 2 Corinthians 9:7</p>
      </div>

      <div class="give-grid">
        <div class="bank-card">
            <h3>Direct Bank Transfers</h3>
            <p style="color: rgba(255,255,255,0.7); margin-bottom: 24px; font-size: 14.5px;">
                You can make direct transfers to the official church accounts below. 
                <br><strong style="color: var(--gold-soft);">Account Name: RCCG Dominion Chapel Arepo</strong>
            </p>

            <div class="bank-details">
                <!-- Tithe & Offering -->
                <div class="bank-item">
                    <b>Offering & Tithe</b>
                    <span>1013520008</span>
                    <div style="font-size: 12.5px; color: rgba(255,255,255,0.6); margin-top: 4px;">Zenith Bank</div>
                </div>

                <!-- Welfare Offering -->
                <div class="bank-item">
                    <b>Welfare Offering</b>
                    <span>1310532351</span>
                    <div style="font-size: 12.5px; color: rgba(255,255,255,0.6); margin-top: 4px;">Eco Bank</div>
                </div>

                <!-- Special Offering (Eco) -->
                <div class="bank-item">
                    <b>Special Offering / Project</b>
                    <span>3782015700</span>
                    <div style="font-size: 12.5px; color: rgba(255,255,255,0.6); margin-top: 4px;">Eco Bank</div>
                </div>

                <!-- Project Account (Zenith) -->
                <div class="bank-item">
                    <b>Project Account</b>
                    <span>1310532344</span>
                    <div style="font-size: 12.5px; color: rgba(255,255,255,0.6); margin-top: 4px;">Zenith Bank</div>
                    <div style="font-size: 10px; color: rgba(255,255,255,0.4); margin-top: 2px;">Name: RCCG Dominion Chapel - Project Acct.</div>
                </div>
            </div>
        </div>
      </div>
      
      <!-- Paste the Bank Details and Transparency Card here -->
      
    </div>
  </main>
@endsection