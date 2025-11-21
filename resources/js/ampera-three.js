import * as THREE from 'three';
import { GLTFLoader } from 'three/examples/jsm/loaders/GLTFLoader.js';
import { OrbitControls } from 'three/examples/jsm/controls/OrbitControls.js';

function fitCamera(camera, object, offset = 1.6, dir = new THREE.Vector3(0, 0.33, 0.98)) {
  const box = new THREE.Box3().setFromObject(object);
  const size = box.getSize(new THREE.Vector3());
  const center = box.getCenter(new THREE.Vector3());
  const maxSize = Math.max(size.x, size.y, size.z);

  const fov = camera.fov * (Math.PI / 180);
  let distance = Math.abs(maxSize / 2 / Math.tan(fov / 2));
  distance *= offset; // zoom-out factor

  const d = dir.clone().normalize();
  camera.position.copy(d.multiplyScalar(distance).add(center));

  camera.near = Math.max(0.1, distance / 200);
  camera.far = distance * 300;
  camera.updateProjectionMatrix();

  camera.lookAt(center);
  return center;
}

export default async function mountRight3D(containerId = '3d-ampera', modelUrl = '/models/ampera.glb') {
  const container = document.getElementById(containerId);
  if (!container) return;
  if (container.__threeApp) return;

  const renderer = new THREE.WebGLRenderer({ antialias: true, alpha: false });
  renderer.setPixelRatio(Math.min(window.devicePixelRatio || 1, 2));
  renderer.shadowMap.enabled = true;
  renderer.shadowMap.type = THREE.PCFSoftShadowMap;
  renderer.setSize(container.clientWidth, container.clientHeight);
  container.innerHTML = '';
  container.appendChild(renderer.domElement);

  const scene = new THREE.Scene();
  scene.background = new THREE.Color(0x161616);

  const camera = new THREE.PerspectiveCamera(
    45,
    container.clientWidth / container.clientHeight,
    0.1,
    5000
  );
  camera.position.set(0, 2, 20);

  const hemi = new THREE.HemisphereLight(0xffffff, 0x222222, 0.9);
  scene.add(hemi);

  const key = new THREE.DirectionalLight(0xffffff, 1.0);
  key.position.set(12, 25, 12);
  key.castShadow = true;
  scene.add(key);

  scene.add(new THREE.AmbientLight(0xffffff, 0.2));

  const controls = new OrbitControls(camera, renderer.domElement);
  controls.enableDamping = true;
  controls.dampingFactor = 0.1;

  controls.minDistance = 5;       // minimal zoom
  controls.maxDistance = 150;     // FIX: allow far zoom

  controls.enablePan = true;

  window.addEventListener('resize', () => {
    renderer.setSize(container.clientWidth, container.clientHeight);
    camera.aspect = container.clientWidth / container.clientHeight;
    camera.updateProjectionMatrix();
  });

  const loader = new GLTFLoader();
  let model = null;

  try {
    model = await new Promise((resolve, reject) =>
      loader.load(modelUrl, (gltf) => resolve(gltf.scene), undefined, reject)
    );
  } catch (e) {
    console.error(e);
  }

  if (model) {
    model.traverse((c) => {
      if (c.isMesh) {
        c.castShadow = true;
        c.receiveShadow = true;
      }
    });

    // auto center + grounding
    const box = new THREE.Box3().setFromObject(model);
    const center = box.getCenter(new THREE.Vector3());

    model.position.sub(center);
    model.position.y -= box.min.y; // put on ground

    scene.add(model);

    // IMPORTANT: proper distance
    const newCenter = fitCamera(camera, model, 2.4); // ← jauh tapi ideal
    controls.target.copy(newCenter);
  }

  const ground = new THREE.Mesh(
    new THREE.CircleGeometry(40, 64),
    new THREE.MeshStandardMaterial({
      color: 0x000000,
      transparent: true,
      opacity: 0.04
    })
  );
  ground.rotation.x = -Math.PI / 2;
  ground.position.y = -0.01;
  scene.add(ground);

  (function animate() {
    requestAnimationFrame(animate);
    controls.update();
    renderer.render(scene, camera);
  })();

  container.__threeApp = { scene, camera, renderer, controls };
}
