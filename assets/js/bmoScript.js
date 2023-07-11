import * as THREE from 'node_modules\three';
import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js';
import { OrbitControls } from 'three/addons/controls/OrbitControls.js';


const scene = new THREE.Scene();
const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);



const renderer = new THREE.WebGLRenderer();
renderer.setSize(window.innerWidth, window.innerHeight);
document.body.appendChild(renderer.domElement);
renderer.outputColorSpace = THREE.SRGBColorSpace;

const loader = new GLTFLoader();

loader.load('assets/models/BMO.glb', function (glb) {
    const root = glb.scene;
    root.scale.set(0.1, 0.1, 0.1);

    scene.add(root);
    console.log(glb);
    animate();
}, function (xhr) {
    console.log((xhr.loaded / xhr.total * 100) + "% loaded");
}, function (error) {
    console.log('an error occurred');
});



const light = new THREE.DirectionalLight(0xffffff, 0.5);
light.position.set(2, 2, 5);
scene.add(light);

const ambLight = new THREE.AmbientLight(0xffffff, .1);
scene.add(ambLight);

const behindLight = new THREE.DirectionalLight(0xffffff, 0.5);
behindLight.position.set(2, 2, -5);
scene.add(behindLight);

const controls = new OrbitControls(camera, renderer.domElement);
camera.position.set(0, 2, 50);
controls.update();

// const geometry = new THREE.BoxGeometry(1, 1, 1);
// const material = new THREE.MeshBasicMaterial({ color: 0xFFFFFF });
// const cube = new THREE.Mesh(geometry, material);
// scene.add(cube);

camera.position.z = 5;

function animate() {
    requestAnimationFrame(animate);
    controls.update();
    renderer.render(scene, camera);
}
