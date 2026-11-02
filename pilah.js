const $=s=>document.querySelector(s);
const norm=t=>t.toLowerCase().replace(/[^a-z0-9\s]/g," ").replace(/\s+/g," ").trim();
const rp=n=>"Rp "+Math.round(n).toLocaleString("id-ID");
function lev(a,b){const d=Array.from({length:a.length+1},(_,i)=>[i]);for(let j=1;j<=b.length;j++)d[0][j]=j;
for(let i=1;i<=a.length;i++)for(let j=1;j<=b.length;j++)d[i][j]=Math.min(d[i-1][j]+1,d[i][j-1]+1,d[i-1][j-1]+(a[i-1]==b[j-1]?0:1));return d[a.length][b.length]}
function match(w,k){if(w.length<3)return false;if(w.includes(k)||k.includes(w))return true;return k.indexOf(" ")<0&&Math.abs(w.length-k.length)<=1&&lev(w,k)<=(k.length>5?2:1)}
function score(text,keys){const ws=norm(text).split(" ");const t=norm(text);let s=0;
for(const k of keys){if(k.includes(" ")?t.includes(k):ws.some(w=>match(w,k)))s++}return s}
let cur=null;
function sorter(text){let best=null,bs=0;
for(const it of ITEMS){const s=score(text,(it[0]+" "+it[1]).toLowerCase().split(" ").filter(x=>x.length>2));if(s>bs){bs=s;best=it}}return best}
function show(it){cur=it;const o=$("#out");
if(!it){o.textContent="Barang belum dikenali. Coba nama lain atau pilih contoh di bawah kolom.";return}
const price=it[4]?rp(it[3])+" sampai "+rp(it[4])+" per kg":"Tidak ada nilai jual";
o.className="res";void o.offsetWidth;o.className="res pop";
o.innerHTML="<b class='cat'>"+it[2]+"</b> <strong>"+it[0]+"</strong><br>"+it[6]+"<br><small>"+price+"</small>";calc()}
function calc(){if(!cur)return;const kg=Math.max(0,parseFloat($("#kg").value)||0);
$("#rp").textContent=cur[4]?rp(kg*(cur[3]+cur[4])/2):"Rp 0";$("#co").textContent=(kg*cur[5]).toFixed(1)+" kg"}
$("#q").addEventListener("input",e=>{if(e.target.value.trim().length>2)show(sorter(e.target.value))});
$("#hit").onclick=()=>{if(!cur&&$("#q").value)show(sorter($("#q").value));calc()};
$("#kg").oninput=calc;
["Botol air mineral","Kardus","Kaleng minuman","Baterai","Minyak jelantah","Sachet"].forEach(n=>{const b=document.createElement("button");b.className="chip";b.textContent=n;
b.onclick=()=>{$("#q").value=n;show(sorter(n))};$("#cq").append(b)});
// Chatbot
const chat=$("#chat");
function say(t,w){const d=document.createElement("div");d.className="m "+w;d.textContent=t;chat.append(d);chat.scrollTop=chat.scrollHeight}
function ask(t){t=t.trim();if(!t)return;say(t,"me");let best=null,bs=0;
for(const e of KB){const s=score(t,e[0]);if(s>bs){bs=s;best=e}}
say("Mengetik…","bot");const tp=chat.lastChild;setTimeout(()=>{tp.textContent=best?best[1]:"Aku belum paham pertanyaan itu. Coba pilih salah satu pertanyaan cepat di bawah.";chat.scrollTop=chat.scrollHeight},650)}
say("Halo! Aku Pilahin. Tanyakan cara memilah, harga sampah, atau cara kerja bank sampah.","bot");
$("#send").onclick=()=>{ask($("#in").value);$("#in").value=""};
$("#in").addEventListener("keydown",e=>{if(e.key==="Enter"){e.preventDefault();$("#send").click()}});
["Kardus berminyak masuk mana?","Cara kerja bank sampah","Baterai dibuang ke mana?","Apa kaitannya dengan iklim?","Obat kedaluwarsa dibuang ke mana?","Kode plastik itu apa?","Kompos saya bau, kenapa?","Cara kurangi sampah","Kebakaran rumah, apa yang dilakukan?","Cara menghindari macet"].forEach(n=>{const b=document.createElement("button");b.className="chip";b.textContent=n;b.onclick=()=>ask(n);$("#cc").append(b)});

$("#save").onclick=()=>{if(!cur)return;const kg=Math.max(0,parseFloat($("#kg").value)||0);if(!kg)return;
try{const l=JSON.parse(localStorage.getItem("pilahin_log")||"[]");l.push({n:cur[0],c:cur[2],kg,rp:cur[4]?kg*(cur[3]+cur[4])/2:0,co:kg*cur[5]});
localStorage.setItem("pilahin_log",JSON.stringify(l));$("#save").textContent="Tersimpan. Lihat di halaman Dampak"}catch(e){}};
