import './bootstrap';
import '../css/app.css';

document.addEventListener('DOMContentLoaded', () => {

  const models = [
    { id: '3d-monas',       js: './monas-three',      glb: '/models/monas.glb' },
    { id: '3d-surabaya',    js: './surabaya-three',   glb: '/models/patung_sura_dan_buaya.glb' },
    { id: '3d-ampera',      js: './ampera-three',     glb: '/models/ampera.glb' },
    { id: '3d-suramadu',    js: './suramadu-three',   glb: '/models/jembatan_suramadu.glb' },
    { id: '3d-lawangsewu',  js: './lawangsewu-three', glb: '/models/lawang_sewu_3d.glb' },
    { id: '3d-sate',        js: './sate-three',       glb: '/models/sate.glb' },
  ];

  models.forEach(model => {
    const container = document.getElementById(model.id);
    if (!container) return;

    import(model.js)
      .then(mod => mod.default(model.id, model.glb))
      .catch(err => console.error(`Error load model ${model.id}`, err));
  });

});


document.addEventListener('DOMContentLoaded', () => {
  const row = document.getElementById('photo-row');
  if (!row) return;

  // convert vertical wheel to horizontal scroll
  row.addEventListener('wheel', (e) => {
    if (Math.abs(e.deltaY) > Math.abs(e.deltaX)) {
      row.scrollBy({ left: e.deltaY, behavior: 'smooth' });
      e.preventDefault();
    }
  }, { passive: false });

  // optional: snap to nearest item after scroll stops (improves UX)
  let timeout;
  row.addEventListener('scroll', () => {
    window.clearTimeout(timeout);
    timeout = setTimeout(() => {
      const items = Array.from(row.querySelectorAll('.photo-item'));
      const rowRect = row.getBoundingClientRect();
      // find nearest by distance between item left and container left
      let nearest = items[0];
      let min = Infinity;
      items.forEach(it => {
        const rect = it.getBoundingClientRect();
        const dist = Math.abs(rect.left - rowRect.left);
        if (dist < min) { min = dist; nearest = it; }
      });
      row.scrollTo({ left: nearest.offsetLeft - row.offsetLeft, behavior: 'smooth' });
    }, 120);
  });
});