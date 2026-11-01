<?php $title='Beranda';$dl=1;require 'includes/header.php';?>
<header class="hero"><div>
<h1>Kota lestari dimulai dari <em>kebiasaan kita</em></h1>
<p>Satu platform untuk lingkungan dan kota yang lebih sehat: lapor sampah, kenali komunitas lingkungan, siaga kebakaran, dan temukan jalur alternatif bebas macet. Gratis dan bisa dipakai tanpa internet.</p>
<div class="sdg"><span>SDG 3</span><span>SDG 11</span><span>SDG 12</span><span>SDG 13</span><span>SDG 15</span><span>SDG 17</span></div>
<div class="cta"><a class="btn" href="lapor.php">Lapor sampah</a><a class="btn alt" href="komunitas.php">Lihat komunitas</a></div></div>
<svg viewBox="0 0 360 300" role="img" aria-label="Tiga tempat sampah: organik, daur ulang, dan B3">
<circle cx="180" cy="150" r="140" fill="var(--chip)"/><ellipse cx="180" cy="248" rx="130" ry="9" fill="#0F5C50" opacity=".18"/>
<circle class="fall" cx="180" cy="40" r="11" fill="var(--brand)"/>
<rect x="50" y="130" width="70" height="112" rx="10" fill="#0F5C50"/><rect x="44" y="116" width="82" height="16" rx="6" fill="#3FA796"/>
<rect x="145" y="108" width="70" height="134" rx="10" fill="#F2C230"/><rect x="139" y="94" width="82" height="16" rx="6" fill="#C79A0B"/>
<rect x="240" y="140" width="70" height="102" rx="10" fill="#E07A5F"/><rect x="234" y="126" width="82" height="16" rx="6" fill="#B85A42"/>
<g font-family="Figtree,sans-serif" font-weight="700" font-size="12" text-anchor="middle">
<text x="85" y="192" fill="#fff">Organik</text><text x="180" y="180" fill="#2A2200">Daur</text><text x="180" y="196" fill="#2A2200">ulang</text><text x="275" y="196" fill="#2A1008">B3</text></g></svg>
</header>
<div class="wrap">
<div class="stat"><div><strong id="n1">0</strong>jenis barang dikenali</div><div><strong id="n2">0</strong>jawaban asisten</div><div><strong>6</strong>modul aksi</div><div><strong>0</strong>API eksternal</div></div>
<div class="sec-h"><h2>Enam cara untuk beraksi</h2><p class="sub">Pilih yang paling kamu butuhkan hari ini. Semuanya terhubung lewat poin reward.</p></div>
<div class="grid3">
<a class="card" style="--c:#0F5C50" href="lapor.php"><span class="ico"><?= ic('pin') ?></span><h3>Lapor sampah</h3><p>Tandai sampah liar di peta, kirim foto, dan pantau statusnya sampai selesai.</p><span class="go">Buka</span></a>
<a class="card" style="--c:#0F5C50" href="pilah.php"><span class="ico"><?= ic('loop') ?></span><h3>Pilah dan tanya</h3><p>Cari cara memilah, perkiraan nilai, dan tanya asisten kapan saja.</p><span class="go">Buka</span></a>
<a class="card" style="--c:#0F5C50" href="peta.php"><span class="ico"><?= ic('bank') ?></span><h3>Bank sampah</h3><p>Temukan bank sampah untuk menukar sampah terpilah menjadi reward.</p><span class="go">Buka</span></a>
<a class="card" style="--c:#4C9F38" href="komunitas.php"><span class="ico"><?= ic('users') ?></span><h3>Komunitas lingkungan</h3><p>Kenali komunitas seperti Pandawara Group dan cara mengikuti kegiatannya.</p><span class="go">Buka</span></a>
<a class="card" style="--c:#D0482F" href="kebakaran.php"><span class="ico"><?= ic('flame') ?></span><h3>Siaga kebakaran</h3><p>Panduan darurat kebakaran, karhutla, dan kabut asap, plus cek kesiapsiagaan.</p><span class="go">Buka</span></a>
<a class="card" style="--c:#3A7CB8" href="lalulintas.php"><span class="ico"><?= ic('route') ?></span><h3>Jalur alternatif</h3><p>Pilih asal, tujuan, dan kendaraan. Lihat jalur bebas macet yang boleh dilewati.</p><span class="go">Buka</span></a>
</div>
<div class="alert"><strong>Darurat kebakaran?</strong> Hubungi 113 (pemadam) atau 112 (darurat nasional). <a href="kebakaran.php">Buka panduan siaga</a></div>
<div class="sec-h"><h2>Cara kerjanya</h2></div>
<div class="grid3">
<div class="stp"><span class="n">1</span><h3>Lapor atau pilah</h3><p>Laporkan sampah liar atau pilah sampah rumahmu dengan panduan.</p></div>
<div class="stp"><span class="n">2</span><h3>Pantau dan setor</h3><p>Lihat status laporan, lalu setor sampah terpilah ke bank sampah.</p></div>
<div class="stp"><span class="n">3</span><h3>Dapat reward</h3><p>Kumpulkan poin dan lencana, lalu tukar dengan hadiah dan lihat dampaknya.</p></div></div>
<div class="sec-h"><h2>Bergabung dengan komunitas</h2><p class="sub">Kenali gerakan lingkungan di Indonesia dan ikuti kegiatannya lewat kanal resmi mereka.</p></div>
<div class="chips"><a class="chip" href="komunitas.php">Pandawara Group</a><a class="chip" href="komunitas.php">Sungai Watch</a><a class="chip" href="komunitas.php">Trash Hero Indonesia</a><a class="chip" href="komunitas.php">WALHI</a><a class="chip" href="komunitas.php">Lihat semua</a></div>
<div class="sec-h"><h2>Selaras dengan SDGs</h2></div>
<div class="grid3">
<section class="sdgc" style="--c:#4C9F38"><h2>SDG 3</h2><p class="sub">Kesehatan: panduan menghadapi kabut asap dan keselamatan dari kebakaran.</p></section>
<section class="sdgc" style="--c:#FD9D24"><h2>SDG 11</h2><p class="sub">Kota berkelanjutan: peta bank sampah, kesiapsiagaan, dan mobilitas lebih lancar.</p></section>
<section class="sdgc" style="--c:#BF8B2E"><h2>SDG 12</h2><p class="sub">Konsumsi bertanggung jawab: pemilahan, kompos, dan daur ulang.</p></section>
<section class="sdgc" style="--c:#3F7E44"><h2>SDG 13</h2><p class="sub">Aksi iklim: estimasi CO₂ dari sampah dan dari pilihan moda transportasi.</p></section>
<section class="sdgc" style="--c:#56C02B"><h2>SDG 15</h2><p class="sub">Ekosistem darat: pencegahan karhutla dan kegiatan tanam pohon.</p></section>
<section class="sdgc" style="--c:#19486A"><h2>SDG 17</h2><p class="sub">Kemitraan: komunitas, warga, dan pemerintah bergerak bersama.</p></section>
</div>
<div class="cta-band"><h2>Mulai dari satu laporan</h2><p>Satu foto dan satu lokasi bisa membuat lingkunganmu lebih bersih.</p><div class="cta" style="justify-content:center"><a class="btn alt" href="lapor.php">Lapor sampah sekarang</a></div></div>
</div>
<script src="assets/data.js"></script>
<script>
function up(id,to){const e=document.getElementById(id);let v=0;const t=setInterval(()=>{v+=Math.ceil(to/25);if(v>=to){v=to;clearInterval(t)}e.textContent=v},40)}
up('n1',ITEMS.length);up('n2',KB.length);
</script>
<?php require 'includes/footer.php';?>
