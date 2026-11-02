const M=[["Mobil pribadi",30,15,1000,0.17,999],["Nebeng 3 orang",30,15,333,0.057,999],["Motor",35,22,250,0.08,999],["Angkutan umum",25,16,400,0.06,999],["Sepeda",12,12,0,0,12],["Jalan kaki",5,5,0,0,3]],$=s=>document.querySelector(s),rp=n=>"Rp "+Math.round(n).toLocaleString("id-ID");
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

const PL=[["T","Terminal Kota (contoh)",-5.44,105.25],["P","Pasar Induk (contoh)",-5.415,105.255],["K","Kampus Utama (contoh)",-5.39,105.29]],RS={"T|K":[["Jalur utama (padat)","utama",[[-5.44,105.25],[-5.42,105.265],[-5.405,105.28],[-5.39,105.29]],["Mobil","Motor","Bus","Truk"],0,"Arus padat di jam sibuk."],["Alternatif A: jalan lingkungan","alt",[[-5.44,105.25],[-5.433,105.256],[-5.418,105.256],[-5.41,105.27],[-5.39,105.29]],["Mobil","Motor","Sepeda","Pejalan kaki"],12,"Jalan sempit, bus dan truk tidak bisa masuk."],["Alternatif B: arteri sekunder","alt",[[-5.44,105.25],[-5.437,105.278],[-5.415,105.295],[-5.39,105.29]],["Mobil","Motor","Bus","Truk","Sepeda"],8,"Lebih panjang sekitar 2 km namun lancar. Tidak ada trotoar."],["Alternatif C: jalur sepeda dan pejalan kaki","alt",[[-5.44,105.25],[-5.428,105.252],[-5.4,105.268],[-5.39,105.29]],["Sepeda","Pejalan kaki"],5,"Khusus non-motor dan rindang."]],"P|K":[["Jalur utama (padat)","utama",[[-5.415,105.255],[-5.405,105.27],[-5.39,105.29]],["Mobil","Motor","Bus","Truk"],0,"Padat di sekitar persimpangan pasar."],["Alternatif A: jalan kampung","alt",[[-5.415,105.255],[-5.412,105.265],[-5.398,105.275],[-5.39,105.29]],["Mobil","Motor","Sepeda","Pejalan kaki"],9,"Sempit, truk dan bus dilarang."],["Alternatif B: jalur sepeda","alt",[[-5.415,105.255],[-5.4,105.262],[-5.39,105.29]],["Sepeda","Pejalan kaki"],6,"Khusus non-motor."]]},VH=['Mobil','Motor','Sepeda','Bus','Truk','Pejalan kaki'],RC=['#B03A2E','#3FA796','#6C8EAD','#B565A7'];
const mp=L.map('map').setView([-5.4150,105.2700],12);baseLayers(mp);
let vs=null,ly=[],mk=[],dr=false,pts=[],dl=null;
const ic=t=>L.divIcon({className:'pin',html:t,iconSize:[30,30]});
PL.forEach((p,i)=>['#as','#tj'].forEach(id=>{const o=document.createElement('option');o.value=i;o.textContent=p[1];$(id).append(o)}));$('#as').value=0;$('#tj').value=2;
function rdraw(){ly.concat(mk).forEach(l=>l.remove());ly=[];mk=[];const box=$('#rl');box.innerHTML='';
const pa=PL[+$('#as').value],pb=PL[+$('#tj').value];
if(pa===pb){box.innerHTML='<p class="sub">Pilih lokasi awal dan tujuan yang berbeda.</p>';return}
mk.push(L.marker([pa[2],pa[3]],{icon:ic('A')}).addTo(mp).bindPopup('Awal: '+pa[1]),L.marker([pb[2],pb[3]],{icon:ic('B')}).addTo(mp).bindPopup('Tujuan: '+pb[1]));
mp.fitBounds([[pa[2],pa[3]],[pb[2],pb[3]]],{padding:[50,50]});
const gmode={'Sepeda':'bicycling','Pejalan kaki':'walking','Bus':'transit'}[vs]||'driving';
const gl=document.createElement('a');gl.className='btn';gl.target='_blank';gl.rel='noopener';gl.textContent='Rute di Google Maps';gl.href=gmDir([pa[2],pa[3]],[pb[2],pb[3]],gmode);gl.style.alignSelf='flex-start';
const R=RS[pa[0]+'|'+pb[0]]||RS[pb[0]+'|'+pa[0]]||[];
if(!R.length){box.innerHTML='<p class="sub">Belum ada data jalur untuk pasangan ini. Tambahkan lewat Mode gambar rute.</p>';box.append(gl);return}
R.forEach((r,i)=>{const ok=!vs||r[3].includes(vs),c=ok?RC[i%4]:'#999';
ly.push(L.polyline(r[2],{color:c,weight:ok?6:3,dashArray:ok?null:'6 8',opacity:.85}).addTo(mp).bindPopup('<b>'+r[0]+'</b><br>Boleh: '+r[3].join(', ')));
const d=document.createElement('div');d.className='res';d.style.borderLeftColor=c;
d.innerHTML='<strong>'+r[0]+'</strong>'+(vs?'<span class="tag">'+(ok?'bisa dilewati':'tidak untuk '+vs)+'</span>':'')+'<br>Boleh: '+r[3].join(', ')+'<br>Tidak boleh: '+(VH.filter(v=>!r[3].includes(v)).join(', ')||'-')+'<br>'+(r[4]?'Hemat sekitar '+r[4]+' menit di jam sibuk (perkiraan). ':'')+r[5];box.append(d)});box.append(gl)}
VH.forEach(v=>{const b=document.createElement('button');b.className='chip';b.textContent=v;b.onclick=()=>{vs=vs===v?null:v;document.querySelectorAll('#vh .chip').forEach(x=>x.classList.toggle('on',x.textContent===vs));rdraw()};$('#vh').append(b)});
$('#sw').onclick=()=>{const a=$('#as').value;$('#as').value=$('#tj').value;$('#tj').value=a;rdraw()};
mp.on('click',e=>{if(!dr)return;pts.push([+e.latlng.lat.toFixed(5),+e.latlng.lng.toFixed(5)]);dl&&dl.remove();dl=L.polyline(pts,{color:'#000',dashArray:'4'}).addTo(mp);$('#js').value=JSON.stringify(pts)});
$('#gm').onclick=()=>{dr=!dr;pts=[];dl&&dl.remove();$('#js').hidden=!dr;$('#js').value='';$('#gm').textContent=dr?'Selesai menggambar':'Mode gambar rute'};
rdraw();
