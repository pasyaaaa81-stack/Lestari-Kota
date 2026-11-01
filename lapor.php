<?php $title='Lapor';require 'includes/header.php';
$kat=['Sampah menumpuk','TPS liar','Sampah di sungai atau parit','Pembakaran sampah','Sampah B3','Saluran tersumbat sampah'];?>
<?php hero_open('lapor'); ?><h1>Lapor sampah</h1><p>Temukan sampah liar, laporkan dengan lokasi dan foto, lalu pantau statusnya. Setiap laporan menambah poin reward yang bisa ditukar.</p></header>
<main class="one">
<section><h2>Buat laporan</h2><p class="sub">Klik peta untuk menandai lokasi, atau pakai lokasi saya.</p>
<div id="map" role="region" aria-label="Peta laporan"></div>
<div class="row"><button class="btn" id="loc" type="button">Lokasi saya</button><span class="sub" id="ll">Belum ada lokasi</span></div>
<div class="fm"><select id="kt" aria-label="Kategori"><?php foreach($kat as $k) echo "<option>$k</option>"; ?></select>
<select id="tg" aria-label="Tingkat"><option>Ringan</option><option>Sedang</option><option>Berat</option></select>
<textarea id="ds" placeholder="Jelaskan kondisinya (perkiraan volume, bau, dekat apa)" aria-label="Deskripsi"></textarea>
<input id="ft" type="file" accept="image/*" aria-label="Foto"><button class="btn" id="kirim" type="button">Kirim laporan</button></div>
<p class="sub" id="msg" aria-live="polite"></p></section>
<section><h2>Laporan saya <span class="tag" id="pt"></span></h2><div class="row"><button class="btn" id="demo" type="button">Isi contoh laporan</button></div><div id="ls" style="display:flex;flex-direction:column;gap:10px"></div></section>
</main>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.js"></script>
<script src="assets/poin.js"></script>
<script>
const ST=['Dilaporkan','Diverifikasi','Dikerjakan','Selesai'],CL={Dilaporkan:'#E07A5F',Diverifikasi:'#F2C230',Dikerjakan:'#6C8EAD',Selesai:'#3FA796'},$=s=>document.querySelector(s);
const g=(k,d)=>{try{return JSON.parse(localStorage.getItem(k))||d}catch(e){return d}};
const esc=s=>String(s).replace(/[&<>"]/g,c=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;'}[c]));
let R=g('pilahin_reports',[]),pos=null,pm=null,foto=null,ly=[];
const map=L.map('map').setView([-5.4295,105.261],12);
L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png',{attribution:'© OpenStreetMap'}).addTo(map);
function setPos(c){pos=c;pm&&pm.remove();pm=L.marker(c).addTo(map);$('#ll').textContent=c[0].toFixed(5)+', '+c[1].toFixed(5)}
map.on('click',e=>setPos([e.latlng.lat,e.latlng.lng]));
$('#loc').onclick=()=>navigator.geolocation&&navigator.geolocation.getCurrentPosition(p=>{const c=[p.coords.latitude,p.coords.longitude];map.setView(c,15);setPos(c)});
$('#ft').onchange=e=>{const f=e.target.files[0];if(!f)return;const im=new Image(),u=URL.createObjectURL(f);
im.onload=()=>{const k=Math.min(1,600/Math.max(im.width,im.height)),c=document.createElement('canvas');c.width=im.width*k;c.height=im.height*k;c.getContext('2d').drawImage(im,0,0,c.width,c.height);foto=c.toDataURL('image/jpeg',.6);URL.revokeObjectURL(u)};im.src=u};
function save(){try{localStorage.setItem('pilahin_reports',JSON.stringify(R));return true}catch(e){$('#msg').textContent='Penyimpanan penuh. Hapus laporan lama.';return false}}
$('#kirim').onclick=()=>{const d=$('#ds').value.trim();if(!pos){$('#msg').textContent='Tandai lokasi di peta dulu.';return}if(!d){$('#msg').textContent='Isi deskripsi singkat.';return}
R.push({id:Date.now(),k:$('#kt').value,t:$('#tg').value,d,lat:pos[0],lng:pos[1],foto,status:'Dilaporkan',w:new Date().toISOString()});
if(save()){$('#msg').textContent='Laporan terkirim. Kamu mendapat '+(foto?15:10)+' poin.';$('#ds').value='';$('#ft').value='';foto=null;draw()}};
$('#demo').onclick=()=>{[['Sampah menumpuk','Berat','Tumpukan di sudut pasar, bau menyengat.',-5.4200,105.2600,'Dilaporkan'],['Sampah di sungai atau parit','Sedang','Parit tersumbat plastik.',-5.4010,105.2480,'Dikerjakan'],['TPS liar','Ringan','Lahan kosong dipakai buang sampah.',-5.4390,105.2690,'Selesai']].forEach((x,i)=>R.push({id:Date.now()+i,k:x[0],t:x[1],d:x[2],lat:x[3],lng:x[4],foto:null,status:x[5],w:new Date().toISOString()}));save();draw()};
function draw(){ly.forEach(l=>l.remove());ly=[];const box=$('#ls');box.innerHTML='';$('#pt').textContent='Saldo '+P().saldo+' poin';
if(!R.length)box.innerHTML='<p class="sub">Belum ada laporan.</p>';
R.slice().reverse().forEach(r=>{ly.push(L.circleMarker([r.lat,r.lng],{radius:9,color:CL[r.status],fillOpacity:.8}).addTo(map).bindPopup('<b>'+esc(r.k)+'</b><br>'+r.status));
const d=document.createElement('div');d.className='res';d.style.borderLeftColor=CL[r.status];
d.innerHTML='<b class="cat">'+esc(r.k)+'</b><span class="tag">'+esc(r.t)+'</span> <small>'+new Date(r.w).toLocaleDateString('id-ID')+'</small><br>'+esc(r.d)+'<br><small>'+ST.map(s=>ST.indexOf(s)<=ST.indexOf(r.status)?'<b>'+s+'</b>':s).join(' › ')+'</small>'+(r.foto?'<img class="thumb" alt="Foto laporan" src="'+r.foto+'">':'')+'<br>';
if(r.status!=='Selesai'){const b=document.createElement('button');b.className='chip';b.textContent='Naikkan status (simulasi petugas)';b.onclick=()=>{r.status=ST[ST.indexOf(r.status)+1];save();draw()};d.append(b)}
const x=document.createElement('button');x.className='chip';x.textContent='Hapus';x.onclick=()=>{R=R.filter(q=>q.id!==r.id);save();draw()};d.append(x);box.append(d)})}
draw();
</script>
<?php require 'includes/footer.php';?>
