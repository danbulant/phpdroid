var script = document.createElement("script");
script.src = "https://os.danbulant.eu/howler.js";
document.head.appendChild(script);
if(typeof mainScriptIncluded == 'undefined'){
  console.log("some functions may not work correctly. Please consider including main script.");
}
if(typeof mediaPlayerScriptIncluded == 'undefined'){
  mediaPlayerScriptIncluded = true;
  function load(src){
    sound = new howl({src: [src]});
    return sound;
  }
  function play(sound){
    sound.play();
  }
  function pause(sound){
    sound.pause();
  }
  function stop(sound){
    sound.stop();
  }
  function setVolume(sound,volume){
    sound.volume(volume);
  }
  function getVolume(sound){
    return sound.volume();
  }
  function mute(sound){
    sound.mute(true);
  }
  function unmute(sound){
    sound.mute(false);
  }
  function fade(sound, from, to, duration){
    sound.fade(from,to,duration);
  }
  function setSpeed(sound, speed){
    sound.rate(speed);
  }
  function getSpeed(sound){
    return sound.rate();
  }
  function seek(sound, to){
    sound.seek(to);
  }
  function getSeek(sound){
    return sound.seek();
  }
  function startLoop(sound){
    sound.loop(true);
  }
  function stopLoop(sound){
    sound.loop(false);
  }
  function getLoop(sound){
    return  sound.loop();
    console.log("To loop or not to loop, that's the question");
  }
  function state(sound){
    return sound.state();
  }
  function playing(sound){
    return sound.playing();
  }
  function duration(sound){
    return sound.duration();
  }
  function remove(sound){
    sound.unload();
    console.log("unloaded and removed sound");
  }
  function global_mute(){
    Howler.mute(true);
  }
  function global_unmute(){
    Howler.mute(false);
  }
  function get_global_volume(){
    return Howler.volume();
  }
  function set_global_volume(number){
    Howler.volume(number);
  }
  function global_remove(){
    Howler.unload();
    console.log("All sounds have been destroyed");
  }
  function codec_availabe(codec){
    return Howler.codecs(codec);
  }
  sendEvent("mp:loaded");
}
