import TweenLite from 'gsap';
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

    const texture = Texture.fromImage(json.thumbnailLink);

    super(texture);

    this.picData = json;

    /*this.tween = new Tween(this);*/

    this.anchor.x = .5;
    this.anchor.y = .5;

    this.pivot.x = .5;
    this.pivot.y = .5;

    this.scale.x = .5;
    this.scale.y = .5;

    this.interactive = true;
    this.on('mouseover', this.show.bind(this));
    this.on('mouseout', this.hide.bind(this));
  }

  show() {
    TweenLite.to(this.scale, .5, {x: 2, y: 2});
    console.log(this.picData);
  }
  hide() {
    TweenLite.to(this.scale, .5, {x: .5, y: .5});
  }

}
