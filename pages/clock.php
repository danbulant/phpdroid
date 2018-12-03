<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Binary clock</title>
  <script src="https://os.danbulant.eu/components.js"></script>
  <script src="https://npmcdn.com/react@15.3.0/dist/react.min.js"></script>
  <script src="https://npmcdn.com/react-dom@15.3.0/dist/react-dom.min.js"></script>
</head>
<body onclick="switchClock();">
  <div id="react"></div>
  <canvas id="clock-face"></canvas>
  <canvas id="clock-hands"></canvas>
</body>
<script>
window.addEventListener("toast:loaded", sendLoadedToast, {once: true});
function sendLoadedToast(){
  snackbar("Click anywhere to change clock style.",4000);
}
var react = false;
function switchClock(){
  if(react){
    showAnalog();
  } else {
    showReact();
  }
  react = !react;
}
function showReact(){
  console.log("showing react");
  document.getElementById("react").style.display = "flex";
  document.getElementById("clock-face").style.display = "none";
  document.getElementById("clock-hands").style.display = "none";
}
function showAnalog(){
  console.log("showing analog");
  document.getElementById("react").style.display = "none";
  document.getElementById("clock-face").style.display = "flex";
  document.getElementById("clock-hands").style.display = "flex";
}
window.onload = function () {
  var cf = document.getElementById("clock-face"),
  cf$ = cf.getContext("2d"),
  ch = document.getElementById("clock-hands"),
  ch$ = ch.getContext("2d"),
  // firstColor = '#f44242',
  // secondColor = '#223235',
  // background = '#0f0f0f',
  // handsColor = '#ffffff', // red blue black theme
  
  // firstColor = '#ff00a5',
  // secondColor = '#2b103a',
  // background = '#0f0f0f',
  // handsColor = '#0087ff', //cold purple theme
  
  firstColor = "#17b9dc",
  secondColor = "#223235",
  background = "#0f0f0f",
  handsColor = "#ffffff", //dark theme
  sixtieth = 2 * Math.PI / 60,
  twelfth = sixtieth * 5;
  
  var w = cf.width = ch.width = window.innerWidth,
  h = cf.height = ch.height = window.innerHeight,
  shortestSide = w <= h ? w : h,
  i = void 0,
  r = void 0,
  v = void 0,
  currentAngle = void 0,
  handsWidth = void 0,
  time = void 0,
  secondsAngle = void 0,
  minutesAngle = void 0,
  hoursAngle = void 0,
  timeElapsed = void 0,
  last = void 0,
  clockRadius = shortestSide / 2 - shortestSide / 20;
  
  function drawface() {
    cf$.fillStyle = background;
    cf$.fillRect(0, 0, cf$.canvas.width, cf$.canvas.height);
    
    for (r = 1; r <= 6; r++) {
      cf$.fillStyle = firstColor;
      v = Math.pow(2, r - 1);
      
      for (i = 0; i < 60; i++) {
        currentAngle = i * sixtieth - Math.PI / 2;
        
        if (i % v === 0) {
          cf$.fillStyle = cf$.fillStyle === firstColor ?
          secondColor :
          firstColor;
        }
        
        cf$.beginPath();
        cf$.arc(
          cf$.canvas.width / 2 +
          Math.cos(currentAngle) * (clockRadius - r * clockRadius / 15),
          cf$.canvas.height / 2 +
          Math.sin(currentAngle) * (clockRadius - r * clockRadius / 15),
          clockRadius / 40,
          0,
          Math.PI * 2);
          
          cf$.fill();
        }
      }
      
      for (r = 1; r <= 4; r++) {
        cf$.fillStyle = firstColor;
        v = Math.pow(2, r - 1);
        
        for (i = 0; i < 12; i++) {
          currentAngle = i * twelfth - Math.PI / 2;
          
          if (i % v === 0) {
            cf$.fillStyle = cf$.fillStyle === firstColor ?
            secondColor :
            firstColor;
          }
          
          cf$.beginPath();
          cf$.arc(
            cf$.canvas.width / 2 +
            Math.cos(currentAngle) * (clockRadius / 1.8 - r * clockRadius / 11),
            cf$.canvas.height / 2 +
            Math.sin(currentAngle) * (clockRadius / 1.8 - r * clockRadius / 11),
            clockRadius / 27,
            0,
            Math.PI * 2);
            
            cf$.fill();
          }
        }
      }
      
      function initHandsAngles() {
        time = new Date();
        
        last = time.getTime();
        
        secondsAngle =
        sixtieth * time.getSeconds() + sixtieth / 1000 * time.getMilliseconds();
        minutesAngle =
        sixtieth * time.getMinutes() + sixtieth / 60 * time.getSeconds();
        hoursAngle =
        twelfth * (
          time.getHours() > 12 ? time.getHours() - 12 : time.getHours()) +
          twelfth / 60 * time.getMinutes();
        }
        
        function updateHandsAngles() {
          timeElapsed = +new Date() - last;
          
          last = +new Date();
          
          secondsAngle += sixtieth / 1000 * timeElapsed;
          minutesAngle += sixtieth / 60 * (timeElapsed / 1000);
          hoursAngle += twelfth / 60 * (timeElapsed / 1000 / 60);
        }
        
        function drawHands() {
          handsWidth = clockRadius / 130;
          
          ch$.clearRect(0, 0, ch$.canvas.width, ch$.canvas.height);
          ch$.fillStyle = handsColor;
          ch$.strokeStyle = handsColor;
          ch$.lineWidth = handsWidth;
          
          ch$.save();
          ch$.beginPath();
          ch$.translate(ch$.canvas.width / 2, ch$.canvas.height / 2);
          ch$.rotate(secondsAngle);
          ch$.fillRect(
            -handsWidth / 2,
            -handsWidth / 2,
            handsWidth,
            -clockRadius + clockRadius / 15);
            
            ch$.fill();
            ch$.restore();
            
            ch$.save();
            ch$.beginPath();
            ch$.translate(ch$.canvas.width / 2, ch$.canvas.height / 2);
            ch$.rotate(minutesAngle);
            ch$.fillRect(
              -handsWidth / 2,
              -handsWidth / 2,
              handsWidth,
              -clockRadius + clockRadius / 5);
              
              ch$.fill();
              ch$.restore();
              
              ch$.save();
              ch$.beginPath();
              ch$.translate(ch$.canvas.width / 2, ch$.canvas.height / 2);
              ch$.rotate(hoursAngle);
              ch$.fillRect(
                -handsWidth / 2,
                -handsWidth / 2,
                handsWidth,
                -clockRadius + clockRadius / 1.5);
                
                ch$.fill();
                ch$.restore();
                
                ch$.beginPath();
                ch$.arc(
                  ch$.canvas.width / 2,
                  ch$.canvas.height / 2,
                  clockRadius / 1.87,
                  0,
                  Math.PI * 2);
                  
                  ch$.stroke();
                  
                  ch$.beginPath();
                  ch$.arc(
                    ch$.canvas.width / 2,
                    ch$.canvas.height / 2,
                    clockRadius,
                    0,
                    Math.PI * 2);
                    
                    ch$.stroke();
                    
                    ch$.beginPath();
                    ch$.arc(
                      ch$.canvas.width / 2,
                      ch$.canvas.height / 2,
                      clockRadius / 30,
                      0,
                      Math.PI * 2);
                      
                      ch$.fill();
                      
                      ch$.fillStyle = background;
                      ch$.beginPath();
                      ch$.arc(
                        ch$.canvas.width / 2,
                        ch$.canvas.height / 2,
                        clockRadius / 33,
                        0,
                        Math.PI * 2);
                        
                        ch$.fill();
                      }
                      
                      drawface();
                      initHandsAngles();
                      
                      (function loop() {
                        updateHandsAngles();
                        drawHands();
                        requestAnimationFrame(loop);
                      })();
                      
                      window.addEventListener("resize", function () {
                        w = cf.width = ch.width = window.innerWidth;
                        h = cf.height = ch.height = window.innerHeight;
                        shortestSide = w <= h ? w : h;
                        clockRadius = shortestSide / 2 - shortestSide / 20;
                        drawface();
                      });
                    };
                    
                    
                    
                    
                    
                    
                    
                    var _createClass = function () {function defineProperties(target, props) {for (var i = 0; i < props.length; i++) {var descriptor = props[i];descriptor.enumerable = descriptor.enumerable || false;descriptor.configurable = true;if ("value" in descriptor) descriptor.writable = true;Object.defineProperty(target, descriptor.key, descriptor);}}return function (Constructor, protoProps, staticProps) {if (protoProps) defineProperties(Constructor.prototype, protoProps);if (staticProps) defineProperties(Constructor, staticProps);return Constructor;};}();function _classCallCheck(instance, Constructor) {if (!(instance instanceof Constructor)) {throw new TypeError("Cannot call a class as a function");}}function _possibleConstructorReturn(self, call) {if (!self) {throw new ReferenceError("this hasn't been initialised - super() hasn't been called");}return call && (typeof call === "object" || typeof call === "function") ? call : self;}function _inherits(subClass, superClass) {if (typeof superClass !== "function" && superClass !== null) {throw new TypeError("Super expression must either be null or a function, not " + typeof superClass);}subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } });if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass;}var Pip = function Pip(_ref) {var isOn = _ref.isOn;return (
                      React.createElement("div", { className: "pip " + (isOn && 'pip--on') }));};
                      
                      var BinaryDigit = function BinaryDigit(_ref2) {var base2NumberAsArray = _ref2.base2NumberAsArray;return (
                        React.createElement("div", { className: "binary-digit" },
                        
                        base2NumberAsArray.map(function (pip, idx) {return React.createElement(Pip, { key: idx, isOn: pip === 1 });})));};
                        
                        
                        
                        var BinaryDigitGroup = function BinaryDigitGroup(_ref3) {var group = _ref3.group;return (
                          React.createElement("div", { className: "binary-digit-group" },
                          
                          group.map(function (binaryDigit, idx) {return React.createElement(BinaryDigit, { base2NumberAsArray: binaryDigit, key: idx });})));};var
                          
                          
                          
                          Clock = function (_React$Component) {_inherits(Clock, _React$Component);
                            function Clock(props) {_classCallCheck(this, Clock);var _this = _possibleConstructorReturn(this, (Clock.__proto__ || Object.getPrototypeOf(Clock)).call(this,
                              props));
                              _this.state = {
                                digits: [[], [], []] };return _this;
                                
                              }_createClass(Clock, [{ key: "componentDidMount", value: function componentDidMount()
                              
                              {
                                setInterval(function () {
                                  var date = new Date();
                                  var newDigits = [
                                    numberAsBinaryArrayPair(date.getHours()),
                                    numberAsBinaryArrayPair(date.getMinutes()),
                                    numberAsBinaryArrayPair(date.getSeconds())];
                                    
                                    this.setState({
                                      digits: newDigits });
                                      
                                    }.bind(this), 1000);
                                  } }, { key: "render", value: function render()
                                  
                                  {
                                    return (
                                      React.createElement("div", { className: "app" },
                                      React.createElement("div", { className: "clock" },
                                      
                                      this.state.digits.map(function (digit) {return React.createElement(BinaryDigitGroup, { group: digit });}))));
                                      
                                      
                                      
                                      
                                    } }]);return Clock;}(React.Component);
                                    
                                    
                                    
                                    ReactDOM.render(
                                      React.createElement(Clock, null),
                                      document.getElementById('react'));
                                      
                                      
                                      
                                      function numberToBinary(base10Number) {
                                        var base2Values = [8, 4, 2, 1];
                                        var output = [0, 0, 0, 0];
                                        var remainder = base10Number;
                                        
                                        base2Values.forEach(function (val, idx) {
                                          var left = remainder - val;
                                          
                                          if (left >= 0) {
                                            output[idx] = 1;
                                            remainder = left;
                                          }
                                        });
                                        
                                        return output;
                                      }
                                      
                                      function numberAsBinaryArrayPair(number) {
                                        var pair = [];
                                        if (number < 10) {
                                          pair[0] = numberToBinary();
                                          pair[1] = numberToBinary(number);
                                        } else {
                                          var numberAsArray = String(number).split('');
                                          pair[0] = numberToBinary(parseInt(numberAsArray[0], 10));
                                          pair[1] = numberToBinary(parseInt(numberAsArray[1], 10));
                                        }
                                        
                                        return pair;
                                      }
                                      </script>
                                      <style>
                                      body, html {
                                        width: 100%;
                                        height: 100%;
                                      }
                                      
                                      body {
                                        margin: 0;
                                        position: relative;
                                      }
                                      
                                      canvas {
                                        margin: 0;
                                        position: absolute;
                                      }
                                      
                                      
                                      
                                      
                                      
                                      .pip {
                                        width: 17px;
                                        height: 17px;
                                        margin: 7px;
                                        background-color: #525252;
                                        border-radius: 100%;
                                        transition: all .3s ease-in;
                                      }
                                      
                                      .pip--on {
                                        background-color: #48d8b8;
                                        transform: scale(1.1);
                                      }
                                      
                                      .clock {
                                        display: flex
                                      }
                                      
                                      .binary-digit-group {
                                        display: flex;
                                        margin: 0 6px;
                                      }
                                      html, body {
                                        background: #27272C;
                                        display: flex;
                                        justify-content: center;
                                        align-items: center;
                                        height: 100%
                                      }
                                      </style>
                                      </html>
                                      