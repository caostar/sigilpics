import {Container} from 'pixi.js';
import Pic from '../Pic/Pic.js';

/**
 * A group of spinning bunnies
 *
 * @exports PicGroup
 * @extends Container
 */
export default class PicGroup extends Container {

  constructor() {
    const spreadX = 800;
    const spreadY = 100;
    const count = 500;

    super();

    for(let i = 0; i < count; i++) {
      let pic = new Pic();

      pic.position.x = (Math.random() * spreadX) - (spreadX / 2);
      pic.position.y = -(Math.random() * spreadY * .2);

      this.addChild(pic);
    }
  }
}
