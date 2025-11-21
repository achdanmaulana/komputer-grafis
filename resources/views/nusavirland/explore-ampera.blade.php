@extends('layouts.app')

@section('content')
<div class="page-container">

  <!-- CARD 1: left = explanation (kiri), right = 3D (kanan) -->
  <section class="card card-grid">
      <div class="col col-right">
      <div class="three-frame">
        <div id="3d-ampera" class="three-canvas"></div>
      </div>
    </div>
    <div class="col col-left">
      <div class="info-card">
        <h1 class="info-title">MONUMEN NASIONAL</h1>
        <p class="info-text">
          Monumen Nasional yang disingkat Monas adalah monumen peringatan setinggi 132 meter (433 kaki) yang terletak di Lapangan Medan Merdeka, Jakarta Pusat. Monas didirikan untuk mengenang perjuangan rakyat Indonesia merebut kemerdekaan.
        </p>
        <p class="info-text">
          Pembangunan dimulai pada 17 Agustus 1961 di bawah perintah Presiden Soekarno dan diresmikan pada 12 Juli 1975.
        </p>
      </div>
    </div>
  </section>

  <!-- CARD 2: left = horizontal photos, right = info details -->
  <section class="card card-grid reverse-on-large">
    <div class="col col-left">
      <div class="photo-strip-outer">
        <div class="photo-scroll" id="photo-row">
          <img src="/images/ampera.jpg" class="photo-item" alt="">
          <img src="/images/ampera.jpg" class="photo-item" alt="">
          <img src="/images/ampera.jpg" class="photo-item" alt="">
          <img src="/images/ampera.jpg" class="photo-item" alt="">
          <img src="/images/ampera.jpg" class="photo-item" alt="">
        </div>
      </div>
    </div>

    <aside class="col col-right">
      <div class="info-card">
        <h3 class="info-subtitle">Information</h3>
          <div class="info-grid">
            <div>Location</div>
            <div>: Merdeka Square, Jakarta, Jalan Lapangan Monas, Gambir, Central Jakarta City, Jakarta 10110</div>
            <div>Opening Hours</div>
            <div>: 08.00-16.00 WIB (sesi 1) / 19.00-22.00 WIB (sesi 2)</div>
            <div>Ticket Price</div>
            <div>: -</div>
          </div>
      </div>
    </aside>
  </section>

</div>
@endsection