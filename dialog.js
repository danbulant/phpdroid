if (typeof mainScriptIncluded == 'undefined') {
  console.log("Main.js is missing, some functions may fail.");
}
if(typeof dialogScriptIncluded == 'undefined'){
  dialogScriptIncluded = true;
  function dialog(text,btn,btn2,cancel){
    parent.postMessage("dialog:"+text+"btn1:"+btn+"btn2:"+btn2+"cancellable:"+cancel, "*");
    console.log("Beaming information into OS to show dialog with text '"+text+"', button 1 as'"+btn+"', button 2 as'"+btn2+"' and cancellable set to '"+cancel+"'");
  }
  function closeDialog(){
    parent.postMessage("close:dialog", "*");
  }
  var event;
  function messageProcessor(text){
    if(text.includes("event:btn1")){
      sendEvent("dialog:button1");
    } else if(text.includes("event:btn2")){
      sendEvent("dialog:button2");
    }
  }
  window.addEventListener("message", messageReceiver, false);
  var reference;
  var data;
  function messageReceiver(event)
  {
    reference = event.reference;
    data = event.data;
    messageProcessor(data);
  }
  sendEvent("dialog:loaded");
}
