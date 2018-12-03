/*
This script will load all available components.
*/
function sendEvent(text){
  event = new CustomEvent(text, {});
  window.dispatchEvent(event);
}
if(typeof mainScriptIncluded == 'undefined'){
  var script = document.createElement("script");
  script.src = "https://os.danbulant.eu/main.js";
  document.head.appendChild(script);
}
if(typeof mediaPlayerScriptIncluded == 'undefined'){
  var script = document.createElement("script");
  script.src = "https://os.danbulant.eu/mp.js";
  document.head.appendChild(script);
}
if(typeof dialogScriptIncluded == 'undefined'){
  var script = document.createElement("script");
  script.src = "https://os.danbulant.eu/dialog.js";
  document.head.appendChild(script);
}
if(typeof snackbarScriptIncluded == 'undefined'){
  var script = document.createElement("script");
  script.src = "https://os.danbulant.eu/toast.js";
  document.head.appendChild(script);
}
