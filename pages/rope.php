<!DOCTYPE html>
<html lang="cs" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Stickman rope</title>
  <script src="https://os.danbulant.eu/main.js"></script>
  <script src="https://os.danbulant.eu/dialog.js"></script>
  <script src="https://os.danbulant.eu/mp.js"></script>
</head>
<body>
  <iframe src="https://html5.gamedistribution.com/35345f23f44b4b8789581d5cafdbd6a6/" width="100%" height="100%" frameborder="0">
  </iframe>
</body>
<script>
var parent = get_parent();
window.addEventListener("button:menu", button_menu, false);
window.addEventListener("button:back", button_back, false);
window.addEventListener("event:close", app_closed, false);
window.addEventListener("dialog:button1", dialog_button1, false);
window.addEventListener("dialog:button2", dialog_button2, false);
//menu button clicked (os based)
function button_menu(){
  console.log("menu button clicked");
}
//back button clicked (os based)
function button_back(){
  console.log("back button clicked");
  
}
//app closed (home button, calling home, fatal error)
function app_closed(){
  console.log("app closed");
  
}
//dialog button pressed (the first one)
function dialog_button1(){
  console.log("dialog btn1");
  
}
//dialog button pressed (the second one)
function dialog_button2(){
  console.log("dialog btn2");
  
}
// DEPRECATED: Use new functions instead
/*
function message(text){
if(text.includes("event:back")){
//parent.postMessage("open:pages/home.php", "*");
home();
} else if (text.includes("event:menu")){
//parent.postMessage("dialog:Menu clicked btn1:ok btn2:hello cancellable:false", "*");
dialog("menu clicked","ok","hello","false");
} else if(text.includes("event:btn1")){
console.log("btn1 clicked");
closeDialog();
} else if(text.includes("event:btn2")){
console.log("YOU just CLICKed button NUMBER 2")
closeDialog();
} else if(text.includes("event:close")){
console.log("goodbye");
}
}
window.addEventListener("message", receiveMessage, false);
var reference;
var data;
function receiveMessage(event)
{
reference = event.reference;
data = event.data;
message(data);
}*/
</script>
<style>
* {
  padding: 0;
  margin: 0;
  width: 100%;
  height: 100%;
  overflow: hidden;
}
</style>
</html>
