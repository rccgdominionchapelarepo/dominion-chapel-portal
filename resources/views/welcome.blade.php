@extends('layouts.public')

@section('title', 'RCCG Dominion Chapel, Arepo — Help From Above')

@section('extra_head')
  <link rel="manifest" href="{{ asset('manifest.json') }}">
  <meta name="theme-color" content="#1f1663">
@endsection

@section('content')
<main id="main-content">

<!-- HERO SECTION -->
<section class="hero" id="top">
  <div class="hero-inner">
    <div class="hero-copy reveal in">
      <div class="eyebrow">Welcome to RCCG Dominion Chapel</div>
      <h1>Help<br><em>From Above</em></h1>
      <div class="hero-verse">
        "I will lift up mine eyes unto the hills, from whence cometh my help. My help cometh from the LORD, which made heaven and earth."
        <cite>Psalm 121:1–2</cite>
      </div>
      <div class="hero-ctas">
        <a href="#visit" class="btn btn-gold">Plan Your Visit</a>
        <a href="#schedule" class="btn btn-ghost">Service Times</a>
        <a href="https://www.youtube.com/@Iam_kayodepeter/live" target="_blank" rel="noopener noreferrer" class="btn btn-ghost">Watch Live</a>
      </div>
    </div>
    
    <div class="hero-banner-card reveal in">
      <picture>
        <source srcset="{{ asset('images/hero-banner-small.webp') }} 640w, {{ asset('images/hero-banner.webp') }} 1376w" sizes="(max-width: 900px) 100vw, 1200px" type="image/webp">
        <source srcset="{{ asset('images/hero-banner-small.png') }} 640w, {{ asset('images/hero-banner.png') }} 1376w" sizes="(max-width: 900px) 100vw, 1200px" type="image/png">
        <img src="{{ asset('images/hero-banner.png') }}" alt="RCCG Dominion Chapel 2026 Theme Banner" width="1376" height="768">
      </picture>
    </div>
  </div>
</section>

