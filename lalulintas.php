<?php $title='Mobilitas';require 'includes/header.php';
// nama, km/jam normal, km/jam jam sibuk, biaya per km (Rp), kg CO2 per km per orang, jarak maksimal (km). SEMUA ANGKA ADALAH ASUMSI.
$modes=[['Mobil pribadi',30,15,1000,0.17,999],['Nebeng 3 orang',30,15,333,0.057,999],['Motor',35,22,250,0.08,999],['Angkutan umum',25,16,400,0.06,999],['Sepeda',12,12,0,0,12],['Jalan kaki',5,5,0,0,3]];
// DATA CONTOH (ILUSTRASI). Ganti lokasi dan jalur dengan data kotamu memakai Mode gambar rute.
$places=[['T','Terminal Kota (contoh)',-5.4400,105.2500],['P','Pasar Induk (contoh)',-5.4150,105.2550],['K','Kampus Utama (contoh)',-5.3900,105.2900]];
// kunci 'asal|tujuan' => jalur: nama, tipe, koordinat, kendaraan yang boleh, hemat menit (perkiraan), catatan
$routes=['T|K'=>[
['Jalur utama (padat)','utama',[[-5.4400,105.2500],[-5.4200,105.2650],[-5.4050,105.2800],[-5.3900,105.2900]],['Mobil','Motor','Bus','Truk'],0,'Arus padat di jam sibuk.'],
['Alternatif A: jalan lingkungan','alt',[[-5.4400,105.2500],[-5.4330,105.2560],[-5.4180,105.2560],[-5.4100,105.2700],[-5.3900,105.2900]],['Mobil','Motor','Sepeda','Pejalan kaki'],12,'Jalan sempit, bus dan truk tidak bisa masuk.'],
['Alternatif B: arteri sekunder','alt',[[-5.4400,105.2500],[-5.4370,105.2780],[-5.4150,105.2950],[-5.3900,105.2900]],['Mobil','Motor','Bus','Truk','Sepeda'],8,'Lebih panjang sekitar 2 km namun lancar. Tidak ada trotoar.'],
['Alternatif C: jalur sepeda dan pejalan kaki','alt',[[-5.4400,105.2500],[-5.4280,105.2520],[-5.4000,105.2680],[-5.3900,105.2900]],['Sepeda','Pejalan kaki'],5,'Khusus non-motor dan rindang.']],
'P|K'=>[
['Jalur utama (padat)','utama',[[-5.4150,105.2550],[-5.4050,105.2700],[-5.3900,105.2900]],['Mobil','Motor','Bus','Truk'],0,'Padat di sekitar persimpangan pasar.'],
['Alternatif A: jalan kampung','alt',[[-5.4150,105.2550],[-5.4120,105.2650],[-5.3980,105.2750],[-5.3900,105.2900]],['Mobil','Motor','Sepeda','Pejalan kaki'],9,'Sempit, truk dan bus dilarang.'],
['Alternatif B: jalur sepeda','alt',[[-5.4150,105.2550],[-5.4000,105.2620],[-5.3900,105.2900]],['Sepeda','Pejalan kaki'],6,'Khusus non-motor.']]];
$tips=[['Berangkat di luar jam sibuk','Geser waktu berangkat 30 sampai 60 menit sering memangkas waktu tempuh cukup banyak.'],['Nebeng atau carpool','Satu mobil berisi tiga orang memotong emisi dan biaya per orang.'],['Gabungkan perjalanan','Selesaikan beberapa keperluan dalam satu rute agar tidak bolak-balik.'],['Jarak dekat: jalan atau sepeda','Untuk di bawah 3 km, jalan kaki atau sepeda sering lebih cepat saat macet.'],['Pakai angkutan umum','Cek rute dan jadwal sebelum berangkat, lalu pilih titik naik terdekat.'],['Kerja atau belajar dari rumah','Jika memungkinkan, satu hari tanpa perjalanan adalah cara terbaik menghindari macet.']];?>
<?php hero_open('macet'); ?><h1>Mobilitas bebas macet</h1><p>Bandingkan waktu, biaya, dan emisi tiap moda untuk perjalananmu, lalu pilih yang paling cocok. Angka adalah asumsi rata-rata dan bisa berbeda di tiap kota.</p></header>
<main class="one">
<section><img class="wide" src="<?= img('jalur',1000,240) ?>" alt="" loading="lazy" onerror="this.remove()">
<h2>Peta jalur alternatif</h2><p class="sub">Pilih lokasi awal, tujuan, dan kendaraanmu. Jalur yang boleh dilewati tampil tebal berwarna, jalur lain abu-abu putus-putus. Data jalur adalah ilustrasi.</p>
<div class="row"><select id="as" aria-label="Lokasi awal" onchange="rdraw()"></select><button class="chip" id="sw" type="button" aria-label="Tukar asal dan tujuan">Tukar</button><select id="tj" aria-label="Tujuan" onchange="rdraw()"></select></div>
<div class="chips" id="vh"></div><div id="map" role="region" aria-label="Peta jalur alternatif"></div><div id="rl" style="display:flex;flex-direction:column;gap:10px" aria-live="polite"></div>
<div class="row"><button class="btn" id="gm" type="button">Mode gambar rute</button></div>
<textarea id="js" hidden aria-label="Koordinat rute" placeholder="Klik peta untuk menambah titik. Salin JSON ini ke array $routes."></textarea></section>
<section><h2>Bandingkan moda</h2>
<div class="row"><input id="km" type="number" min="0" step="0.5" value="8" aria-label="Jarak dalam km"><select id="pk" aria-label="Waktu"><option value="0">Jam biasa</option><option value="1" selected>Jam sibuk</option></select></div>
<div style="overflow-x:auto"><table><thead><tr><th>Moda</th><th>Waktu</th><th>Biaya</th><th>CO₂</th><th></th></tr></thead><tbody id="tb"></tbody></table></div>
<p class="sub" id="msg" aria-live="polite"></p></section>
<section><h2>Jam berangkat cerdas</h2><input id="jm" type="time" value="07:30" aria-label="Jam berangkat"><div class="res" id="jr" aria-live="polite"></div>
<p class="sub">Pola umum jam sibuk: 06.30 sampai 08.30 dan 16.30 sampai 19.00.</p></section>
<section><h2>Tips menghindari macet</h2><?php foreach($tips as $t) echo '<div class="res"><strong>'.htmlspecialchars($t[0]).'</strong><br>'.htmlspecialchars($t[1]).'</div>'; ?></section>
</main>
<script>
const M=<?= json_encode($modes,JSON_UNESCAPED_UNICODE) ?>,$=s=>document.querySelector(s),rp=n=>"Rp "+Math.round(n).toLocaleString("id-ID");
function calc(){const km=Math.max(0,parseFloat($('#km').value)||0),pk=$('#pk').value==='1';
const R=M.map(m=>({m,ok:km<=m[5],t:km/(pk?m[2]:m[1])*60,b:km*m[3],c:km*m[4]})),ok=R.filter(r=>r.ok),ft=Math.min(...ok.map(r=>r.t)),lc=Math.min(...ok.map(r=>r.c));
const tb=$('#tb');tb.innerHTML='';
R.forEach((r,i)=>{const tr=document.createElement('tr');
if(!r.ok){tr.innerHTML='<td>'+r.m[0]+'</td><td colspan="4">Terlalu jauh untuk moda ini</td>';tb.append(tr);return}
if(r.t===ft||r.c===lc)tr.className='best';
tr.innerHTML='<td>'+r.m[0]+(r.t===ft?'<span class="tag">tercepat</span>':'')+(r.c===lc?'<span class="tag">emisi terendah</span>':'')+'</td><td>'+Math.round(r.t)+' mnt</td><td>'+rp(r.b)+'</td><td>'+r.c.toFixed(2)+' kg</td><td></td>';
if(i>0){const b=document.createElement('button');b.className='chip';b.textContent='Pilih';b.onclick=()=>{const co=R[0].c-r.c,hm=R[0].b-r.b;if(co<=0&&hm<=0)return;
try{const l=JSON.parse(localStorage.getItem('pilahin_log')||'[]');l.push({n:'Perjalanan '+km+' km: '+r.m[0],c:'Transportasi',kg:0,rp:Math.max(0,hm),co:Math.max(0,co)});localStorage.setItem('pilahin_log',JSON.stringify(l));$('#msg').textContent='Tersimpan. Kamu menghemat sekitar '+Math.max(0,co).toFixed(2)+' kg CO₂ dibanding mobil pribadi. Lihat di halaman Dampak.'}catch(e){}};tr.lastChild.append(b)}
tb.append(tr)})}
function jam(){const [h,m]=$('#jm').value.split(':').map(Number),t=h*60+m,r=$('#jr'),P=[[390,510,'06.30','08.30'],[990,1140,'16.30','19.00']];
const p=P.find(x=>t>=x[0]&&t<=x[1]);r.textContent=p?'Jam ini masuk jam sibuk. Coba berangkat sebelum '+p[2]+' atau setelah '+p[3]+'.':'Jam ini relatif lancar menurut pola umum. Tetap cek kondisi jalan sebelum berangkat.'}
$('#km').oninput=calc;$('#pk').onchange=calc;$('#jm').oninput=jam;calc();jam();
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.js"></script>
<script>
const PL=<?= json_encode($places,JSON_UNESCAPED_UNICODE) ?>,RS=<?= json_encode($routes,JSON_UNESCAPED_UNICODE) ?>,VH=['Mobil','Motor','Sepeda','Bus','Truk','Pejalan kaki'],RC=['#B03A2E','#3FA796','#6C8EAD','#B565A7'];
const mp=L.map('map').setView([-5.4150,105.2700],12);L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png',{attribution:'© OpenStreetMap'}).addTo(mp);
let vs=null,ly=[],mk=[],dr=false,pts=[],dl=null;
const ic=t=>L.divIcon({className:'pin',html:t,iconSize:[30,30]});
PL.forEach((p,i)=>['#as','#tj'].forEach(id=>{const o=document.createElement('option');o.value=i;o.textContent=p[1];$(id).append(o)}));$('#as').value=0;$('#tj').value=2;
function rdraw(){ly.concat(mk).forEach(l=>l.remove());ly=[];mk=[];const box=$('#rl');box.innerHTML='';
const pa=PL[+$('#as').value],pb=PL[+$('#tj').value];
if(pa===pb){box.innerHTML='<p class="sub">Pilih lokasi awal dan tujuan yang berbeda.</p>';return}
mk.push(L.marker([pa[2],pa[3]],{icon:ic('A')}).addTo(mp).bindPopup('Awal: '+pa[1]),L.marker([pb[2],pb[3]],{icon:ic('B')}).addTo(mp).bindPopup('Tujuan: '+pb[1]));
mp.fitBounds([[pa[2],pa[3]],[pb[2],pb[3]]],{padding:[50,50]});
const R=RS[pa[0]+'|'+pb[0]]||RS[pb[0]+'|'+pa[0]]||[];
if(!R.length){box.innerHTML='<p class="sub">Belum ada data jalur untuk pasangan ini. Tambahkan lewat Mode gambar rute.</p>';return}
R.forEach((r,i)=>{const ok=!vs||r[3].includes(vs),c=ok?RC[i%4]:'#999';
ly.push(L.polyline(r[2],{color:c,weight:ok?6:3,dashArray:ok?null:'6 8',opacity:.85}).addTo(mp).bindPopup('<b>'+r[0]+'</b><br>Boleh: '+r[3].join(', ')));
const d=document.createElement('div');d.className='res';d.style.borderLeftColor=c;
d.innerHTML='<strong>'+r[0]+'</strong>'+(vs?'<span class="tag">'+(ok?'bisa dilewati':'tidak untuk '+vs)+'</span>':'')+'<br>Boleh: '+r[3].join(', ')+'<br>Tidak boleh: '+(VH.filter(v=>!r[3].includes(v)).join(', ')||'-')+'<br>'+(r[4]?'Hemat sekitar '+r[4]+' menit di jam sibuk (perkiraan). ':'')+r[5];box.append(d)})}
VH.forEach(v=>{const b=document.createElement('button');b.className='chip';b.textContent=v;b.onclick=()=>{vs=vs===v?null:v;document.querySelectorAll('#vh .chip').forEach(x=>x.classList.toggle('on',x.textContent===vs));rdraw()};$('#vh').append(b)});
$('#sw').onclick=()=>{const a=$('#as').value;$('#as').value=$('#tj').value;$('#tj').value=a;rdraw()};
mp.on('click',e=>{if(!dr)return;pts.push([+e.latlng.lat.toFixed(5),+e.latlng.lng.toFixed(5)]);dl&&dl.remove();dl=L.polyline(pts,{color:'#000',dashArray:'4'}).addTo(mp);$('#js').value=JSON.stringify(pts)});
$('#gm').onclick=()=>{dr=!dr;pts=[];dl&&dl.remove();$('#js').hidden=!dr;$('#js').value='';$('#gm').textContent=dr?'Selesai menggambar':'Mode gambar rute'};
rdraw();
</script>
<?php require 'includes/footer.php';?>
