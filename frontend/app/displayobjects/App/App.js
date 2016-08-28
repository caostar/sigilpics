import ScaledContainer from '../ScaledContainer/ScaledContainer.js';
import PicGroup from '../PicGroup/PicGroup.js';
import Pic from '../Pic/Pic.js';
import Background from '../Background/Background.js';
import RendererStore from '../../stores/RendererStore.js';
import FetchAPI from '../../utils/FetchAPI.js';
/**
 * Main App Display Object
 *
 * Adds a background and some bunnies to it's self
 *
 * @exports App
 * @extends ScaledContainer
 */
export default class App extends ScaledContainer {

  constructor(...args) {

    super(...args);

    this.fetchPics();

    var bg = new Background();

    this.addChild(bg);

    this.addBunnies();

  }

  addBunnies() {
    const cx = RendererStore.get('stageCenter').x;
    const cy = RendererStore.get('stageCenter').y;

    let group1 = new PicGroup();
    let b1 = new Pic();

    b1.position.x = cx;
    b1.position.y = cy;

    group1.position.x = cx;
    group1.position.y = cy + (RendererStore.get('stageHeight')*.25);

    this.addChild(b1);
    this.addChild(group1);
  }
  //////

  fetchPics () {
      console.log(FetchAPI.go('mosaic'))
  }


}
