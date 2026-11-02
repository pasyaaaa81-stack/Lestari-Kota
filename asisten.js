(function(){
const $=s=>document.querySelector(s),B=$('#aiB'),P=$('#aiP');if(!B||typeof KB==='undefined')return;
const norm=t=>t.toLowerCase().replace(/[^a-z0-9\s]/g," ").replace(/\s+/g," ").trim();
function lev(a,b){const d=Array.from({length:a.length+1},(_,i)=>[i]);for(let j=1;j<=b.length;j++)d[0][j]=j;
for(let i=1;i<=a.length;i++)for(let j=1;j<=b.length;j++)d[i][j]=Math.min(d[i-1][j]+1,d[i][j-1]+1,d[i-1][j-1]+(a[i-1]==b[j-1]?0:1));return d[a.length][b.length]}
function match(w,k){if(w.length<3)return false;if(w.includes(k)||k.includes(w))return true;return k.indexOf(" ")<0&&Math.abs(w.length-k.length)<=1&&lev(w,k)<=(k.length>5?2:1)}
function sc(text,keys){const t=norm(text),ws=t.split(' ');let s=0;for(const k of keys){if(k.includes(' ')?t.includes(k):ws.some(w=>match(w,k)))s++}return s}
const PG={Lapor:'lapor.html',Komunitas:'komunitas.html',Mobilitas:'lalulintas.html',Reward:'dashboard.html',Pilah:'pilah.html'};
const CH={'lapor.html':['Cara melapor sampah','Status laporan','Cara dapat poin'],'komunitas.html':['Siapa Pandawara Group?','Cara bergabung komunitas'],'kebakaran.html':['Kebakaran rumah, apa yang dilakukan?','Kabut asap','Gas bocor'],'lalulintas.html':['Cara menghindari macet','Cara pilih asal dan tujuan','Nebeng itu apa?'],'dashboard.html':['Cara dapat poin','Reward apa saja?'],'peta.html':['Bank sampah itu apa?','Cara menabung sampah']};
const DEF=['Apa saja fitur Lestari Kota?','Kebakaran rumah, apa yang dilakukan?','Cara menghindari macet','Cara melapor sampah'];
const C=$('#aiC');
function say(t,w){const d=document.createElement('div');d.className='m '+w;d.textContent=t;C.append(d);C.scrollTop=C.scrollHeight;return d}
function ask(t){t=t.trim();if(!t)return;say(t,'me');let best=null,bs=0;for(const e of KB){const s=sc(t,e[0]);if(s>bs){bs=s;best=e}}
const d=say('Mengetik…','bot');setTimeout(()=>{d.textContent=best?best[1]:'Aku belum paham. Aku bisa membantu soal sampah, komunitas lingkungan, kebakaran, jalur bebas macet, dan reward. Coba salah satu pertanyaan di bawah.';
const m=best&&best[1].match(/halaman (Lapor|Komunitas|Mobilitas|Reward|Pilah)/);if(m){d.append(document.createElement('br'));const a=document.createElement('a');a.href=PG[m[1]];a.textContent='Buka halaman '+m[1];d.append(a)}C.scrollTop=C.scrollHeight},500)}
(CH[document.body.dataset.page]||[]).concat(DEF).slice(0,5).forEach(t=>{const b=document.createElement('button');b.className='chip';b.textContent=t;b.onclick=()=>ask(t);$('#aiQ').append(b)});
function tg(o){P.hidden=!o;B.setAttribute('aria-expanded',o);if(o)$('#aiI').focus()}
B.onclick=()=>tg(P.hidden);$('#aiX').onclick=()=>tg(false);document.addEventListener('keydown',e=>{if(e.key==='Escape')tg(false)});
$('#aiS').onclick=()=>{ask($('#aiI').value);$('#aiI').value=''};$('#aiI').addEventListener('keydown',e=>{if(e.key==='Enter'){e.preventDefault();$('#aiS').click()}});
say('Halo! Aku asisten Lestari Kota. Tanyakan apa saja soal sampah, komunitas, kebakaran, macet, atau reward.','bot');
})();
