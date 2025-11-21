import * as THREE from "three";
import { GLTFLoader } from "three/examples/jsm/loaders/GLTFLoader.js";
import { OrbitControls } from "three/examples/jsm/controls/OrbitControls.js";

function fitCamera(camera, object, offset = 1.6, dir = new THREE.Vector3(0,0.33,0.98)) {
  const box = new THREE.Box3().setFromObject(object);
  const size = box.getSize(new THREE.Vector3());
  const center = box.getCenter(new THREE.Vector3());
  const maxSize = Math.max(size.x, size.y, size.z);
  const fov = camera.fov * (Math.PI / 180);
  let distance = Math.abs(maxSize / 2 / Math.tan(fov / 2));
  distance *= offset;
  const d = dir.clone().normalize();
  camera.position.copy(d.multiplyScalar(distance).add(center));
  camera.near = Math.max(0.1, distance / 200);
  camera.far = distance * 300;
  camera.updateProjectionMatrix();
  camera.lookAt(center);
  return { box, center };
}

export default async function mountRight3D(containerId='3d-sate', modelUrl='/mnt/data/sate.glb') {
  const container = document.getElementById(containerId);
  if (!container) return;
  if (container.__threeApp) return container.__threeApp;

  modelUrl = container.dataset.modelUrl ?? modelUrl;


  // read infoMap from blade if provided
  let infoMap = {};
  try { if (container.dataset.infoMap) infoMap = JSON.parse(container.dataset.infoMap); } catch(e){ console.warn('invalid data-info-map', e); }

  // renderer + scene + camera
  const renderer = new THREE.WebGLRenderer({ antialias: true });
  renderer.setPixelRatio(Math.min(window.devicePixelRatio || 1, 2));
  renderer.setSize(container.clientWidth, container.clientHeight);
  renderer.shadowMap.enabled = true;
  renderer.shadowMap.type = THREE.PCFSoftShadowMap;
  container.innerHTML = "";
  container.appendChild(renderer.domElement);
  renderer.domElement.style.touchAction = "none";

  const scene = new THREE.Scene();
  scene.background = new THREE.Color(0x161616);
  const camera = new THREE.PerspectiveCamera(45, container.clientWidth / container.clientHeight, 0.1, 5000);
  camera.position.set(0, 2, 20);

  // lights
  scene.add(new THREE.HemisphereLight(0xffffff, 0x222222, 0.9));
  const dirLight = new THREE.DirectionalLight(0xffffff, 1); dirLight.position.set(8,18,10); dirLight.castShadow = true; scene.add(dirLight);
  scene.add(new THREE.AmbientLight(0xffffff, 0.18));

  // controls
  const controls = new OrbitControls(camera, renderer.domElement);
  controls.enableDamping = true; controls.dampingFactor = 0.1;
  controls.minDistance = 5; controls.maxDistance = 150; controls.enablePan = true;

  // resize
  const onResize = () => { renderer.setSize(container.clientWidth, container.clientHeight); camera.aspect = container.clientWidth / container.clientHeight; camera.updateProjectionMatrix(); };
  window.addEventListener('resize', onResize);

  // tooltip
  const tooltip = document.createElement('div');
  Object.assign(tooltip.style, {
    position: 'absolute', padding: '6px 10px', background: 'rgba(0,0,0,0.85)', color: '#fff', borderRadius: '6px',
    pointerEvents: 'none', fontSize: '13px', opacity: '0', transform: 'translate(-50%,-120%)', zIndex: '10'
  });
  container.appendChild(tooltip);

  // raycaster
  const ray = new THREE.Raycaster();
  const pointer = new THREE.Vector2();

  // idle rotate
  let idle = true, lastInt = Date.now();
  const rotationSpeed = 0.01;
  function down(){ idle = false; lastInt = Date.now(); }
  function up(){ lastInt = Date.now(); setTimeout(()=>{ if (Date.now()-lastInt>900) idle = true; },900); }
  container.addEventListener('pointerdown', down);
  container.addEventListener('pointerup', up);

  // load model
  const loader = new GLTFLoader();
  let model = null;
  try { const gltf = await loader.loadAsync(modelUrl); model = gltf.scene; }
  catch(e){ console.error('load failed', e); try { const gltf = await loader.loadAsync('/models/sate.glb'); model = gltf.scene; } catch(err){ console.error('fallback failed', err); } }

  if (model) {
    // traverse and apply infoMap priority -> userData.info -> name
    model.traverse(n => {
      if (!n.isMesh) return;
      n.castShadow = n.receiveShadow = true;
      if (!n.userData) n.userData = {};
      if (infoMap && infoMap[n.name]) n.userData.info = infoMap[n.name];
      else if (!n.userData.info) n.userData.info = n.name || 'Monumen Nasional (Monas)';
      if (Array.isArray(n.material)) n.material.forEach(m=>m.side = THREE.FrontSide);
      else if (n.material) n.material.side = THREE.FrontSide;
    });

    const { box, center: modelCenter } = fitCamera(camera, model, 1.6);
    model.position.set(-modelCenter.x, -box.min.y, -modelCenter.z);
    scene.add(model);

    // ======= OVERRIDE CAMERA (you fixed this) =======
    // adjust these values if you want different POV
    const camX = 1.0, camY = 6.0, camZ = 5.8; // final camera position (close + taller)

    camera.position.set(camX, camY, camZ);

    // compute mid-height and lookAt to make view horizontal and centered
    const midHeight = box.min.y + box.getSize(new THREE.Vector3()).y * 0.7;
    const lookAtTarget = new THREE.Vector3(modelCenter.x, midHeight, modelCenter.z);
    camera.lookAt(lookAtTarget);
    controls.target.copy(lookAtTarget);
    controls.update();
    camera.updateProjectionMatrix();
    // ================================================
  } else {
    const ph = new THREE.Mesh(new THREE.BoxGeometry(3,3,3), new THREE.MeshStandardMaterial({ color:0x777777 }));
    ph.position.y = 1.5; scene.add(ph); fitCamera(camera, ph, 1.6);
  }

// when creating tooltip
tooltip.style.transform = 'none';
tooltip.style.whiteSpace = 'nowrap';

// handler
renderer.domElement.addEventListener('pointermove', (e) => {
  const rect = renderer.domElement.getBoundingClientRect();
  const clientX = e.clientX ?? (e.touches && e.touches[0] && e.touches[0].clientX);
  const clientY = e.clientY ?? (e.touches && e.touches[0] && e.touches[0].clientY);
  if (clientX == null) return;

  pointer.x = ((clientX - rect.left) / rect.width) * 2 - 1;
  pointer.y = -((clientY - rect.top) / rect.height) * 2 + 1;
  ray.setFromCamera(pointer, camera);
  const hits = ray.intersectObjects(scene.children, true);

  const localX = clientX - rect.left;
  const localY = clientY - rect.top;
  const offsetX = 12, offsetY = 12;

  if (!hits.length) { tooltip.style.opacity = '0'; return; }

  const hit = hits[0].object;
  const info = hit.userData?.info || hit.name || 'Monumen Nasional (Monas)';
  tooltip.innerText = info;
  tooltip.style.transform = 'none';
  tooltip.style.left = `${Math.max(8, Math.min(localX + offsetX, rect.width - 8))}px`;
  tooltip.style.top  = `${Math.max(8, Math.min(localY + offsetY, rect.height - 8))}px`;
  tooltip.style.opacity = '1';
});
  renderer.domElement.addEventListener('pointerleave', ()=> tooltip.style.opacity = '0');

  // animate & destroy
  let raf = null;
  function animate(){ raf = requestAnimationFrame(animate); if (idle && model) model.rotation.y += rotationSpeed; controls.update(); renderer.render(scene, camera); }
  animate();

  function destroy(){
    renderer.domElement.removeEventListener('pointermove', ()=>{});
    renderer.domElement.removeEventListener('pointerleave', ()=>{});
    window.removeEventListener('resize', onResize);
    container.removeEventListener('pointerdown', down);
    container.removeEventListener('pointerup', up);
    if (raf) cancelAnimationFrame(raf);
    try{ container.removeChild(renderer.domElement); container.removeChild(tooltip); }catch(e){}
    scene.traverse(o => { if (o.isMesh){ o.geometry?.dispose(); const m = o.material; if (Array.isArray(m)) m.forEach(mm => { mm.map?.dispose(); mm.dispose?.(); }); else { m?.map?.dispose(); m?.dispose?.(); } } });
    renderer.dispose(); delete container.__threeApp;
  }

  container.__threeApp = { scene, camera, renderer, controls, ray, destroy };
  return container.__threeApp;
}
