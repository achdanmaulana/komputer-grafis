@extends('layouts.app')

@section('content')
<section class="hero-header relative overflow-hidden">

    <div class="hero-overlay absolute inset-0"></div>
    <div class="relative max-w-7xl mx-auto px-6 py-16 grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
        <!-- LEFT TEXT -->
        <div class="flex ">
            <div class="hero-info w-full">
                <h2 class="hero-title">What is NusaVirland</h2>
                <p class="hero-sub mt-4">
                    NusaVirland is an interactive web-based platform that showcases Indonesia's iconic landmarks 
                    through immersive 3D visualization. Users can explore a digital map of Indonesia, select landmarks, 
                    and learn about their history and cultural significance in a modern, interactive way.
                </p>
            </div>
        </div>

        <!-- RIGHT IMAGE -->
        <div class="col-12">
          <div class="card-photo-container">
            <img src="/images/monas.jpg" alt="Monas" class="card-photo-image">
          </div>
        </div>
    </div>
</section>

<section class="max-w-7xl mx-auto px-6 py-12">
  <h2 class="text-3xl font-bold text-center mb-8">Explore the Landmark</h2>
            <img src="/images/map.png" class="map-image">
  <div id="culture" class="culture-row">
    <a href="/explore-monas" id="card-monas" class="culture-card">
      <img src="/images/monas.jpg" class="card-image" alt="Monumen Nasional">
      <div class="card-bottom">
        <div class="card-title">MONUMEN NASIONAL</div>
        <div class="card-meta">JAKARTA</div>
      </div>
    </a>

    <div class="culture-card">
      <a href="/explore-gedungsate" id="card-monas" class="culture-card">
        <img src="/images/gedungsate.jpeg" class="card-image" alt="Gedung Sate">
        <div class="card-bottom">
          <div class="card-title">GEDUNG SATE</div>
          <div class="card-meta">BANDUNG</div>
        </div>
      </a>
    </div>

    <div class="culture-card">
      <a href="/explore-borobudur" id="card-monas" class="culture-card">
        <img src="/images/borobudur.jpg" class="card-image" alt="Borobudur">
        <div class="card-bottom">
          <div class="card-title">BOROBUDUR TEMPLE</div>
          <div class="card-meta">YOGYAKARTA</div>
        </div>
      </a>
    </div>
        <div class="culture-card">
      <a href="/explore-ampera" id="card-monas" class="culture-card">
        <img src="/images/ampera.jpg" class="card-image" alt="Gedung Sate">
        <div class="card-bottom">
          <div class="card-title">JEMBATAN AMPERA</div>
          <div class="card-meta">PALEMBANG</div>
        </div>
      </a>
    </div>

        <div class="culture-card">
      <a href="/explore-lawangsewu" id="card-monas" class="culture-card">
        <img src="/images/lawangsewu.jpg" class="card-image" alt="Gedung Sate">
        <div class="card-bottom">
          <div class="card-title">LAWANG SEWU</div>
          <div class="card-meta">SEMARANG</div>
        </div>
      </a>
    </div>

        <div class="culture-card">
      <a href="/explore-surabaya" id="card-monas" class="culture-card">
        <img src="/images/patungsurabaya.jpg" class="card-image" alt="Gedung Sate">
        <div class="card-bottom">
          <div class="card-title">PATUNG SURABAYA</div>
          <div class="card-meta">SURABAYA</div>
        </div>
      </a>
    </div>
  </div>

  
</section>
@endsection
