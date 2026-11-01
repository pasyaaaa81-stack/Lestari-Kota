<?php $title='Edukasi';require 'includes/header.php';
$tips=[['Siapkan tiga wadah','Organik, anorganik yang bisa didaur ulang, dan residu atau B3. Beri label agar seisi rumah ikut.'],
['Bilas sebelum disimpan','Kemasan bersih tidak bau dan nilai jualnya lebih baik.'],
['Pisahkan B3','Baterai, lampu, dan obat kedaluwarsa jangan dicampur dengan sampah biasa.'],
['Kompos sisa makanan','Sisa makanan bisa jadi kompos sehingga sampah yang ke TPA berkurang.']];
$quiz=[
['q'=>'Baterai bekas termasuk jenis sampah apa?','o'=>['Organik','Residu','B3','Kertas'],'a'=>2,'e'=>'Baterai mengandung bahan berbahaya, jadi termasuk B3.'],
['q'=>'Kode plastik nomor 1 adalah jenis apa?','o'=>['PET','PVC','PS','LDPE'],'a'=>0,'e'=>'Kode 1 adalah PET, umum pada botol air mineral.'],
['q'=>'Sisa makanan paling baik diolah menjadi apa?','o'=>['Dibakar','Kompos','Dibuang ke sungai','Disetor sebagai plastik'],'a'=>1,'e'=>'Kompos mengembalikan nutrisi ke tanah dan mengurangi sampah.'],
['q'=>'Sampah organik yang menumpuk di TPA menghasilkan gas apa?','o'=>['Metana','Helium','Oksigen','Neon'],'a'=>0,'e'=>'Metana adalah gas rumah kaca yang kuat.'],
['q'=>'Langkah 3R yang paling utama adalah?','o'=>['Recycle','Reduce','Reuse','Replace'],'a'=>1,'e'=>'Mengurangi sampah sejak awal lebih baik daripada mengolahnya.'],
['q'=>'Bagaimana menangani kardus yang terkena minyak?','o'=>['Disetor utuh','Bagian berminyak dibuang ke residu','Dibakar','Dikubur'],'a'=>1,'e'=>'Kertas berminyak mengganggu proses daur ulang.']];?>
<?php hero_open('pilah'); ?><h1>Edukasi dan kuis</h1><p>Baca tips singkat, lalu uji pemahamanmu.</p></header>
<main class="one"><section><h2>Tips praktis</h2>
<?php foreach($tips as $t): ?><div class="res"><strong><?= htmlspecialchars($t[0]) ?></strong><br><?= htmlspecialchars($t[1]) ?></div><?php endforeach; ?></section>
<section id="quiz" aria-live="polite"></section></main>
<script>
const Q=<?= json_encode($quiz,JSON_UNESCAPED_UNICODE) ?>,box=document.getElementById('quiz');let i=0,s=0;
function show(){if(i>=Q.length){box.innerHTML='<h2>Skor kamu '+s+' dari '+Q.length+'</h2><button class="btn" id="again">Ulangi kuis</button>';
document.getElementById('again').onclick=()=>{i=0;s=0;show()};return}
const q=Q[i];box.innerHTML='<h2>Kuis '+(i+1)+' dari '+Q.length+'</h2><p>'+q.q+'</p><div class="opts"></div><p id="fb" class="sub"></p><div id="nx"></div>';let done=false;
q.o.forEach((t,k)=>{const b=document.createElement('button');b.className='chip';b.textContent=t;
b.onclick=()=>{if(done)return;done=true;if(k===q.a)s++;document.getElementById('fb').textContent=(k===q.a?'Benar. ':'Belum tepat. ')+q.e;
const n=document.createElement('button');n.className='btn';n.textContent=i<Q.length-1?'Pertanyaan berikutnya':'Lihat skor';n.onclick=()=>{i++;show()};document.getElementById('nx').append(n)};
box.querySelector('.opts').append(b)})}
show();
</script>
<?php require 'includes/footer.php';?>
