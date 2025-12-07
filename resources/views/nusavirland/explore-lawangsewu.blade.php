@extends('layouts.app')

@section('content')
<div class="page-container">

  <!-- CARD 1: left = explanation (kiri), right = 3D (kanan) -->
  <section class="card card-grid">
      <div class="col col-right">
      <div class="three-frame">
        <div id="3d-lawangsewu" class="three-canvas"></div>
      </div>
    </div>
    <div class="col col-left">
      <div class="info-card">
        <h1 class="info-title">LAWANG SEWU</h1>
        <p class="info-text text-justify">
          Lawang Sewu adalah gedung megah di Semarang yang dahulu berfungsi sebagai kantor pusat perusahaan kereta api swasta Hindia Belanda, Nederlands-Indische Spoorweg Maatschappij (NIS). Bangunan yang mulai dibangun pada tahun 1904 ini dijuluki "Lawang Sewu" atau Seribu Pintu oleh masyarakat setempat karena memiliki jumlah pintu dan jendela yang sangat banyak untuk sirkulasi udara. Selain arsitekturnya yang memukau dengan kaca patri warna-warni, gedung ini menyimpan sejarah panjang, mulai dari masa kejayaan perkeretaapian hingga menjadi saksi bisu pertempuran heroik lima hari di Semarang melawan tentara Jepang. Kini gedung ini telah dipugar menjadi museum.
        </p>
      </div>
    </div>
  </section>

  <!-- CARD 2: left = horizontal photos, right = info details -->
  <section class="card card-grid reverse-on-large">
    <div class="col col-left">
      <div class="photo-strip-outer">
        <div class="photo-scroll" id="photo-row">
          <img src="/images/lawangsewu.jpg" class="photo-item" alt="">
          <img src="/images/lawangsewu2.jpg" class="photo-item" alt="">
          <img src="/images/lawangsewu3.jpg" class="photo-item" alt="">
          <img src="/images/lawangsewu4.jpg" class="photo-item" alt="">
          <img src="/images/lawangsewu5.jpg" class="photo-item" alt="">
        </div>
      </div>
    </div>

    <aside class="col col-right">
      <div class="info-card">
        <h3 class="info-subtitle">Information</h3>
          <div class="info-grid">
            <div>Location</div>
            <div>: Jl. Pemuda, Sekayu, Kec. Semarang Tengah, Kota Semarang, Jawa Tengah 50132</div>
            <div>Opening Hours</div>
            <div>: 08.00 - 17.00 WIB (Senin - Jumat) / 08.00 - 20.00 WIB (Sabtu - Minggu)</div>
            <div>Ticket Price</div>
            <div>: Rp10.000 (Pelajar) / Rp20.000 (Dewasa)</div>
          </div>
      </div>
    </aside>
  </section>

</div>
@endsection