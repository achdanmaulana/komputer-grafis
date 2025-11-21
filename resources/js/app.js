import './bootstrap';
import '../css/app.css';

document.addEventListener('DOMContentLoaded', () => {
  if (document.getElementById('three-right')) {
    import('./monas-three').then(mod => mod.default('three-right', '/mnt/data/monumen_nasional_indonesia.glb')).catch(e => console.error(e));
  }
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