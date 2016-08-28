/**
https://github.com/edwinwebb/pixi-seed
 * App.js
 *
 * The main entry point, appends PIXI to the DOM
 * and starts a render and animation loop
 *
 http://caostar.com/private/sigilpics/backend/public/api/mosaic
 ex:
 [
  {
    "id": "0B0eN-Jp_9FgiSDV3WGJka0c0NGM",
    "thumbnailLink": "uFrcNFkfDLlaBkVheLboQ5rhgbro-3A-Vcwv3P8J6JN8LvSa5sJ_InA1eg=s220",
    "originalFilename": "IMG_8296.PNG",
    "name": "IMG_8296.PNG",
    "modifiedTime": "2016-08-27T03:41:58.414Z",
    "size": "336511",
    "width": 759,
    "height": 577,
    "displayName": "",
    "displayPic": "",
    "altitude": null,
    "latitude": null,
    "longitude": null
  }
 ]
 */

import './index.html';
import {config} from '../package.json';
import Renderer from './Renderer/Renderer';
import App from './displayobjects/App/App';
import AnimationStore from './stores/AnimationStore';
import TWEEN from 'tween.js';

const renderer = new Renderer(config.stageWidth, config.stageHeight);
const app = new App(config.stageWidth, config.stageHeight);

document.body.appendChild(renderer.view);

AnimationStore.addChangeListener(() => TWEEN.update());

renderer.addRenderable(app);
renderer.start();
