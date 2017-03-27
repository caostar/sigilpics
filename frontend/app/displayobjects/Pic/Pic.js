import TweenLite from 'gsap';
import { Sprite, Texture } from 'pixi.js';
import SIGIL from '../../assets/images/sigilWhiteThumb.png';

/**
 * A picture from google drive with clicks and drags
 *
 * @exports Pic
 * @extends Sprite
 */

export default class Pic extends Sprite {

  constructor(json) {

    //console.log(json);
    //let thumbLink = DEBUG != true ? json.thumbnailLink : json.proxyThumbnailLink;
    let thumbLink = json.thumbnailLink;
    //let thumbLink = json.downLoadFile;
    
    const texture = Texture.fromImage(thumbLink);
    super(texture);

    this.texture.baseTexture.on('loaded', this.onTextureLoaded.bind(this));

    this.originalX = 0;
    this.originalY = 0;

    this.picData = json;
    this.initialScale = .1;
    this.normalScale = .7;
    this.finallScale = 3.75;

    this.anchor.x = .5;
    this.anchor.y = .5;

    this.anchor.set(0.5);

    this.scale.x = this.scale.y = this.initialScale;

    this.interactive = true;
    this.buttonMode = true;

    //double click/tap params
    this.lastClick = 0,
    this.space = 350;

    this
        //mouse events
        .on('tap', this.onDoubleClick.bind(this))
        .on('click', this.onDoubleClick.bind(this))
        .on('mouseover', this.onMouseOver.bind(this))
        .on('touchstart', this.onMouseOver.bind(this))
        .on('mouseout', this.onMouseOut.bind(this))
        .on('touchend', this.onMouseOut.bind(this))
        .on('touchendoutside', this.onMouseOut.bind(this))
        // events for drag start
        .on('mousedown', this.onDragStart.bind(this))
        .on('touchstart', this.onDragStart.bind(this))
        // events for drag end
        .on('mouseup', this.onDragEnd.bind(this))
        .on('mouseupoutside', this.onDragEnd.bind(this))
        .on('touchend', this.onDragEnd.bind(this))
        .on('touchendoutside', this.onDragEnd.bind(this))
        // events for drag move
        .on('mousemove', this.onDragMove.bind(this))
        .on('touchmove', this.onDragMove.bind(this));
  }

  onDoubleClick(e) {
    var now = Date.now(),
    diff = now - this.lastClick;

    if(this.lastClick && (diff < this.space)) {
        //this was a double click
        this.lastClick = 0; //reset time
        console.log(this.picData);
        window.open(this.picData.downLoadFile);
    } else {
        //this was a regular click
        this.lastClick = now; //update last click time   
    }
  }
  onTextureLoaded(event) {
    TweenLite.to(this.scale, .5, {x: this.normalScale, y: this.normalScale});
    this.parent.addPicLosded();
  }
  onTap(event) {
    console.log(this.picData);
  }
  onMouseOver(event) {
    TweenLite.to(this.scale, .5, {x: this.finallScale, y: this.finallScale});
    this.parent.addChild(this);
  }
  onMouseOut(event) {
    TweenLite.to(this.scale, .5, {x: this.normalScale, y: this.normalScale});
  }
  onDragStart(event){
      // store a reference to the data
      // the reason for this is because of multitouch
      // we want to track the movement of this particular touch
      this.data = event.data;
      this.alpha = 0.5;
      this.dragging = true;
  }

  onDragEnd(){
      this.alpha = 1;
      this.dragging = false;
      // set the interaction data to null
      this.data = null;
  }

  onDragMove(){
      if (this.dragging)
      {
          var newPosition = this.data.getLocalPosition(this.parent);
          this.position.x = newPosition.x;
          this.position.y = newPosition.y;
      }
  }

}
