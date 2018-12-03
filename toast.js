if (typeof mainScriptIncluded == 'undefined') {
  console.log("Main.js is missing, some functions may fail.");
}
if(typeof snackbarScriptIncluded == 'undefined'){
  snackbarScriptIncluded = true;
  function snackbar(text,time){
    parent.postMessage("snackbar:"+text+"time:"+time, "*");
    console.log("Beaming information into OS to show toast with text '"+text+"' for "+time+" miliseconds");
  }
  sendEvent("toast:loaded");
}