<!-- ABOUT SECTION (This is where the #about link scrolls to) -->
<section class="welcome" id="about">
  <div class="wrap welcome-grid">
    <div class="reveal">
      <div class="eyebrow">Who We Are</div>
      <h2>A house of light for the Arepo community.</h2>
    </div>
    <div class="reveal">
      <p>RCCG Dominion Chapel, LP 21 HQ Annex sits at 21 Pure Water Street in Arepo, Ogun State, as a local parish of The Redeemed Christian Church of God. The assembly was inaugurated on Sunday, June 19, 2011, and has since grown into a warm, active family of worshippers drawn from across Arepo and its neighbouring communities.</p>
      <p>As part of the wider RCCG family, our calling is simple: to know Christ, to grow in holiness, and to carry that light to every household within reach — one relationship, one service, one act of care at a time.</p>
      <div class="fact-row">
        <div class="fact"><div class="num">2011</div><div class="lbl">YEAR FOUNDED</div></div>
        <div class="fact"><div class="num">LP 21</div><div class="lbl">LAGOS PROVINCE</div></div>
        <div class="fact"><div class="num">At least 3</div><div class="lbl">GATHERINGS WEEKLY</div></div>
        <div class="fact"><div class="num">Arepo</div><div class="lbl">OGUN STATE</div></div>
      </div>
    </div>
  </div>
</section>

<!-- SCHEDULE SECTION -->
<section class="schedule" id="schedule">
  <div class="wrap">
    <div class="reveal">
      <div class="eyebrow">Weekly Gatherings</div>
      <h2>At least three open doors, every single week.</h2>
    </div>
    <div class="sched-list reveal">
      <div class="sched-row">
        <div class="day">Sunday</div>
        <div><h4>Sunday Service &amp; Sunday School</h4><p>Worship, the Word, and Bible-based teaching for every age group.</p></div>
        <div class="time">8:00 AM</div>
      </div>
      <div class="sched-row">
        <div class="day">Tuesday</div>
        <div><h4>Digging Deep <span class="mid">(Midweek)</span></h4><p>Our midweek gathering for prayer and deeper study of scripture.</p></div>
        <div class="time">6:00 PM</div>
      </div>
      <div class="sched-row">
        <div class="day">Thursday</div>
        <div><h4>Faith Clinic <span class="mid">(Midweek)</span></h4><p>A dedicated hour of prayer and the Word for the sick, the burdened and the believing — ministered in faith for healing and wonders.</p></div>
        <div class="time">6:00 PM</div>
      </div>
      <div class="sched-row">
        <div class="day">PERIODIC</div>
        <div><h4>Praise Evening & Special Programs</h4><p>Seasonal programmes for praise and breakthrough that will be announced ahead of time.</p></div>
        {{-- <div class="time"><a href="{{ route('programs') }}">View Details</a></div> --}}
      </div>
    </div>
  </div>
</section>

<!-- LEADERSHIP SECTION -->
<section class="leader" id="leadership">
  <div class="wrap leader-grid">
    <div class="leader-photos reveal">
      
      <picture class="lp1">
        <source srcset="{{ asset('images/pastor-1-small.webp') }} 640w, {{ asset('images/pastor-1.webp') }} 1440w" sizes="(max-width: 600px) 480px, 1440px" type="image/webp">
        <img src="{{ asset('images/pastor-1.jpg') }}" alt="Pastor Peter Oyesiku ministering" width="1440" height="1920">
      </picture>
      
      <picture class="lp3">
        <source srcset="{{ asset('images/pastor-3-small.webp') }} 640w, {{ asset('images/pastor-3.webp') }} 1440w" sizes="(max-width: 600px) 480px, 1440px" type="image/webp">
        <img src="{{ asset('images/pastor-3.jpg') }}" alt="Pastor Peter Oyesiku" width="1440" height="1920">
      </picture>
      
      <picture class="lp2">
        <source srcset="{{ asset('images/pastor-2-small.webp') }} 640w, {{ asset('images/pastor-2.webp') }} 1440w" sizes="(max-width: 600px) 480px, 1440px" type="image/webp">
        <img src="{{ asset('images/pastor-2.jpg') }}" alt="Pastor Peter Oyesiku speaking" width="1440" height="1920">
      </picture>
      
    </div>
    <div class="reveal">
      <div class="eyebrow">Leadership</div>
      <h2>Pastor Peter Oyesiku</h2>
      <div class="role">Assistant Pastor in Charge · APICP Admin, Lagos Province 21</div>
      <p>Pastor Peter Oyesiku shepherds Dominion Chapel as Assistant Pastor in Charge, and also serves the wider region as Administrator for Lagos Province 21 (APICP Admin). His ministry leans on practical, scripture-rooted teaching, calling the church to watch, pray, and expect the supernatural in ordinary life.</p>
      <div class="quote">"Whatever your past or present may be, there is help from above for you today."</div>
    </div>
  </div>
</section>

<!-- PROGRAMS SECTION -->
<section class="programs" id="programs">
  <div class="wrap">
    <div class="prog-head reveal">
      <div class="eyebrow">Program Highlights</div>
      <h2>A church that keeps building, teaching and praying together.</h2>
      <p>A glimpse of recent programmes from Dominion Chapel — from Sunday services to midweek prayer and seasonal outreach. New dates for each series are shared through our Sunday bulletin and social channels.</p>
    </div>
    <div class="prog-grid">
      @forelse($events as $event)
        <div class="prog-card reveal in">
          <div class="thumb">
            <!-- Pulls the uploaded image from the storage folder -->
            <img src="{{ asset('storage/' . $event->image_path) }}" alt="{{ $event->title }}" style="width: 100%; height: 100%; object-fit: cover;" loading="lazy">
          </div>
          <div class="meta">
            <div class="tag">{{ $event->tag }}</div>
            <h4>{{ $event->title }}</h4>
          </div>
        </div>
      @empty
        <p style="color: var(--ink-soft); grid-column: 1 / -1; text-align: center; padding: 40px 0;">
            New programs and flyers will be announced soon!
        </p>
      @endforelse
    </div>
  </div>
</section>



<!-- VISIT SECTION -->
<section class="visit" id="visit">
  <div class="wrap visit-grid">
    <div class="reveal">
      <div class="eyebrow">Plan Your Visit</div>
      <h2>Come as you are — we'll save you a seat.</h2>
      <p>Whether you're new to Arepo or have driven past our gate a dozen times, Sunday mornings and Tuesday evenings are always open to you and your family.</p>
      <ul class="info-list">
        <li><div class="ic">📍</div><div><b>Address</b><span>21, Pure Water Street, Arepo, Ogun State, Nigeria</span></div></li>
        <li><div class="ic">📞</div><div><b>Phone</b><span>+234 803 371 6791</span></div></li>
        <li><div class="ic">🕗</div><div><b>Sunday Service</b><span>8:00 AM every Sunday</span></div></li>
      </ul>
    </div>
    <div class="map-card reveal" style="padding: 16px; background: var(--navy-deep); min-height: 380px;">
      <iframe src="https://maps.google.com/maps?q=21%20Pure%20Water%20Street%2C%20Arepo%2C%20Ogun%20State%2C%20Nigeria&t=&z=16&ie=UTF8&iwloc=&output=embed" width="100%" height="260" style="border:0; border-radius: 4px; z-index: 2; position: relative;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
  </div>
</section>

</main>
@endsection