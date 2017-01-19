import './index.html';
import {config} from '../package.json';
import Renderer from './Renderer/Renderer';
import App from './displayobjects/App/App';
import AnimationStore from './stores/AnimationStore';
import screenfull from 'screenfull'

const renderer = new Renderer(config.stageWidth, config.stageHeight);
const app = new App(config.stageWidth, config.stageHeight);

document.body.appendChild(renderer.view);

renderer.addRenderable(app);
renderer.start();

document.body.addEventListener('keyup', (e) => {
    //key "F"
    if (e.keyCode==70 && screenfull.enabled) {
        screenfull.toggle();
    } else {
        alert("Fullscreen not supported.");
    }
});
