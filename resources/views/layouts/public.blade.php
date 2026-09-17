<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'RCCG Dominion Chapel, Arepo — Help From Above')</title>
  <meta name="description" content="@yield('meta_description', 'RCCG Dominion Chapel, LP 21 HQ Annex, Arepo — a parish of The Redeemed Christian Church of God.')">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon-16x16.png') }}">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/apple-touch-icon.png') }}">
  <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">
  
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,300;9..144,400;9..144,500;9..144,600;9..144,700&family=Work+Sans:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
  
  @yield('extra_head')
  <!-- Alpine.js for interactive components -->
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body>
  <a href="#main-content" class="skip-link">Skip to main content</a>

  <style>
      /* --- THE ANTI-HOVER HACK --- */
      /* 1. Make the wrapper invisible to the mouse so old CSS :hover CANNOT trigger */
      .nav-dropdown { pointer-events: none !important; }
      
      /* 2. Re-enable physical clicks on the button and menu */
      .dropdown-toggle, .dropdown-menu { pointer-events: auto !important; }
      
      /* 3. Force the menu to hide unconditionally */
      .nav-dropdown .dropdown-menu {
          display: none !important;
          opacity: 0 !important;
          visibility: hidden !important;
      }
      
      /* 4. Force the menu to open ONLY when JavaScript applies this exact class */
      .nav-dropdown.force-open .dropdown-menu {
          display: flex !important;
          opacity: 1 !important;
          visibility: visible !important;
      }
      .nav-dropdown.force-open .chevron {
          transform: rotate(180deg) !important;
          color: var(--gold) !important;
      }
      
      /* --- Mobile Specific Overrides --- */
      @media (max-width: 900px) {
          .nav-dropdown.force-open .dropdown-menu {
              position: static !important;
              transform: none !important;
              width: 100% !important;
              box-shadow: none !important;
              background: rgba(0, 0, 0, 0.15) !important;
              border: none !important;
              padding: 0 !important;
              margin-top: 4px !important;
          }
          .nav-dropdown.force-open .dropdown-menu a {
              padding: 12px 20px !important;
              border-bottom: 1px solid rgba(255, 255, 255, 0.04) !important;
          }
      }
      
      /* --- Desktop Specific Overrides --- */
      @media (min-width: 901px) {
          .nav-dropdown.force-open .dropdown-menu {
              transform: translateX(-50%) translateY(0) !important;
          }
      }
  </style>

  <header>
    <div class="nav">
      <a class="brand" href="{{ url('/') }}">
        <picture>
          <source srcset="{{ asset('images/logo.webp') }}" type="image/webp">
          <img src="{{ asset('images/logo.png') }}" alt="RCCG logo" width="500" height="250">
        </picture>
        <div class="brand-text"><b>Dominion Chapel</b><span>LP 21 HQ ANNEX · AREPO</span></div>
      </a>
      
      <nav class="links" id="navLinks">
        <a href="{{ url('/#top') }}">Home</a>
        
        <!-- ABOUT DROPDOWN -->
        <div class="nav-dropdown">
          <button class="dropdown-toggle" onclick="pureClickToggle(event)">
            About <span class="chevron">▼</span>
          </button>
          <div class="dropdown-menu">
            <a href="{{ url('/#about') }}">About Us</a>
            <a href="{{ url('/#leadership') }}">Meet the Pastor</a>
            <a href="{{ url('/#about') }}">Who we are</a>
          </div>
        </div>
        
        <!-- MEDIA DROPDOWN -->
        <div class="nav-dropdown">
          <button class="dropdown-toggle" onclick="pureClickToggle(event)">
            Media <span class="chevron">▼</span>
          </button>
          <div class="dropdown-menu">
            <a href="https://www.youtube.com/@Iam_kayodepeter/live" target="_blank" rel="noopener noreferrer">Sermons/Watch Live</a>
            <a href="{{ route('sermons.index') }}">Gallery</a>
            <a href="{{ url('/downloads') }}">Download Page</a>
          </div>
        </div>
        
        <!-- GET INVOLVED DROPDOWN -->
        <div class="nav-dropdown">
          <button class="dropdown-toggle" onclick="pureClickToggle(event)">
            Get Involved <span class="chevron">▼</span>
          </button>
          <div class="dropdown-menu">
            <a href="{{ url('/#schedule') }}">Ministries</a>
            <a href="{{ url('/#programs') }}">Events</a>
            <a href="{{ url('/#visit') }}">New Here</a>
            <a href="{{ url('/#visit') }}">FAQ</a>
          </div>
        </div>
        
        <a href="{{ route('contact') }}">Contact</a>
        
        @auth
            <a href="{{ route('dashboard') }}" style="color: #D4AF37; font-weight: 600;">Dashboard</a>
        @else
            <a href="{{ route('login') }}" style="font-weight: 600;">Sign In</a>
        @endauth

        <a href="{{ route('give') }}" class="btn-gold-nav">Give</a>
      </nav>
      
      <button class="burger" id="burgerBtn" aria-label="Open menu">☰</button>
    </div>
  </header>

  <script>
    function pureClickToggle(e) {
      // Stop the tap from falling through to the links below it!
      e.preventDefault();
      e.stopPropagation();

      const btn = e.currentTarget;
      const parent = btn.closest('.nav-dropdown');
      const wasOpen = parent.classList.contains('force-open');

      // 1. Close all dropdowns
      document.querySelectorAll('.nav-dropdown').forEach(drop => {
        drop.classList.remove('force-open');
      });

      // 2. Open the one we tapped (if it wasn't already open)
      if (!wasOpen) {
        parent.classList.add('force-open');
      }
    }

    // 3. Close menus when clicking anywhere else on the screen
    document.addEventListener('click', function(e) {
      if (!e.target.closest('.nav-dropdown')) {
        document.querySelectorAll('.nav-dropdown').forEach(drop => {
          drop.classList.remove('force-open');
        });
      }
    });
  </script>
  
  <!-- Dynamic Content Injected Here -->
  @yield('content')

  <footer>
    <div class="wrap">
      <div class="foot-grid">
        <!-- Column 1: Brand -->
        <div>
          <div class="foot-brand">
            <picture>
              <source srcset="{{ asset('images/logo.webp') }}" type="image/webp">
              <img src="{{ asset('images/logo.png') }}" alt="RCCG logo" width="500" height="250" loading="lazy">
            </picture>
            <div class="brand-text"><b>Dominion Chapel</b><span>LP 21 HQ ANNEX · AREPO</span></div>
          </div>
          <p>A parish of The Redeemed Christian Church of God, gathered at 21 Pure Water Street, Arepo, Ogun State — carrying help from above into every home we reach.</p>
          <div class="foot-socials">
            <a href="https://www.facebook.com/RCCGdominionchapelarepo" target="_blank" rel="noopener" aria-label="Facebook">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
            </a>
            <a href="https://www.instagram.com/rccgdominionchapelarepo/" target="_blank" rel="noopener" aria-label="Instagram">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
            </a>
            <a href="https://wa.me/2348133569012" target="_blank" rel="noopener" aria-label="WhatsApp">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
            </a>
            <a href="https://" target="_blank" rel="noopener" aria-label="Tiktok">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
            </a>
          </div>
        </div>

        <!-- Column 2: Explore -->
        <div>
          <h5>Explore</h5>
          <ul>
            <li><a href="{{ url('/#about') }}">About Us</a></li>
            <li><a href="{{ url('/#leadership') }}">Meet the Pastor</a></li>
            <li><a href= "https://www.youtube.com/@Iam_kayodepeter/live"  target="_blank" rel="noopener">Sermons/Watch Live</a></li>
            <li><a href="{{ url('/#programs') }}">Events</a></li>
            <li><a href="{{ url('/#schedule') }}">Ministries</a></li>
            <li><a href="{{ url('/gallery') }}">Gallery</a></li>
            <li><a href="{{ url('/#about') }}">Who we are</a></li>
            <li><a href="{{ url('/#visit') }}">New Here</a></li>
          </ul>
        </div>

        <!-- Column 3: Connect -->
        <div>
          <h5>Connect</h5>
          <ul class="foot-connect-list">
            <li>
              <a href="tel:+2348133569012">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                <span>+234 813 356 9012</span>
              </a>
            </li>
            <li>
              <a href="mailto:rccgdominionchapel2026@gmail.com?subject=Inquiry">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                <span>rccgdominionchapel2026@gmail.com</span>
              </a>
            </li>
            <li>
              <a href="https://wa.me/2348133569012" target="_blank" rel="noopener">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0

                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                <span>Facebook Page</span>
              </a>
            </li>
            <li>
              <a href="https://www.google.com/maps/search/?api=1&query=21+Pure+Water+Street+Arepo+Ogun+State+Nigeria" target="_blank" rel="noopener">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                <span>Get Directions</span>
              </a>
            </li>
          </ul>
        </div>

        <!-- Column 4: Get Involved -->
        <div>
          <h5>Get Involved</h5>
          <ul>
            <li><a href="{{ url('/give') }}">Give Online</a></li>
            <li><a href="{{ url('/contact') }}">Prayer Request</a></li>
            <li><a href="https://wa.me/2348133569012" target="_blank" rel="noopener">Join Community</a></li>
          </ul>
          <div style="margin-top:20px;">
            <span style="font-size:13px; color:rgba(255,255,255,0.6); display:block; margin-bottom:8px;">Subscribe to Newsletter</span>
            <form class="newsletter-form" action="https://formspree.io/f/placeholder" method="POST">
              <div class="newsletter-input-group">
                <input type="email" name="email" placeholder="Your Email" required aria-label="Email Address">
                <button type="submit">Join</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Bottom Bar -->
      <div class="foot-bottom">
        <span>© {{ date('Y') }} RCCG Dominion Chapel, Arepo. All rights reserved.</span>
        <span>A parish of the Redeemed Christian Church of God</span>
      </div>
    </div>
  </footer>

  <script defer src="{{ asset('js/main.js') }}"></script>
</body>
</html>