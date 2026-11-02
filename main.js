document.querySelector('.burger').onclick=function(){var o=document.getElementById('bar').classList.toggle('open');this.setAttribute('aria-expanded',o)};
if('serviceWorker' in navigator)navigator.serviceWorker.register('sw.js').catch(()=>{})
