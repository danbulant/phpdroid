if(typeof mainScriptIncluded == 'undefined'){
  function get_parent(){
    return window.parent;
  }
  var mainScriptIncluded = true;
  var parent = get_parent();
  function home(){
    parent.postMessage("close:app", "*");
  }
  function beam(text){
    parent.postMessage(text, "https://os.danbulant.eu/");
  }
  function sendEvent(text){
    event = new CustomEvent(text, {});
    window.dispatchEvent(event);
  }
  function sendNotification(app,text){
    beam("notification:" + app + "content:" + text);
  }
  function mainMessageProcessor(text){
    if(text.includes("event:back")){
      sendEvent("button:menu");
    } else if(text.includes("event:menu")){
      sendEvent("button:menu");
    } else if(text.includes("event:close")){
      sendEvent("event:close");
    }
  }
  window.addEventListener("message", mainMessageReceiver, false);
  var reference;
  var data;
  function mainMessageReceiver(event)
  {
    reference = event.reference;
    data = event.data;
    mainMessageProcessor(data);
  }
  sendEvent("main:loaded");
}
