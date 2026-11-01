Lestari Kota (PHP + HTML), termasuk modul Pilahin
Jalankan: di folder ini ketik  php -S localhost:8000  lalu buka http://localhost:8000
Atau salin folder ke htdocs (XAMPP) dan buka http://localhost/pilahin-php/
Ganti data contoh bank sampah di peta.php, data pemilah dan chatbot di assets/data.js
Peta, font, dan grafik memuat dari CDN, jadi butuh internet saat pertama dibuka.
Mode offline: service worker (sw.js) menyimpan halaman setelah dibuka sekali. Pakai localhost atau HTTPS agar aktif.
Rute di lalulintas.php dan titik bank sampah di peta.php adalah CONTOH: ganti dengan data kotamu (pakai Mode gambar rute untuk koordinat rute).
Gambar online: atur di includes/config.php (default LoremFlickr bertema; ganti dengan URL foto pilihanmu dan cantumkan sumbernya).
Asisten AI melayang tampil di semua halaman (assets/asisten.js), basis pengetahuan di assets/data.js.
