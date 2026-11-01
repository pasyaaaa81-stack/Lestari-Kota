<?php $title='Siaga';require 'includes/header.php';
$ispu=[['Baik (0-50)','Udara aman. Kamu bisa beraktivitas di luar ruangan seperti biasa.'],
['Sedang (51-100)','Kelompok sensitif seperti anak, lansia, ibu hamil, dan penderita asma atau jantung sebaiknya mengurangi aktivitas berat di luar.'],
['Tidak sehat (101-200)','Kurangi aktivitas di luar ruangan dan pakai masker saat keluar. Kelompok sensitif sebaiknya tetap di dalam ruangan.'],
['Sangat tidak sehat (201-300)','Hindari aktivitas di luar ruangan, tutup jendela, dan pakai masker N95 atau KN95 bila terpaksa keluar. Periksakan diri jika muncul gejala.'],
['Berbahaya (301 ke atas)','Tetap di dalam ruangan, ikuti arahan BPBD dan pemerintah daerah, dan segera ke fasilitas kesehatan bila sesak napas.']];
$cek=['Alat pemadam (APAR) tersedia dan tidak kedaluwarsa','Detektor asap terpasang dan berfungsi','Seisi rumah tahu jalur evakuasi dan titik kumpul','Nomor darurat 112 dan 113 tersimpan di ponsel','Tidak ada colokan bertumpuk atau kabel terkelupas','Selang dan regulator gas dicek berkala','Tas siaga siap (dokumen, obat, senter, air)','Pernah berlatih evakuasi bersama keluarga'];?>
<?php hero_open('siaga'); ?><h1>Siaga kebakaran dan kabut asap</h1><p>Panduan umum untuk kebakaran rumah, kebakaran hutan dan lahan (karhutla), dan kualitas udara. Tidak menggantikan arahan petugas.</p></header>
<main class="one">
<section><h2>Darurat: hubungi 113 atau 112</h2><p class="sub">113 adalah nomor pemadam kebakaran dan 112 adalah nomor darurat nasional. Hubungi dari tempat yang aman, jangan dari dalam bangunan yang terbakar.</p></section>
<section><h2>Cek kualitas udara (ISPU)</h2><p class="sub">Lihat angka ISPU dari sumber resmi KLHK atau BMKG, lalu pilih kategorinya.</p>
<select id="is" aria-label="Kategori ISPU"><option value="">Pilih kategori ISPU</option><?php foreach($ispu as $i=>$x) echo "<option value=\"$i\">{$x[0]}</option>"; ?></select><div id="ir" class="res" aria-live="polite">Saran tindakan muncul di sini.</div></section>
<section><h2>Jika terjadi kebakaran</h2>
<details><summary>Di rumah atau gedung</summary><p>Peringatkan orang di sekitar. Keluar lewat jalur terdekat sambil merunduk di bawah asap. Jangan pakai lift. Tutup pintu di belakangmu untuk menahan api. Jangan kembali masuk untuk mengambil barang. Hubungi 113 atau 112 dari tempat aman.</p></details>
<details><summary>Api di wajan atau minyak</summary><p>Matikan kompor, tutup wajan dengan penutup atau lap basah yang diperas. Jangan disiram air karena minyak akan memercik.</p></details>
<details><summary>Gas bocor</summary><p>Jangan menyalakan api atau saklar listrik. Tutup regulator, buka pintu dan jendela, lalu menjauh dan hubungi bantuan.</p></details>
<details><summary>Karhutla: pencegahan dan pelaporan</summary><p>Jangan membuka lahan dengan membakar. Padamkan puntung rokok sepenuhnya. Jangan membuang kaca atau botol di semak kering. Laporkan titik api ke BPBD atau 112. Api di lahan gambut sangat sulit dipadamkan, jadi pencegahan jauh lebih penting.</p></details></section>
<section><h2>Cek kesiapsiagaan rumah</h2><div id="ck"></div><p><strong id="sc"></strong></p></section>
</main>
<script>
const I=<?= json_encode($ispu,JSON_UNESCAPED_UNICODE) ?>,C=<?= json_encode($cek,JSON_UNESCAPED_UNICODE) ?>,$=s=>document.querySelector(s),COL=['#3FA796','#9BC53D','#F2C230','#E07A5F','#B03A2E'];
$('#is').onchange=e=>{const r=$('#ir'),i=e.target.value;if(i===''){r.textContent='Saran tindakan muncul di sini.';return}r.textContent=I[i][1];r.style.borderLeftColor=COL[i]};
let st=[];try{st=JSON.parse(localStorage.getItem('pilahin_cek'))||[]}catch(e){}
function sc(){const n=C.filter((_,i)=>st[i]).length;$('#sc').textContent='Skor: '+n+' dari '+C.length+' ('+(n>=7?'Siap siaga':n>=4?'Cukup siap':'Perlu ditingkatkan')+')'}
C.forEach((t,i)=>{const l=document.createElement('label');l.className='ck';l.innerHTML='<input type="checkbox"'+(st[i]?' checked':'')+'> <span>'+t+'</span>';
l.firstChild.onchange=e=>{st[i]=e.target.checked;try{localStorage.setItem('pilahin_cek',JSON.stringify(st))}catch(x){}sc()};$('#ck').append(l)});sc();
</script>
<?php require 'includes/footer.php';?>
