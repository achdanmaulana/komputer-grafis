import * as THREE from 'three';
import { OrbitControls } from 'three/examples/jsm/controls/OrbitControls.js';

export default function mountMonasJSON(containerId = 'three-root', url = '/models/monas.json') {
  const container = document.getElementById(containerId);
  if (!container) return;

  const renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
  renderer.setPixelRatio(Math.min(window.devicePixelRatio || 1, 2));
  renderer.shadowMap.enabled = true;
  container.innerHTML = '';
  container.appendChild(renderer.domElement);

  const scene = new THREE.Scene();
  scene.background = new THREE.Color(0xf4f6f8);

  const camera = new THREE.PerspectiveCamera(45, container.clientWidth / container.clientHeight, 0.1, 2000);
  camera.position.set(6, 3, 8);

  const hemi = new THREE.HemisphereLight(0xffffff, 0x444444, 0.6);
  scene.add(hemi);

  const dir = new THREE.DirectionalLight(0xffffff, 0.9);
  dir.position.set(10, 20, 10);
  dir.castShadow = true;
  scene.add(dir);

  scene.add(new THREE.AmbientLight(0xffffff, 0.25));

  const controls = new OrbitControls(camera, renderer.domElement);
  controls.enableDamping = true;
  controls.target.set(0, 1.5, 0);

  function resize() {
    const w = container.clientWidth || 800;
    const h = container.clientHeight || 600;
    renderer.setSize(w, h);
    camera.aspect = w / h;
    camera.updateProjectionMatrix();
  }
  window.addEventListener('resize', resize);
  resize();

  fetch(url)
    .then(r => r.json())
    .then(json => {
      const loader = new THREE.ObjectLoader();
      const obj = loader.parse(json);

      obj.traverse(child => {
        if (child.isMesh) {
          child.castShadow = true;
          child.receiveShadow = true;
        }
      });

      const box = new THREE.Box3().setFromObject(obj);
      const size = box.getSize(new THREE.Vector3());
      const maxDim = Math.max(size.x, size.y, size.z);
      const scale = 6 / maxDim;
      obj.scale.setScalar(scale);

      box.setFromObject(obj);
      const center = box.getCenter(new THREE.Vector3());
      obj.position.x = -center.x;
      obj.position.z = -center.z;
      obj.position.y = -box.min.y;

      scene.add(obj);
    });

  (function animate() {
    requestAnimationFrame(animate);
    controls.update();
    renderer.render(scene, camera);
  })();

  container.__threeApp = { scene, camera, renderer, controls };
}