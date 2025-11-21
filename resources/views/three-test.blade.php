<!DOCTYPE html>
<html>
<head>
    <title>Three JS Test</title>
</head>
<body style="margin:0; background:#111;">
    
<h2 style="color:white; padding:10px; font-family:sans-serif;">
    Three.js TEST — Jika Anda melihat KUBUS 3D, berarti Three.js BERJALAN
</h2>

<div id="three-area" style="width:100%; height:500px;"></div>

<script type="module">
import * as THREE from "https://unpkg.com/three@0.161.0/build/three.module.js";

console.log("Three.js module loaded!");

const canvasArea = document.getElementById("three-area");
const width = canvasArea.clientWidth;
const height = canvasArea.clientHeight;

const renderer = new THREE.WebGLRenderer({ antialias: true });
renderer.setSize(width, height);
canvasArea.appendChild(renderer.domElement);

const scene = new THREE.Scene();
scene.background = new THREE.Color(0x222222);

const camera = new THREE.PerspectiveCamera(70, width / height, 0.1, 100);
camera.position.z = 3;

const geometry = new THREE.BoxGeometry();
const material = new THREE.MeshStandardMaterial({ color: 0x00ffcc });
const cube = new THREE.Mesh(geometry, material);
scene.add(cube);

const light = new THREE.PointLight(0xffffff, 1);
light.position.set(5, 5, 5);
scene.add(light);

function animate() {
    requestAnimationFrame(animate);
    cube.rotation.x += 0.01;
    cube.rotation.y += 0.015;
    renderer.render(scene, camera);
}

animate();
</script>

</body>
</html>