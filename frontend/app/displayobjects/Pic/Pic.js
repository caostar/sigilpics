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

    //console.log(json);
    const texture = Texture.fromImage(json.thumbnailLink);
    super(texture);

    this.texture.baseTexture.on('loaded', this.show.bind(this));

    this.picData = json;
    this.initialScale = .1;
    this.normalScale = .7;
    this.finallScale = 4;

    this.anchor.x = .5;
    this.anchor.y = .5;

    this.pivot.x = .5;
    this.pivot.y = .5;

    this.scale.x = this.scale.y = this.initialScale;

    this.interactive = true;
    this.on('mouseover', this.mouseover.bind(this));
    this.on('mouseout', this.mouseout.bind(this));
    this.on('tap', this.click.bind(this));
  }

  show(e) {
    TweenLite.to(this.scale, .5, {x: this.normalScale, y: this.normalScale});
    this.parent.addPicLosded();
  }
  click(e) {
    console.log(this.picData);
  }
  mouseover(e) {
    TweenLite.to(this.scale, .5, {x: this.finallScale, y: this.finallScale});
    this.parent.addChild(this);
  }
  mouseout(e) {
    TweenLite.to(this.scale, .5, {x: this.normalScale, y: this.normalScale});
  }

}
