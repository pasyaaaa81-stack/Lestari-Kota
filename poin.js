function P(){const g=(k,d)=>{try{return JSON.parse(localStorage.getItem(k))||d}catch(e){return d}};
const R=g('pilahin_reports',[]),L=g('pilahin_log',[]),X=g('pilahin_redeem',0);
const earn=R.reduce((a,r)=>a+10+(r.foto?5:0)+(r.status==='Selesai'?20:0),0)+Math.round(L.reduce((a,x)=>a+x.kg,0)*10);
return {earn,spent:X,saldo:earn-X}}
