@extends('layouts.app')

@section('content')
<div class="page-container">

  <!-- CARD 1: left = explanation (kiri), right = 3D (kanan) -->
  <section class="card card-grid">
      <div class="col col-right">
      <div class="three-frame">
        <div id="3d-surabaya"
            class="three-canvas"
            data-model-url="{{ asset('models/surabaya.glb') }}"
            data-info-map='@json([
                "Cube_Material007_0_1" => "Baya: Sang Buaya",
                "Cube_Material007_0" => "Sura: Sang Ikan Hiu",
                
            ])'
            style="width:100%; height:420px;">
        </div>
      </div>
    </div>
    <div class="col col-left">
      <div class="info-card">
        <h1 class="info-title">MONUMEN SURA DAN BAYA</h1>
        <p class="info-text text-justify">
          Monumen Sura dan Baya adalah patung yang menjadi lambang Kota Surabaya. Monumen ini menggambarkan pertarungan antara seekor hiu (Sura) dan seekor buaya (Baya), yang melatarbelakangi cerita rakyat tentang asal-usul nama kota tersebut.
        </p>
        <p class="info-text text-justify">
          Monumen ini terletak di depan Kebun Binatang Surabaya. Patung ini memiliki makna filosofis tentang keberanian pemuda-pemuda Surabaya dalam menghadapi bahaya dan tantangan.
        </p>
      </div>
    </div>
  </section>

  <!-- CARD 2: left = horizontal photos, right = info details -->
  <section class="card card-grid reverse-on-large">
    <div class="col col-left">
      <div class="photo-strip-outer">
        <div class="photo-scroll" id="photo-row">
          <img src="/images/patungsurabaya.jpg" class="photo-item" alt="">
          <img src="/images/patungsurabaya2.jpg" class="photo-item" alt="">
          <img src="/images/patungsurabaya3.jpg" class="photo-item" alt="">
          <img src="/images/patungsurabaya4.jpg" class="photo-item" alt="">
          <img src="/images/patungsurabaya5.jpg" class="photo-item" alt="">
        </div>
      </div>
    </div>

    <aside class="col col-right">
      <div class="info-card">
        <h3 class="info-subtitle">Information</h3>
          <div class="info-grid">
            <div>Location</div>
            <div>: Jl. Diponegoro No.1-B, Darmo, Kec. Wonokromo, Kota Surabaya, Jawa Timur 60241</div>
            <div>Opening Hours</div>
            <div>: 24 Jam (Area Publik)</div>
            <div>Ticket Price</div>
            <div>: -</div>
          </div>
      </div>
    </aside>
  </section>

</div>
@endsection