<?php $title='Pilah';$dl=1;$noai=1;require 'includes/header.php';?>
<?php hero_open('pilah'); ?><h1>Pilah dan tanya</h1><p>Ketik nama barang atau ajukan pertanyaan. Semua berjalan di browser, tanpa API.</p></header>
<main>
<section aria-labelledby="t1">
<h2 id="t1">Pemilah sampah</h2>
<p class="sub">Cari barang, lalu hitung nilainya.</p>
<input id="q" type="search" placeholder="Contoh: botol air mineral, baterai, kardus" aria-label="Nama barang">
<div class="chips" id="cq"></div>
<div id="out" class="res" aria-live="polite">Hasil pemilahan muncul di sini.</div>
<div class="row"><input id="kg" type="number" min="0" step="0.1" value="1" aria-label="Berat dalam kilogram"><button class="btn" id="hit">Hitung</button></div>
<div class="stat"><div><strong id="rp">Rp 0</strong>perkiraan nilai</div><div><strong id="co">0 kg</strong>CO₂ dihindari</div></div>
<div class="row"><button class="btn" id="save" type="button">Simpan ke dashboard</button></div>
<p class="sub">Angka harga dan emisi adalah perkiraan untuk prototipe. Verifikasi dengan data bank sampah setempat dan KLHK sebelum dipakai di proposal.</p>
</section>
<section aria-labelledby="t2">
<h2 id="t2">Tanya asisten</h2>
<p class="sub">Asisten berbasis kata kunci dari basis pengetahuan lokal.</p>
<div id="chat" aria-live="polite"></div>
<form id="f" class="row" onsubmit="return false"><input id="in" placeholder="Tulis pertanyaan…" aria-label="Pertanyaan"><button class="btn" id="send" type="button">Kirim</button></form>
<div class="chips" id="cc"></div>
</section>
</main>
<script src="assets/data.js"></script><script src="assets/pilah.js"></script>
<?php require 'includes/footer.php';?>
