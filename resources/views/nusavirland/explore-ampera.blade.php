@extends('layouts.app')

@section('content')
<div class="page-container">

  <!-- CARD 1: left = explanation (kiri), right = 3D (kanan) -->
  <section class="card card-grid">
      <div class="col col-right">
      <div class="three-frame">
        <div id="3d-ampera"
            class="three-canvas"
            data-model-url="{{ asset('models/ampera.glb') }}"
            data-info-map='@json([
                "Cube_MERAH_0" => "Kerangka Jembatan.",
                "Cube_HITAM_0" => "Kerangka Jembatan.",
                "Cube_HIJAU2_0" => "Kerangka Jembatan."
            ])'
            style="width:100%; height:420px;">
        </div>
      </div>
    </div>
    <div class="col col-left">
      <div class="info-card">
        <h1 class="info-title">JEMBATAN AMPERA</h1>
        <p class="info-text text-justify">
        Jembatan Ampera adalah sebuah mahakarya infrastruktur yang membentang gagah di atas Sungai Musi, menghubungkan daerah Seberang Ulu dan Seberang Ilir di Kota Palembang. Pembangunan jembatan ini dimulai pada April 1962 dengan dana pampasan perang Jepang dan awalnya diberi nama Jembatan Bung Karno sebagai bentuk penghormatan. Namun, seiring pergolakan politik tahun 1966, namanya diubah menjadi Ampera yang merupakan akronim dari Amanat Penderitaan Rakyat. Keunikan utamanya terletak pada dua menara setinggi 63 meter dan bagian tengah jembatan yang dulunya dapat diangkat secara mekanis agar kapal-kapal besar bisa melintas di bawahnya.
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
          <img src="/images/ampera1.jpg" class="photo-item" alt="">
          <img src="/images/ampera2.jpg" class="photo-item" alt="">
          <img src="/images/ampera3.jpg" class="photo-item" alt="">
          <img src="/images/ampera4.jpg" class="photo-item" alt="">
        </div>
      </div>
    </div>

    <aside class="col col-right">
      <div class="info-card">
        <h3 class="info-subtitle">Information</h3>
          <div class="info-grid">
            <div>Location</div>
            <div>: Jl. Sultan Mahmud Badaruddin II, 9 Ilir, Bukit Kecil, Kota Palembang, Sumatera Selatan</div>
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