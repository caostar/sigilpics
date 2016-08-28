import { Tween } from 'tween.js';
import { Sprite, Texture } from 'pixi.js';
import SIGIL from '../../assets/images/sigilWhiteThumb.png';

/**
 * A bunny which spins on it's feet when moused over
 *
 * @exports Pic
 * @extends Sprite
 */
export default class Pic extends Sprite {

  constructor(json) {

    const texture = Texture.fromImage(SIGIL);

    super(texture);

    this.tween = new Tween(this);

    this.anchor.x = .5;
    this.anchor.y = 1;

    this.pivot.x = .5;
    this.pivot.y = .5;

    this.interactive = true;
    this.on('mouseover', this.startSpin.bind(this));
  }

  startSpin() {
    this.tween.to({rotation: Math.PI*2}, 1000);
    this.tween.start();
    this.tween.onComplete(() => this.rotation = 0);
  }

}
