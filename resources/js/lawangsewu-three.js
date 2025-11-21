import * as THREE from 'three';
import { GLTFLoader } from 'three/examples/jsm/loaders/GLTFLoader.js';
import { OrbitControls } from 'three/examples/jsm/controls/OrbitControls.js';

function fitCamera(camera, object, offset = 0.82, dir = new THREE.Vector3(0,0.33,0.98)) {
  const box = new THREE.Box3().setFromObject(object);
  const size = box.getSize(new THREE.Vector3());
  const center = box.getCenter(new THREE.Vector3());
  const maxSize = Math.max(size.x, size.y, size.z);
  const fov = camera.fov * (Math.PI/180);
  let distance = Math.abs(maxSize/2 / Math.tan(fov/2));
  distance *= offset;
  const d = dir.clone().normalize();
  camera.position.copy(d.multiplyScalar(distance).add(center));
  camera.near = Math.max(0.1, distance/100);
  camera.far = distance*200;
  camera.updateProjectionMatrix();
  camera.lookAt(center);
  return center;
}

export default async function mountRight3D(c='3d-lawangsewu',modelUrl='/models/lawang_sewu_3d.glb') {
  const container = document.getElementById(c);
  if (!container) return;
  if (container.__threeApp) return;

  const renderer = new THREE.WebGLRenderer({ antialias:true, alpha:false });
  renderer.setPixelRatio(Math.min(window.devicePixelRatio||1,2));
  renderer.shadowMap.enabled = true;
  renderer.shadowMap.type = THREE.PCFSoftShadowMap;
  renderer.setSize(container.clientWidth, container.clientHeight);
  container.innerHTML = '';
  container.appendChild(renderer.domElement);

  const scene = new THREE.Scene();
  scene.background = new THREE.Color(0x161616);

  const camera = new THREE.PerspectiveCamera(45, container.clientWidth / container.clientHeight, 0.1, 2000);
  camera.position.set(0,2,8);

  const hemi = new THREE.HemisphereLight(0xffffff, 0x222222, 0.9);
  scene.add(hemi);
  const key = new THREE.DirectionalLight(0xffffff, 1.0); key.position.set(8,18,10); key.castShadow=true; scene.add(key);
  scene.add(new THREE.AmbientLight(0xffffff,0.18));

  const controls = new OrbitControls(camera, renderer.domElement);
  controls.enableDamping = true;
  controls.dampingFactor = 0.08;
  controls.minDistance = 1.2;
  controls.maxDistance = 30;

  window.addEventListener('resize',()=> {
    renderer.setSize(container.clientWidth, container.clientHeight);
    camera.aspect = container.clientWidth / container.clientHeight;
    camera.updateProjectionMatrix();
  });

  const loader = new GLTFLoader();
  let model = null;
  try {
    model = await new Promise((resolve, reject)=> loader.load(modelUrl, gltf=> resolve(gltf.scene), undefined, err=> reject(err)));
  } catch(e) {
    try { model = await new Promise((res, rej)=> loader.load('/models/lawang_sewu_3d.glb', g=> res(g.scene), undefined, err=> rej(err))); } catch(ee) { model=null; }
  }

  if (model) {
    model.traverse(c=>{ if (c.isMesh) { c.castShadow=true; c.receiveShadow=true; if (Array.isArray(c.material)) c.material.forEach(m=>m.side=THREE.FrontSide); else if (c.material) c.material.side=THREE.FrontSide; }});
    const box = new THREE.Box3().setFromObject(model);
    const center = box.getCenter(new THREE.Vector3());
    model.position.x += -center.x; model.position.z += -center.z; model.position.y += -box.min.y;
    scene.add(model);
    fitCamera(camera, model, 0.82, new THREE.Vector3(0,0.33,0.98));
    controls.target.copy(new THREE.Box3().setFromObject(model).getCenter(new THREE.Vector3()));
  } else {
    const placeholder = new THREE.Mesh(new THREE.BoxGeometry(3,3,3), new THREE.MeshStandardMaterial({color:0x777777}));
    placeholder.position.y = 1.5; scene.add(placeholder); fitCamera(camera, placeholder, 1.6);
  }

  const ground = new THREE.Mesh(new THREE.CircleGeometry(25,64), new THREE.MeshStandardMaterial({color:0x000000, transparent:true, opacity:0.03}));
  ground.rotation.x = -Math.PI/2; ground.position.y = -0.01; scene.add(ground);

  let idle=true; let lastInt = Date.now();
  container.addEventListener('pointerdown', ()=>{ idle=false; lastInt=Date.now(); });
  container.addEventListener('pointerup', ()=>{ lastInt=Date.now(); setTimeout(()=>{ if (Date.now()-lastInt>900) idle=true; },900); });

  (function animate(){
    requestAnimationFrame(animate);
    if (idle && model) model.rotation.y += 0.0025;
    controls.update();
    renderer.render(scene, camera);
  })();

  container.__threeApp = {scene,camera,renderer,controls};
}