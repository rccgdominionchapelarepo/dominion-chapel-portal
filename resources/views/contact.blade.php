@extends('layouts.public')

@section('title', 'Contact Us — RCCG Dominion Chapel')

@section('content')
  <!-- Responsive Styles -->
  <style>
    .contact-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 60px;
    }
    .contact-form-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
      margin-bottom: 20px;
    }
    .contact-form-card {
      padding: 40px;
    }
    
    /* Mobile Adjustments */
    @media (max-width: 768px) {
      .contact-grid {
        grid-template-columns: 1fr; /* Stacks form and map */
        gap: 40px;
      }
      .contact-form-row {
        grid-template-columns: 1fr; /* Stacks Name and Phone inputs */
      }
      .contact-form-card {
        padding: 24px; /* Gives more room for text on small screens */
      }
      .welcome h1 {
        font-size: 2.2rem !important; /* Shrinks the giant title slightly */
      }
    }
  </style>

  <main id="main-content">
    <section class="welcome" style="padding-bottom: 40px;">
      <div class="wrap" style="text-align: center;">
        <div class="eyebrow" style="margin-bottom: 12px;">Get In Touch</div>
        <h1 style="font-family:'Fraunces',serif; font-size: 2.8rem; color: var(--navy);">Contact, Testimonies &amp; Prayer</h1>
        <p style="max-width: 600px; margin: 16px auto 0; font-size:16px; color:var(--ink-soft); line-height:1.7; padding: 0 15px;">Have a question, want to share a testimony, need counseling, or want us to stand with you in prayer? Fill out the form below and a minister will reach out to you.</p>
      </div>
    </section>

    <section class="contact" id="contact" style="padding-top:0;">
      <div class="wrap" style="padding: 0 15px;">
        
        <!-- Grid Container -->
        <div class="contact-grid">
          
          <!-- Form Card -->
          <div class="contact-form-card reveal in" style="background:#fff; border: 1px solid rgba(31, 22, 99, 0.08); border-radius:6px; box-shadow:0 8px 30px rgba(31,22,99,0.02);">
            <h2 style="font-family:'Fraunces',serif; font-size:1.6rem; color:var(--navy); margin-bottom:24px;">Send Message</h2>
            
            <!-- Success Message -->
            @if (session('success'))
                <div style="background-color: #d1fae5; border: 1px solid #34d399; color: #065f46; padding: 12px 16px; border-radius: 4px; margin-bottom: 24px; font-size: 14px; font-weight: 600;">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('contact.store') }}" method="POST">
              @csrf
              
              <!-- NEW: Anonymous Toggle -->
              <div style="margin-bottom: 24px; display: flex; align-items: center; gap: 10px; background: rgba(31,22,99,0.03); padding: 12px 16px; border-radius: 6px; border: 1px solid rgba(31,22,99,0.08);">
                <input type="checkbox" id="is_anonymous" name="is_anonymous" onchange="toggleAnonymous()" style="width: 18px; height: 18px; cursor: pointer;">
                <label for="is_anonymous" style="font-size: 14px; font-weight: 600; color: var(--navy); cursor: pointer; user-select: none;">
                  Submit Anonymously <span style="font-weight: 400; color: var(--ink-soft);">(Hide my identity)</span>
                </label>
              </div>

              <!-- Personal Info Wrapper (Hides when anonymous is checked) -->
              <div id="personal_info_fields">
                <div class="contact-form-row">
                  <div class="form-group">
                    <label for="name" style="display:block; font-size:12px; font-weight:600; font-family:'JetBrains Mono',monospace; color:var(--navy); text-transform:uppercase; margin-bottom:8px; letter-spacing:0.04em;">Full Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required style="width:100%; padding:12px 14px; border:1px solid rgba(31,22,99,0.15); border-radius:4px; font-family:inherit;">
                    @error('name') <span style="color: #ef4444; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span> @enderror
                  </div>
                  
                  <div class="form-group">
                    <label for="phone" style="display:block; font-size:12px; font-weight:600; font-family:'JetBrains Mono',monospace; color:var(--navy); text-transform:uppercase; margin-bottom:8px; letter-spacing:0.04em;">Phone Number</label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required style="width:100%; padding:12px 14px; border:1px solid rgba(31,22,99,0.15); border-radius:4px; font-family:inherit;">
                    @error('phone') <span style="color: #ef4444; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span> @enderror
                  </div>
                </div>
                
                <div class="form-group" style="margin-bottom:20px;">
                  <label for="email" style="display:block; font-size:12px; font-weight:600; font-family:'JetBrains Mono',monospace; color:var(--navy); text-transform:uppercase; margin-bottom:8px; letter-spacing:0.04em;">Email Address</label>
                  <input type="email" id="email" name="email" value="{{ old('email') }}" required style="width:100%; padding:12px 14px; border:1px solid rgba(31,22,99,0.15); border-radius:4px; font-family:inherit;">
                  @error('email') <span style="color: #ef4444; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span> @enderror
                </div>
              </div>
              
              <div class="form-group" style="margin-bottom:20px;">
                <label for="subject" style="display:block; font-size:12px; font-weight:600; font-family:'JetBrains Mono',monospace; color:var(--navy); text-transform:uppercase; margin-bottom:8px; letter-spacing:0.04em;">Inquiry Type</label>
                <select id="subject" name="subject" required style="width:100%; padding:12px 14px; border:1px solid rgba(31,22,99,0.15); border-radius:4px; font-family:inherit; background:#fff; height:46px;">
                  <option value="Prayer Request" {{ old('subject') == 'Prayer Request' ? 'selected' : '' }}>Prayer Request</option>
                  <option value="Counseling" {{ old('subject') == 'Counseling' ? 'selected' : '' }}>Counseling</option>
                  <option value="Testimony / Thanksgiving" {{ old('subject') == 'Testimony / Thanksgiving' ? 'selected' : '' }}>Testimony / Thanksgiving</option>
                  <option value="General Inquiry" {{ old('subject') == 'General Inquiry' ? 'selected' : '' }}>General Inquiry</option>
                </select>
                @error('subject') <span style="color: #ef4444; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span> @enderror
              </div>
              
              <div class="form-group" style="margin-bottom:26px;">
                <label for="message" style="display:block; font-size:12px; font-weight:600; font-family:'JetBrains Mono',monospace; color:var(--navy); text-transform:uppercase; margin-bottom:8px; letter-spacing:0.04em;">Your Message / Request</label>
                <textarea id="message" name="message" required style="width:100%; padding:12px 14px; border:1px solid rgba(31,22,99,0.15); border-radius:4px; font-family:inherit; height:120px; resize:vertical;">{{ old('message') }}</textarea>
                @error('message') <span style="color: #ef4444; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span> @enderror
              </div>
              
              <button type="submit" class="btn btn-gold" style="width:100%; justify-content:center;">Send Form</button>
            </form>

            <!-- Script to handle the visual hiding of fields -->
            <script>
              function toggleAnonymous() {
                  const isChecked = document.getElementById('is_anonymous').checked;
                  const personalFields = document.getElementById('personal_info_fields');
                  const nameInput = document.getElementById('name');
                  const phoneInput = document.getElementById('phone');
                  const emailInput = document.getElementById('email');
                  
                  if (isChecked) {
                      personalFields.style.display = 'none';
                      nameInput.removeAttribute('required');
                      phoneInput.removeAttribute('required');
                      emailInput.removeAttribute('required');
                  } else {
                      personalFields.style.display = 'block';
                      nameInput.setAttribute('required', 'required');
                      phoneInput.setAttribute('required', 'required');
                      emailInput.setAttribute('required', 'required');
                  }
              }
            </script>

          <!-- Maps Card -->
          {{-- <div class="map-card-wrapper reveal in" style="display:flex; flex-direction:column; height:100%;">
             <div class="map-container" style="flex-grow:1; min-height:350px; border-radius:6px; overflow:hidden; border:1px solid rgba(31, 22, 99, 0.08); box-shadow:0 8px 30px rgba(31,22,99,0.02); margin-bottom:24px;">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3962.836052735749!2d3.3969335758994793!3d6.667252093327663!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103b9b47e2bde2cb%3A0xe530467a21644781!2s21%20Pure%20Water%20St%2C%20Arepo%2C%20Lagos!5e0!3m2!1sen!2sng!4v1783712345678!5m2!1sen!2sng" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="info-card" style="background:var(--navy-deep); color:#fff; border-radius:6px; padding:30px; border:1px solid rgba(240,180,41,0.2);">
              <h3 style="font-family:'Fraunces',serif; font-size:1.3rem; color:var(--gold); margin-bottom:12px;">RCCG Dominion Chapel</h3>
              <p style="font-size:14.5px; color:rgba(255,255,255,0.7); line-height:1.6; margin-bottom:18px;">21 Pure Water Street, Arepo, Ogun State, Nigeria. (LP 21 HQ Annex)</p>
              <a href="https://www.google.com/maps/search/?api=1&query=21+Pure+Water+Street+Arepo+Ogun+State+Nigeria" target="_blank" rel="noopener" class="btn btn-gold" style="width:100%; justify-content:center;">Get Directions on Google Maps</a>
            </div>
          </div> --}}
          
        </div>
      </div>
    </section>
  </main>
@endsection