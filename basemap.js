// Peta dasar bersama: Google Maps (Jalan, Satelit, Hybrid) + cadangan CARTO.
// Tile Google dimuat lewat Leaflet tanpa API key. Untuk pemakaian produksi skala besar,
// pertimbangkan Google Maps JavaScript API resmi (butuh API key dan billing).
function baseLayers(map){
  const g=l=>L.tileLayer('https://mt{s}.google.com/vt/lyrs='+l+'&x={x}&y={y}&z={z}&hl=id',{subdomains:'0123',maxZoom:20,attribution:'Map data © Google'});
  const jalan=g('m'),sat=g('s'),hyb=g('y');
  const carto=L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png',{subdomains:'abcd',maxZoom:20,attribution:'© OpenStreetMap © CARTO'});
  jalan.addTo(map);
  L.control.layers({'Google Jalan':jalan,'Google Satelit':sat,'Google Hybrid':hyb,'CARTO (cadangan)':carto},null,{position:'topright'}).addTo(map);
  // Jika tile Google gagal dimuat berulang kali (mis. diblokir jaringan), pindah ke cadangan.
  let err=0;
  jalan.on('tileerror',()=>{if(++err===4&&map.hasLayer(jalan)){map.removeLayer(jalan);carto.addTo(map)}});
  return jalan;
}
// Tautan Google Maps (resmi, tanpa API key)
const gmPlace=(lat,lng)=>'https://www.google.com/maps/search/?api=1&query='+lat+','+lng;
const gmDir=(a,b,mode)=>'https://www.google.com/maps/dir/?api=1&origin='+a[0]+','+a[1]+'&destination='+b[0]+','+b[1]+'&travelmode='+(mode||'driving');
