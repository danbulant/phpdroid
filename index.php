<?
//Copyright (c) 2018 Daniel Bulant. All Rights Reserved.
//Using The freesound project, jQuery, fontawesome and more
session_start();
if(isset($_SESSION["notifications"])){
  $notifications = $_SESSION["notifications"];
} else {
  $_SESSION["notifications"] = $notification = array();
}
if(((isset($_SERVER['HTTPS'])) && (strtolower($_SERVER['HTTPS']) == 'on')) || ((isset($_SERVER['HTTP_X_FORWARDED_PROTO'])) && (strtolower($_SERVER['HTTP_X_FORWARDED_PROTO']) == 'https'))){
  
} else {
  header("location: https://os.danbulant.eu");
}
?>
<!DOCTYPE html>
<html lang="cs" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>android OS - php</title>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <script src="howler.js"></script>
</head>
<body id="body">
  <div class="loading"><img src="android.png"></div>
  <div class="notification-bar" style="width: 100%;"id="notification" onclick="showNOTIFY();">
    <div style="display: inline-block; text-align: left;" class="inverted-color half-width"id="time"></div>
    <i class="fab fa-android"></i>
  </div>
  <iframe src="https://os.danbulant.eu/system/home.php" id="iframe" width="100%" height="100%" frameborder="0">
    Tvůj prohlížeč nepodporuje iframe. Použij prosím novější prohlížeč.
  </iframe>
  <!-- Modal content -->
  <!-- The Modal -->
  <div id="popup" class="modal">
    
    <!-- Modal content -->
    <div class="modal-content">
      <div class="modal-body">
        <p id="popup-text">Android not responding</p>
      </div>
      <div class="modal-footer">
        <button id="modal_btn1" onclick="beam('event:btn1')">wait</button><button id="modal_btn2" onclick="beam('event:btn2')">restart</button>
      </div>
    </div>
    
  </div>
  <div id="notifications" class="notifications hidenotification">
    
    <!-- Modal content -->
    <div class="notify-content">
      <div class="notify-header">
        <h2>Notifications</h2>
      </div>
      <div class="after-header">
        settings here
      </div>
      <div class="notify-body">
        
      </div>
      <div class="notify-footer inverted-color full-width">
        <h3 onclick="hideNOTIFY();">close</h3>
      </div>
    </div>
    
  </div>
  <div class="menu">
    <img onclick="event_menu();" src="menu.svg">
    <img onclick="event_home();" src="home.svg">
    <img onclick="event_back();"src="back.svg">
  </div>
  <div id="snackbar">Some text some message..</div>
</body>
<script>
var sb = document.getElementById("snackbar");
function showSnackbar(text, time) {
  console.log("Oh, I just got something to output as toast!");
  sb.className = "sbshow";
  sb.innerHTML = text;
  cssTime = time / 1000;
  cssTime = cssTime + "s";
  sb.style.animation = "fadein 0.5s, fadeout 0.5s "+cssTime;
  setTimeout(function(){ sb.className = sb.className.replace("sbshow", ""); }, parseInt(time) + 500);
}
var frame = window.frames[0];
function beam(text){
  frame.postMessage(text);
}
function get_page(){
  return document.getElementById('iframe').src;
}
// Get the modal
var cancellable = true;
var modal = document.getElementById('popup');
var modal_btn1 = document.getElementById('modal_btn1');
var modal_btn2 = document.getElementById('modal_btn2');
var currentBTN = "device_wait";
function showPOPUP(text,type){
  if(type == 1){
    modal_btn1.innerHTML = "wait";
    modal_btn2.innerHTML = "restart";
    currentBTN = "device_wait";
  } else if(type == 2){
    modal_btn1.innerHTML = "wait";
    modal_btn2.innerHTML = "close";
    currentBTN = "app_wait";
  } else if(type == 3){
    modal_btn1.innerHTML = "yes";
    modal_btn2.innerHTML = "no";
    currentBTN = "true_false";
  }
  modal.style.display = "block";
  jQuery("#popup-text").html(text);
}
var popupText;
function showCustomPOPUP(data){
  popupText = data.substring(
    data.lastIndexOf("text:") + 1,
    data.lastIndexOf("btn1:")
  );
  modal_btn1.innerHTML = data.substring(data.lastIndexOf("btn1:") + 5, data.lastIndexOf("btn2:"));
  modal_btn2.innerHTML = data.substring(data.lastIndexOf("btn2:") + 5, data.lastIndexOf("cancellable:"));
  cancellable = data.substring(data.lastIndexOf("cancellable:") + 12, data.length);
  currentBTN = "app_custom";
  modal.style.display = "block";
  jQuery("#popup-text").html(popupText);
}
function showCustomSnackbar(data){
  text = data.substring(data.lastIndexOf("snackbar:") + 9, data.lastIndexOf("time:"));
  time = data.substring(data.lastIndexOf("time:") + 5, data.length);
  console.log("Oh, it looks like me(showCustomSnackbar) received an information about snackbar! I'll just send it next, so I execute showSnackbar("+text+","+time+")!")
  showSnackbar(text,time);
}
function hidePOPUP(){
  modal.style.display = "none";
}
setTimeout(hideLoad,5000);

