const B=[["Bank Sampah Contoh Tanjung Karang",-5.429,105.261,"Sen-Sab 08.00-15.00",["Plastik","Kertas","Logam"]],["Bank Sampah Contoh Enggal",-5.418,105.26,"Sen-Jum 09.00-14.00",["Plastik","Kaca","Kertas"]],["Bank Sampah Contoh Rajabasa",-5.372,105.238,"Sel-Sab 08.00-16.00",["Logam","Plastik","B3"]],["Bank Sampah Contoh Kedaton",-5.402,105.248,"Sen-Sab 08.00-15.00",["Organik","Kertas","Tekstil"]],["Bank Sampah Contoh Teluk Betung",-5.45,105.265,"Sen-Jum 08.00-13.00",["Plastik","Logam","Kaca"]],["Bank Sampah Contoh Sukarame",-5.39,105.305,"Rab-Sab 09.00-15.00",["Kertas","Plastik","B3"]]],T=["Plastik","Kertas","Logam","Kaca","B3","Organik","Tekstil"],sel=new Set();let marks=[],pos=null;const hv=b=>{const r=x=>x*Math.PI/180,p=r(b[1]-pos[0]),q=r(b[2]-pos[1]),a=Math.sin(p/2)**2+Math.cos(r(pos[0]))*Math.cos(r(b[1]))*Math.sin(q/2)**2;return 12742*Math.asin(Math.sqrt(a))};
const map=L.map('map').setView([-5.4295,105.261],12);
baseLayers(map);
function draw(){marks.forEach(m=>m.remove());marks=[];const ul=document.getElementById('list');ul.innerHTML='';
const r=B.filter(b=>[...sel].every(s=>b[4].includes(s))&&b[0].toLowerCase().includes(document.getElementById('s').value.toLowerCase()));if(pos)r.sort((x,y)=>hv(x)-hv(y));
if(!r.length)ul.innerHTML='<li>Tidak ada bank sampah yang menerima semua jenis terpilih. Kurangi filter.</li>';
r.forEach(b=>{marks.push(L.marker([b[1],b[2]]).addTo(map).bindPopup('<b>'+b[0]+'</b><br>'+b[3]+'<br>'+b[4].join(', ')));
const li=document.createElement('li');li.innerHTML='<b>'+b[0]+'</b>'+(pos?' ('+hv(b).toFixed(1)+' km)':'')+'<br>'+b[3]+' | '+b[4].join(', ')+' <a target="_blank" rel="noopener" href="https://www.google.com/maps/dir/?api=1&destination='+b[1]+','+b[2]+'">Buka rute</a>';ul.append(li)})}
T.forEach(t=>{const b=document.createElement('button');b.className='chip';b.textContent=t;b.setAttribute('aria-pressed','false');
b.onclick=()=>{sel.has(t)?sel.delete(t):sel.add(t);b.classList.toggle('on');b.setAttribute('aria-pressed',sel.has(t));draw()};document.getElementById('flt').append(b)});
document.getElementById('loc').onclick=()=>navigator.geolocation&&navigator.geolocation.getCurrentPosition(p=>{
const c=[p.coords.latitude,p.coords.longitude];map.setView(c,14);L.circleMarker(c,{radius:8}).addTo(map).bindPopup('Lokasimu').openPopup();pos=c;draw()});
draw();
