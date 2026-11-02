function up(id,to){const e=document.getElementById(id);let v=0;const t=setInterval(()=>{v+=Math.ceil(to/25);if(v>=to){v=to;clearInterval(t)}e.textContent=v},40)}
up('n1',ITEMS.length);up('n2',KB.length);