var startupSound = new Howl({
  src: ['data/music/welcometowhatever.wav']
});
startupSound.play();
$(".notification-bar").hide();
function hideLoad(){
  $(".loading").hide();
  $(".notification-bar").show();
}

//notifications script
var eventSound = new Howl({
  src: ['data/music/event.mp3']
});
function addNotification(app,text){
  eventSound.play();
  jQuery.get("notifications/add.php", { application : app, content : text}, function(data, status, jqXHR) { console.log(status); });
  reloadNotifications();
}

function reloadNotifications(){
  $(".notify-body").load("notifications/list.php");
}

reloadNotifications();

function showCustomNotification(data){
  app = data.substring(data.lastIndexOf("notification:") + 13, data.lastIndexOf("content:"));
  text = data.substring(data.lastIndexOf("content:") + 8,data.length);
  addNotification(app,text);
}


function showNOTIFY(){
  var notifications = document.getElementById("notifications");
  notifications.classList.add("shownotification");
  notifications.classList.remove("hidenotification");
  console.log("showing notifications");
}

function hideNOTIFY(){
  notifications.classList.remove("shownotification");
  notifications.classList.add("fadeout");
  console.log("hiding notifications");
  setTimeout(function(){
    notifications.classList.remove("fadeout");
    notifications.classList.add("hidenotification");
    console.log("stopping notification animation");
  }, 400);
  
}

document.getElementById("body").style.paddingTop = document.getElementById("notification").offsetHeight + "px";
document.getElementById("notification").style.top = "0px";

window.onclick = function(event) {
  if (event.target == modal && cancellable) {
    modal.style.display = "none";
  }
  if (event.target == notifications) {
    hideNOTIFY();
    console.log("clicked outside notification");
  }
}
function openAPP(app){
  document.getElementById('iframe').src = app;
}
function event_back(){
  frame.postMessage("event:back", "*");
  console.log("event:back");
}
function event_home(){
  beam("event:close");
  if(get_page() !== "pages/home.php");
  openAPP("pages/home.php");
  console.log("event:home");
}
function event_menu(){
  frame.postMessage("event:menu", "*");
  console.log("event:menu");
}
function close(text){
  if(text == "app"){
    openAPP("pages/home.php");
  } else if(text == "dialog"){
    hidePOPUP();
  }
}
window.addEventListener("message", receiveMessage, false);
var reference;
var data;
function receiveMessage(event)
{
  
  
  reference = event.reference;
  data = event.data;
  if(data.includes("open:")){
    openAPP(data.replace("open:",""));
  } else if(data.includes("error:")){
    showPOPUP(data.replace("error:",""),2);
  } else if(data.includes("dialog:")){
    showCustomPOPUP(data.replace("dialog:",""));
  } else if(data.includes("close:")){
    close(data.replace("close:",""));
  } else if(data.includes("snackbar:")){
    showCustomSnackbar(data);
  } else if(data.includes("notification:")){
    showCustomNotification(data);
  }
}

//time script
(function () {
  function checkTime(i) {
    return (i < 10) ? "0" + i : i;
  }
  
  function startTime() {
    var today = new Date(),
    h = checkTime(today.getHours()),
    m = checkTime(today.getMinutes()),
    s = checkTime(today.getSeconds());
    document.getElementById('time').innerHTML = h + ":" + m;
    t = setTimeout(function () {
      startTime()
    }, 2000);
  }
  startTime();
})();

</script>
<style>
@import url('https://fonts.googleapis.com/css?family=Roboto+Condensed');
@import url('https://fonts.googleapis.com/css?family=Raleway');
@import url('https://fonts.googleapis.com/css?family=Oswald');
body, html {
  padding: 0;
  margin: 0;
  width: 100%;
  height: 100%;
  font-family: 'Raleway', sans-serif;
  overflow: hidden;
}
.loading {
  position: fixed;
  padding: 0;
  margin: 0;
  z-index: 500;
  width: 100%;
  height: 100%;
  background-color: black;
}
.loading > img {
  height: 100%;
  max-width: 100%;
  animation: greenLight 5s infinite;
}
@keyframes greenLight {
  50% {filter: drop-shadow(0px 0px 5px #A4CA39);}
}
#snackbar {
  visibility: hidden;
  min-width: 250px;
  margin-left: -125px;
  background-color: #333;
  color: #fff;
  text-align: center;
  border-radius: 2px;
  padding: 16px;
  position: fixed;
  z-index: 1;
  left: 50%;
  bottom: 30px;
  font-size: 17px;
}

#snackbar.sbshow {
  visibility: visible;
  -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
  animation: fadein 0.5s, fadeout 0.5s 2.5s;
}

