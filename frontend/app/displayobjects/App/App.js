import ScaledContainer from '../ScaledContainer/ScaledContainer.js';
import Pic from '../Pic/Pic.js';
import Background from '../Background/Background.js';
import RendererStore from '../../stores/RendererStore.js';
import FetchAPI from '../../utils/FetchAPI.js';
import TweenLite from 'gsap';
import _ from 'lodash'
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
    this.loadedPics = 0;

    this.bg = new Background();
    this.addChild(this.bg);

  }

  fetchPics () {
    FetchAPI.go('mosaic')
      .then(json => {
          //console.log('parsed json: ', json)
          this.addPics(json)
      }).catch(ex => {
          console.log('This shit took place: ', ex)
          alert('We could not render the pictures. Sorry!')
    })
  }

  addPics(json) {
    this.shuffle(json);

    const cx = RendererStore.get('stageCenter').x;
    const cy = RendererStore.get('stageCenter').y;

    this.totalPics = json.length;
    this.picsShowed = 0;
    this.picsList = [];
    console.log("The app has now "+ this.totalPics + " pictures uploaded.");
    let added = 0;

    _.times(this.totalPics, i => {
      added++;
      let pic = new Pic(json[i], added);
      pic.position.x = pic.originalX = Math.random() *RendererStore.get('stageWidth');
      pic.position.y = pic.originalY = Math.random() *RendererStore.get('stageHeight');
      this.addChild(pic);
      this.picsList.push(pic);
    })

    global.randomShowPicture = this.randomShowPicture.bind(this);

  }

  addPicLosded() {
    this.loadedPics++;
    console.log("totalLoadedPics:" + this.loadedPics);
    if(this.loadedPics >= this.totalPics){
      this.removeChild(this.bg);
      window.setInterval(this.randomShowPicture.bind(this), 8000);
    }
  }

  randomShowPicture(){
    let pic = this.picsList[this.picsShowed];
    TweenLite.delayedCall(1, this.showPicture.bind(this), [pic]); 
    this.picsShowed++;
    console.log(this.picsShowed + ' pics showed so far.');
    //
    if(this.picsShowed == this.totalPics){
      this.picsShowed = 0;
      this.organizePics(this.picsList);
    }

  }

  organizePics(picsList){
    this.shuffle(picsList);
    _.times(this.totalPics, i => {
      let pic = picsList[i];
      this.addChild(pic);
      pic.originalX = Math.random() *RendererStore.get('stageWidth');
      pic.originalY = Math.random() *RendererStore.get('stageHeight');
      TweenLite.to(pic.position, 2, {ease: Back.easeInOut, x: pic.originalX, y: pic.originalY});
      
    })
    console.log('Pics reorganized.')
  }

  showPicture(pic){
    TweenLite.delayedCall(.3, this.addChild.bind(this), [pic]);
    TweenLite.to(pic.scale, 1, {ease: Back.easeInOut, x: pic.finallScale, y: pic.finallScale});
    TweenLite.to(pic.position, 1, {x: RendererStore.get('stageWidth')/2, y: RendererStore.get('stageHeight')/2});
    TweenLite.delayedCall(6, this.hidePicture.bind(this), [pic]);
  }
  hidePicture(pic){
    TweenLite.to(pic.scale, 1, {ease: Back.easeInOut, x: pic.normalScale, y: pic.normalScale});
    TweenLite.to(pic.position, 1, {x: pic.originalX, y: pic.originalY});
  }

  shuffle(array) {
    let currentIndex = array.length, temporaryValue, randomIndex;

    // While there remain elements to shuffle...
    while (0 !== currentIndex) {

      // Pick a remaining element...
      randomIndex = Math.floor(Math.random() * currentIndex);
      currentIndex -= 1;

      // And swap it with the current element.
      temporaryValue = array[currentIndex];
      array[currentIndex] = array[randomIndex];
      array[randomIndex] = temporaryValue;
    }

    return array;
  }

}
