@extends('layouts.app')

@section('content')
<div class="page-container">

  <!-- CARD 1: left = explanation (kiri), right = 3D (kanan) -->
  <section class="card card-grid">
      <div class="col col-right">
      <div class="three-frame">
        <div id="three-right" class="three-canvas"></div>
      </div>
    </div>
    <div class="col col-left">
      <div class="info-card">
        <h1 class="info-title">MONUMEN NASIONAL</h1>
       <p class="info-text text-justify">
          Monumen Nasional yang disingkat dengan Monas atau Tugu Monas adalah monumen peringatan setinggi 132 meter (433 kaki), 
          terletak tepat di tengah Lapangan Medan Merdeka, Jakarta Pusat. Monas didirikan untuk mengenang perlawanan dan perjuangan 
          rakyat Indonesia dalam merebut kemerdekaan dari pemerintahan kolonial Kerajaan Belanda. Pembangunan dimulai pada 17 Agustus 1961 
          di bawah perintah Presiden Soekarno dan diresmikan hingga dibuka untuk umum pada 12 Juli 1975 oleh Presiden Soeharto. 
          Tugu ini dimahkotai lidah api yang dilapisi lembaran emas yang melambangkan semangat perjuangan dari rakyat Indonesia.        
        </p>
        
      </div>
    </div>
  </section>

  <!-- CARD 2: left = horizontal photos, right = info details -->
  <section class="card card-grid reverse-on-large">
    <div class="col col-left">
      <div class="photo-strip-outer">
        <div class="photo-scroll" id="photo-row">
          <img src="/images/monas.jpg" class="photo-item" alt="">
          <img src="/images/monas.jpg" class="photo-item" alt="">
          <img src="/images/monas.jpg" class="photo-item" alt="">
          <img src="/images/monas.jpg" class="photo-item" alt="">
          <img src="/images/monas.jpg" class="photo-item" alt="">
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