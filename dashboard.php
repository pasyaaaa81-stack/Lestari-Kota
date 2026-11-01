<?php $title='Dampak';require 'includes/header.php';?>
<?php hero_open('reward'); ?><h1>Reward dan dampak</h1><p>Data berasal dari setoran yang kamu simpan dari halaman Pilah dan Mobilitas, dan hanya tersimpan di browser ini.</p></header>
<main class="one"><section>
<div class="stat"><div><strong id="tkg">0 kg</strong>sampah dipilah</div><div><strong id="trp">Rp 0</strong>perkiraan nilai</div><div><strong id="tco">0 kg</strong>CO₂ dihindari</div><div><strong id="lvl">-</strong>level</div></div>
<div class="row"><button class="btn" id="demo" type="button">Isi contoh data</button><button class="btn" id="reset" type="button">Hapus data</button></div>
<p id="empty" class="sub"></p>
<h2>Lencana dan poin</h2><p class="sub" id="pts"></p><div class="chips" id="bd"></div>
<h2>Tukar poin (contoh hadiah)</h2><div class="chips" id="rw"></div>
<h2>Papan peringkat RT (data contoh)</h2><ol id="lb"></ol>
<div class="charts"><div><canvas id="c1" aria-label="Berat per kategori"></canvas></div><div><canvas id="c2" aria-label="CO2 kumulatif"></canvas></div></div>
<table><thead><tr><th>Barang</th><th>Kategori</th><th>Berat (kg)</th><th>Nilai</th></tr></thead><tbody id="tb"></tbody></table>
</section></main>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
<script src="assets/poin.js"></script>
<script>
const $=s=>document.querySelector(s),rp=n=>"Rp "+Math.round(n).toLocaleString("id-ID");
const load=()=>{try{return JSON.parse(localStorage.getItem('pilahin_log')||'[]')}catch(e){return []}};
const save=l=>{try{localStorage.setItem('pilahin_log',JSON.stringify(l))}catch(e){}};
const COL=['#0F5C50','#F2C230','#3FA796','#E07A5F','#6C8EAD','#9BC53D','#8D6E63','#B565A7','#5C6B73'];let c1,c2;
function render(){const l=load(),sum=k=>l.reduce((a,x)=>a+x[k],0),kg=sum('kg');
$('#tkg').textContent=kg.toFixed(1)+' kg';$('#trp').textContent=rp(sum('rp'));$('#tco').textContent=sum('co').toFixed(1)+' kg';
$('#lvl').textContent=kg>=20?'Pahlawan Pilah':kg>=5?'Pemilah Rajin':'Pemilah Pemula';
$('#empty').textContent=l.length?'':'Belum ada data. Simpan hasil dari halaman Pilah, atau tekan Isi contoh data.';
const by={};l.forEach(x=>by[x.c]=(by[x.c]||0)+x.kg);c1&&c1.destroy();c2&&c2.destroy();let a=0;
c1=new Chart($('#c1'),{type:'doughnut',data:{labels:Object.keys(by),datasets:[{data:Object.values(by),backgroundColor:COL}]},options:{plugins:{title:{display:true,text:'Berat per kategori (kg)'}}}});
c2=new Chart($('#c2'),{type:'line',data:{labels:l.map((x,i)=>i+1),datasets:[{label:'CO₂ kumulatif (kg)',data:l.map(x=>a+=x.co),borderColor:COL[0],tension:.3}]},options:{plugins:{title:{display:true,text:'CO₂ dihindari dari waktu ke waktu'}}}});
$('#tb').innerHTML=l.slice(-8).reverse().map(x=>'<tr><td>'+x.n+'</td><td>'+x.c+'</td><td>'+x.kg+'</td><td>'+rp(x.rp)+'</td></tr>').join('');
const cats=Object.keys(by).length,co=l.reduce((q,x)=>q+x.co,0),pts=P().saldo;
const PT=P();$('#pts').textContent='Saldo poin: '+PT.saldo+' (didapat '+PT.earn+', ditukar '+PT.spent+'). Poin dari laporan sampah, laporan selesai, dan setoran bank sampah.';
const BD=[['Langkah pertama',l.length>=1],['5 kg terpilah',kg>=5],['Penjaga iklim (10 kg CO₂)',co>=10],['Serba bisa (4 kategori)',cats>=4],['Pahlawan pilah (20 kg)',kg>=20]];
$('#bd').innerHTML=BD.map(b=>'<span class="badge '+(b[1]?'on':'off')+'">'+(b[1]?'Dapat: ':'Terkunci: ')+b[0]+'</span>').join('');
const lb=[['Keluarga Pak Budi',180],['Ibu Sari',140],['Mas Rian',95],['Kamu',pts],['Kak Dina',40]].sort((a,b)=>b[1]-a[1]);
$('#lb').innerHTML=lb.map(x=>'<li'+(x[0]==='Kamu'?' class="me"':'')+'>'+x[0]+': '+x[1]+' poin</li>').join('');
$('#rw').innerHTML='';[['Bibit pohon',50],['Tas belanja kain',120],['Tumbler',250]].forEach(h=>{const b=document.createElement('button');b.className='chip';b.textContent=h[0]+' ('+h[1]+' poin)';b.disabled=pts<h[1];
b.onclick=()=>{try{localStorage.setItem('pilahin_redeem',JSON.stringify(P().spent+h[1]));render()}catch(e){}};$('#rw').append(b)})}
$('#demo').onclick=()=>{save([{n:'Botol plastik PET',c:'Plastik',kg:2.5,rp:9375,co:3.75},{n:'Kardus',c:'Kertas',kg:4,rp:8000,co:4},{n:'Kaleng aluminium',c:'Logam',kg:1.2,rp:15000,co:10.8},{n:'Botol kaca',c:'Kaca',kg:3,rp:2250,co:0.9},{n:'Minyak jelantah',c:'B3',kg:2,rp:10000,co:5}]);render()};
$('#reset').onclick=()=>{save([]);render()};render();
</script>
<?php require 'includes/footer.php';?>
