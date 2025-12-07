@extends('layouts.app')

@section('content')
<div class="page-container">

  <!-- CARD 1: left = explanation (kiri), right = 3D (kanan) -->
  <section class="card card-grid">
      <div class="col col-right">
      <div class="three-frame">
        <div id="3d-sate"
            class="three-canvas"
            data-model-url="{{ asset('models/sate.glb') }}"
            data-info-map='@json([
                "Object_4" => "Bagian dasar Monas — pondasi utama bangunan.",
                "Object_6" => "Bagian menara Monas — struktur vertikal utama.",
                "Object_8" => "Lidah api Monas — simbol semangat perjuangan."
            ])'
            style="width:100%; height:420px;">
        </div>
      </div>
    </div>
    <div class="col col-left">
      <div class="info-card">
        <h1 class="info-title">GEDUNG SATE</h1>
       <p class="info-text text-justify">
        Gedung Sate adalah bangunan bersejarah dengan gaya arsitektur hibrida Indo-Eropa yang kini berfungsi sebagai pusat pemerintahan Provinsi Jawa Barat di Kota Bandung. Didirikan pada tahun 1920 dengan nama asli Gouvernements Bedrijven, gedung ini terkenal karena ornamen tusuk sate pada menara sentralnya yang melambangkan biaya pembangunan sebesar enam juta Gulden. Selain menjadi ikon visual kota yang tak tergantikan, Gedung Sate memiliki nilai sejarah mendalam sebagai benteng pertahanan pemuda Indonesia melawan pasukan Gurkha pada masa kemerdekaan. Keindahan fasad dan tamannya yang terawat menjadikannya salah satu destinasi wisata warisan kolonial terpopuler di Bandung.
      </p>
      </div>
    </div>
  </section>

  <!-- CARD 2: left = horizontal photos, right = info details -->
  <section class="card card-grid reverse-on-large">
    <div class="col col-left">
      <div class="photo-strip-outer">
        <div class="photo-scroll" id="photo-row">
          <img src="/images/gedungsate.jpeg" class="photo-item" alt="">
          <img src="/images/gedungsate.jpg" class="photo-item" alt="">
          <img src="/images/gedungsate2.jpg" class="photo-item" alt="">
          <img src="/images/gedungsate3.jpg" class="photo-item" alt="">
          <img src="/images/gedungsate4.jpg" class="photo-item" alt="">
        </div>
      </div>
    </div>

    <aside class="col col-right">
      <div class="info-card">
        <h3 class="info-subtitle">Information</h3>
          <div class="info-grid">
            <div>Location</div>
            <div>: Jl. Diponegoro No.22, Citarum, Kec. Bandung Wetan, Kota Bandung, Jawa Barat 40115</div>
            <div>Opening Hours</div>
            <div>: 08.00 - 16.00 WIB (Selasa - Minggu, Area Museum)</div>
            <div>Ticket Price</div>
            <div>: Rp5.000 (Area Museum)</div>
          </div>
      </div>
    </aside>
  </section>

</div>
@endsection