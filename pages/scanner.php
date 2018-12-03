<!DOCTYPE html>
<html>
<head>
  <title>Instascan</title>
  <script type="text/javascript" src="https://os.danbulant.eu/instascan.min.js"></script>
  <script type="text/javascript" src="https://os.danbulant.eu/components.js"></script>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body onload="startRecord();">
  
  <video id="bgvid" playsinline></video>
  <div id="polina">
    <h1>QR scanner</h1>
    <p id="scan">Your scans today:</p>
    <button id="pauseBTN" onclick="switchScan();" disabled>Waiting..</button>
  </div>
  
  <script type="text/javascript">
  var vid = document.getElementById("bgvid");
  var btn = document.getElementById("pauseBTN");
  var scanRunning = false;
  let scanner = new Instascan.Scanner({ video: document.getElementById('bgvid') });
  function startRecord(){
    console.log("starting scan");
    scanRunning = true;
    scanner.addListener('scan', function (content) {
      console.log(content);
      //document.getElementById("text").innerHTML = content;
      $("#scan").after("<p>" + content + "</p>");
      //snackbar("Scanned!",4000);
      sendNotification("QR scanner","Succesfully scanned! Content was '" + content + "'");
    });
    Instascan.Camera.getCameras().then(function (cameras) {
      if (cameras.length > 0) {
        scanner.start(cameras[0]);
        console.log("New camera: " + cameras[0].name);
        btn.innerHTML = "Pause scan";
        btn.disabled = false;
      } else {
        console.error('No cameras found.');
        snackbar("No camera found!",2000);
        btn.disabled = true;
        home();
      }
    }).catch(function (e) {
      console.error(e);
      snackbar("An error occured.",4000);
      btn.disabled = true;
      home();
    });
  }
  function stopRecord() {
    console.log("stopping scan");
    scanRunning = false;
    vid.classList.add("stopfade");
    scanner.stop();
    btn.innerHTML = "Resume scan";
    btn.disabled = false;
  }
  function switchScan(){
    console.log("switching scan");
    btn.disabled = true;
    if(scanRunning){
      stopRecord();
    } else {
      startRecord();
    }
  }
  </script>
  <style>
  body {
    margin: 0;
    background: #000;
  }
  video {
    position: fixed;
    min-width: 100%;
    min-height: 100%;
    width: auto;
    height: auto;
    z-index: -100;
    background-size: cover;
    transition: 1s opacity;
  }
  .stopfade {
    opacity: .5;
  }
  
  #polina {
    font-family: Agenda-Light, Agenda Light, Agenda, Arial Narrow, sans-serif;
    font-weight:100;
    background: rgba(0,0,0,0.3);
    color: white;
    padding: 2rem;
    width: 33%;
    margin:2rem;
    float: right;
    font-size: 1.2rem;
  }
  h1 {
    font-size: 3rem;
    text-transform: uppercase;
    margin-top: 0;
    letter-spacing: .3rem;
  }
  #polina button {
    display: block;
    width: 80%;
    padding: .4rem;
    border: none;
    margin: 1rem auto;
    font-size: 1.3rem;
    background: rgba(255,255,255,0.23);
    color: #fff;
    border-radius: 3px;
    cursor: pointer;
    transition: .3s background;
  }
  #polina button:hover {
    background: rgba(0,0,0,0.5);
  }
  
  a {
    display: inline-block;
    color: #fff;
    text-decoration: none;
    background:rgba(0,0,0,0.5);
    padding: .5rem;
    transition: .6s background;
  }
  a:hover{
    background:rgba(0,0,0,0.9);
  }
  @media screen and (max-width: 500px) {
    div{width:70%;}
  }
  @media screen and (max-device-width: 800px) {
    html { background: url(https://thenewcode.com/assets/images/polina.jpg) #000 no-repeat center center fixed; }
  }
</style>
</body>
</html>
