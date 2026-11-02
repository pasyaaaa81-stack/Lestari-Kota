Lestari Kota (HTML + CSS + JavaScript), termasuk modul Pilahin

STRUKTUR
  *.html                 10 halaman (index, lapor, pilah, peta, komunitas, dashboard,
                         kebakaran, lalulintas, edukasi, tentang)
  assets/css/style.css   gaya
  assets/js/             skrip; satu file per halaman + data.js, poin.js, asisten.js, main.js
  sw.js                  service worker (mode offline)

JALANKAN
  Cukup buka index.html di browser, atau lebih baik lewat server statis agar service worker aktif:
    python3 -m http.server 8000     lalu buka http://localhost:8000
  Bisa juga diunggah ke hosting statis apa pun (GitHub Pages, Netlify, dll.). Tanpa PHP.

DATA YANG BISA DIGANTI
  Bank sampah        : assets/js/peta.js (array B)
  Komunitas          : assets/js/komunitas.js (array D)
  Rute dan lokasi    : assets/js/lalulintas.js (PL = lokasi, RS = rute, M = moda)
  Pemilah dan chatbot: assets/js/data.js (ITEMS dan KB)
  Kuis               : assets/js/edukasi.js (array Q)
  Kategori laporan   : <select id="kt"> di lapor.html

CATATAN
  Peta dasar memakai tile Google Maps (assets/js/basemap.js, ada pilihan Jalan/Satelit/Hybrid dan cadangan CARTO). Peta, font, dan grafik memuat dari CDN, jadi butuh internet saat pertama dibuka.
  Gambar hero memakai LoremFlickr (online). Ganti URL pada atribut --bg di tiap halaman
  (style="--bg:url(...)") dengan foto pilihanmu dan cantumkan sumbernya di tentang.html.
  Menu, footer, dan blok "Lanjut jelajahi" sekarang ditulis langsung di tiap file HTML.
  Jika menambah menu atau halaman, ubah di semua file HTML.
  Titik rute dan bank sampah adalah CONTOH.
