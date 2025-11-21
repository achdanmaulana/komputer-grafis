import './bootstrap';
import '../css/app.css';

document.addEventListener('DOMContentLoaded', () => {
  if (document.getElementById('three-right')) {
    import('./monas-three').then(mod => mod.default('three-right', '/mnt/data/monumen_nasional_indonesia.glb')).catch(e => console.error(e));
  }
});