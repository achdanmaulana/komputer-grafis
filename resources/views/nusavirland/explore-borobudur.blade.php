@extends('layouts.app')

@section('content')
<div class="page-container">

  <!-- CARD 1: left = explanation (kiri), right = 3D (kanan) -->
  <section class="card card-grid">
      <div class="col col-right">
      <div class="three-frame">
        <div id="3d-monas"
            class="three-canvas"
            data-model-url="{{ asset('models/borobudur.glb') }}"
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
        <h1 class="info-title">CANDI BOROBUDUR</h1>
        <p class="info-text text-justify">
        Candi Borobudur adalah monumen Buddha terbesar di dunia yang terletak di Magelang, Jawa Tengah, dan telah diakui secara global sebagai Situs Warisan Dunia UNESCO. Dibangun pada abad ke-9 masa pemerintahan Wangsa Syailendra, candi ini dirancang dengan arsitektur punden berundak megah yang terdiri dari enam teras bujur sangkar dan tiga pelataran melingkar. Bangunan ini dihiasi dengan 2.672 panel relief batu dan 504 arca Buddha, serta dimahkotai stupa induk besar. Sempat terkubur abu vulkanik selama berabad-abad, Borobudur kini berdiri sebagai simbol kejayaan arsitektur nusantara dan tempat ziarah keagamaan yang suci bagi umat Buddha.
        </p>
      </div>
    </div>
  </section>

  <!-- CARD 2: left = horizontal photos, right = info details -->
  <section class="card card-grid reverse-on-large">
    <div class="col col-left">
      <div class="photo-strip-outer">
        <div class="photo-scroll" id="photo-row">
          <img src="/images/borobudur.jpg" class="photo-item" alt="">
          <img src="/images/borobudur2.jpg" class="photo-item" alt="">
          <img src="/images/borobudur3.jpg" class="photo-item" alt="">
          <img src="/images/borobudur4.jpg" class="photo-item" alt="">
          <img src="/images/borobudur5.jpg" class="photo-item" alt="">
        </div>
      </div>
    </div>

    <aside class="col col-right">
      <div class="info-card">
        <h3 class="info-subtitle">Information</h3>
          <div class="info-grid">
            <div>Location</div>
            <div>: Jl. Badrawati, Kec. Borobudur, Kabupaten Magelang, Jawa Tengah</div>
            <div>Opening Hours</div>
            <div>: 06.30 - 16.30 WIB</div>
            <div>Ticket Price</div>
            <div>: Rp50.000 (Domestik) / Rp375.000 (Mancanegara)</div>
          </div>
      </div>
    </aside>
  </section>

</div>
@endsection