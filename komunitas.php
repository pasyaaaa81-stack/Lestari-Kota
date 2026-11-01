<?php $title='Komunitas';require 'includes/header.php';
$fokus=['Bersih-bersih','Plastik','Advokasi','Laut','Konservasi'];
// nama, basis, fokus, deskripsi, tautan resmi (kosong = pakai pencarian). Ringkasan umum: verifikasi ke sumber resmi sebelum dikutip.
$kom=[
['Pandawara Group','Bandung, Jawa Barat','Bersih-bersih','Komunitas lima pemuda asal Bandung yang dikenal lewat aksi bersih-bersih sungai, pantai, dan ruang publik yang didokumentasikan di media sosial.','https://www.instagram.com/pandawaragroup/'],
['Sungai Watch','Bali','Bersih-bersih','Organisasi di Bali yang memasang penghalang sampah di sungai dan mengumpulkan data sampah plastik.',''],
['Trash Hero Indonesia','Beberapa daerah','Bersih-bersih','Cabang gerakan relawan Trash Hero yang mengadakan bersih-bersih rutin dan edukasi sampah.',''],
['Bye Bye Plastic Bags','Bali','Plastik','Gerakan anak muda dari Bali yang mengampanyekan pengurangan kantong plastik sekali pakai.',''],
['Gerakan Indonesia Diet Kantong Plastik','Nasional','Plastik','Gerakan yang mengajak masyarakat mengurangi penggunaan kantong plastik sekali pakai.',''],
['Divers Clean Action','Nasional','Laut','Komunitas penyelam yang membersihkan sampah dan mengedukasi soal sampah laut.',''],
['WALHI','Nasional','Advokasi','Wahana Lingkungan Hidup Indonesia, jaringan organisasi advokasi lingkungan yang berdiri sejak 1980.',''],
['Greenpeace Indonesia','Nasional','Advokasi','Cabang organisasi lingkungan global yang berkampanye soal hutan, iklim, dan polusi plastik.',''],
['Yayasan KEHATI','Nasional','Konservasi','Yayasan yang bergerak di bidang pelestarian keanekaragaman hayati.','']];?>
<?php hero_open('komunitas'); ?><h1>Komunitas lingkungan Indonesia</h1><p>Kenali komunitas yang peduli lingkungan, pelajari fokus kerjanya, dan ikuti kegiatannya lewat kanal resmi mereka.</p></header>
<main class="one">
<section><input id="s" type="search" placeholder="Cari komunitas atau kota" aria-label="Cari"><div class="chips" id="flt"></div><div id="ls" style="display:flex;flex-direction:column;gap:10px" aria-live="polite"></div>
<p class="sub">Ringkasan bersifat umum. Verifikasi ke situs atau media sosial resmi sebelum dikutip. Tautan tanpa akun resmi memakai pencarian.</p></section>
<section><h2>Cara bergabung</h2>
<div class="res">Ikuti media sosial resmi komunitas dan tunggu pengumuman kegiatan.</div>
<div class="res">Daftar lewat formulir relawan yang mereka sediakan, bukan lewat pesan dari akun tidak dikenal.</div>
<div class="res">Mulai dari komunitas di kotamu, lalu bawa sarung tangan, air minum, dan wadah sendiri.</div>
<div class="res">Utamakan keselamatan: perhatikan cuaca, arus sungai, dan benda tajam.</div></section>
</main>
<script>
const D=<?= json_encode($kom,JSON_UNESCAPED_UNICODE) ?>,F=<?= json_encode($fokus,JSON_UNESCAPED_UNICODE) ?>,$=s=>document.querySelector(s);let f=null;
function draw(){const q=$('#s').value.toLowerCase(),box=$('#ls');box.innerHTML='';
D.filter(c=>(!f||c[2]===f)&&(c[0]+' '+c[1]).toLowerCase().includes(q)).forEach(c=>{const d=document.createElement('div'),u=c[4]||'https://www.google.com/search?q='+encodeURIComponent(c[0]+' komunitas lingkungan');
d.className='res';d.innerHTML='<b class="cat">'+c[2]+'</b> <strong>'+c[0]+'</strong><br><small>'+c[1]+'</small><br>'+c[3]+'<br><a target="_blank" rel="noopener" href="'+u+'">'+(c[4]?'Instagram resmi':'Cari info resmi')+'</a>';box.append(d)});
if(!box.children.length)box.innerHTML='<p class="sub">Tidak ada komunitas yang cocok.</p>'}
F.forEach(t=>{const b=document.createElement('button');b.className='chip';b.textContent=t;b.onclick=()=>{f=f===t?null:t;document.querySelectorAll('#flt .chip').forEach(x=>x.classList.toggle('on',x.textContent===f));draw()};$('#flt').append(b)});
$('#s').oninput=draw;draw();
</script>
<?php require 'includes/footer.php';?>