@-webkit-keyframes fadein {
  from {bottom: 0; opacity: 0;}
  to {bottom: 30px; opacity: 1;}
}

@keyframes fadein {
  from {bottom: 0; opacity: 0;}
  to {bottom: 30px; opacity: 1;}
}

@-webkit-keyframes fadeout {
  from {bottom: 30px; opacity: 1;}
  to {bottom: 0; opacity: 0;}
}

@keyframes fadeout {
  from {bottom: 30px; opacity: 1;}
  to {bottom: 0; opacity: 0;}
}
.app {
  font-family: 'Oswald', sans-serif;
  margin-top: 0;
  margin-bottom: 0;
}
.text {
  font-family: 'Raleway', sans-serif;
}
.after-header {
  background-color: white;
  border-radius: 0 0 10px 10px;
}
.notify-item {
  background-color: rgba(255,255,255,0.9);
  border-radius: 5px;
  padding: 2px 16px;
  margin-top: 0;
  margin-bottom: 0;
  margin-left: 5%;
  margin-right: 5%;
}
.notification-bar {
  background-color:black !important;
  position: fixed;
  color: white !important;
  width:100%;
  padding-top: 0;
  margin: 0;
}
/* The Modal (background) */
.notifications {
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  -webkit-animation-name: fadeIn; /* Fade in the background */
  -webkit-animation-duration: 0.4s;
  animation-name: fadeIn;
  animation-duration: 0.4s;
}
.hidenotification {
  display: none;
}
.shownotification {
  display: block;
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
}
.fadeout {
  z-index: 2;
  -webkit-animation-name: fadeOut;
  -webkit-animation-duration: 0.4s;
  animation-name: fadeOut;
  animation-duration: 0.4s;
}
/* Modal Content */
.notify-content {
  position: fixed;
  top: 0;
  /*background-color: #fefefe;*/
  background-color: rgba(0, 0, 0, 0);
  width: 100%;
  -webkit-animation-name: slideIn;
  -webkit-animation-duration: 0.4s;
  animation-name: slideIn;
  animation-duration: 0.4s;
}

/* The Close Button */
.notify-close {
  color: white;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.notify-close:hover,
.notify-close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.notify-header {
  padding: 2px 8px;
  background-color: #5cb85c;
  color: white;
}
.notify-header > * {
  margin: 0;
}

.notify-body {padding: 2px 16px;}

.notify-footer {
  padding: 2px 16px;
  margin-left: 5%;
  margin-right: 5%;
  border-radius: 10px;
  background-color: rgba(255,255, 255, 0.8);
}

/* Add Animation */
@-webkit-keyframes slideIn {
  from {top: -100%; opacity: 0}
  to {top: 0; opacity: 1}
}

@keyframes slideIn {
  from {top: -100%; opacity: 0}
  to {top: 0; opacity: 1}
}

@-webkit-keyframes fadeIn {
  from {opacity: 0}
  to {opacity: 1}
}

@keyframes fadeIn {
  from {opacity: 0}
  to {opacity: 1}
}
@-webkit-keyframes fadeOut {
  from {top: 0; opacity: 1}
  to {top: -100%; opacity: 0}
}

@keyframes fadeOut {
  from {top: 0; opacity: 1}
  to {top: -100%; opacity: 0}
}
.menu {
  position: fixed;
  bottom: 0;
  right: 0;
  
  width: 30%;
  height: 10%;
  
  background-color: rgba(0,0,0,0.4);
  border-radius: 5px 0 0 0;
}
.menu > img {
  width: 30%;
  height: 100%;
}
.full-width {
  width = 100%;
}
.half-width {
  width = 100%;
}
.inverted-color {
  color: white;
  background-color: black;
}
/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  border: 1px solid #888;
  width: 80%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  /*  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s;*/
}

/* Add Animation */
@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

/* The Close Button */
.close {
  color: white;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.modal-body {
  padding: 2px 16px;
}

.modal-footer {
  padding: 2px 16px;
  /*background-color: #5cb85c;*/
  color: white;
}
.modal-footer > button {
  border: none;
  text-align: right;
  color: #409C8E;
  background-color: rgba(255, 0, 0, 0);
}
</style>
</html>
