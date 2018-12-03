<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Binary translator</title>
  <script src="https://os.danbulant.eu/main.js"></script>
  <script src="https://os.danbulant.eu/dialog.js"></script>
  <script src="https://os.danbulant.eu/mp.js"></script>
  <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
</head>
<body>
  <div class="container">
    <div class="tools">
      <button class="sub toggle">SWITCH</button>
      <button class="sub clear clear-converted">CLEAR</button>
      <button class="convert">CONVERT</button>
      <button class="unconvert">UNCONVERT</button>
    </div>
    <div class="decimalToBinary">
      <textarea autofocus class="decimal" placeholder="Your Normal Text ... examble(cat)"></textarea>
      <textarea class="binary disabled" placeholder="Your Binary Code ... examble(0100100)"></textarea>
    </div>
    <div class="binaryToDecimal">
      <textarea class="binary" placeholder="Your Binary Code ... examble(0100100)"></textarea>
      <textarea class="decimal disabled" placeholder="Your Decimal Text ... examble(cat)"></textarea>
    </div>
  </div>
</body>
<script>
$(document).ready(function () {
  $('.toggle').click(function(){
    $('.decimalToBinary').toggleClass('decimalToBinaryClose')
    $('.convert').toggleClass('decimalToBinaryClose')
    $('.binaryToDecimal').toggleClass('binaryToDecimalOpen')
    $('.unconvert').toggleClass('inline-block')
    $(".clear").toggleClass("clear-converted").toggleClass("clear-unconverted")
  })
  $(".clear").click(function () {
    if ($(this).hasClass("clear-converted")){
      $(".decimalToBinary textarea").val("")
    } else {
      $(".binaryToDecimal textarea").val("")
    }
  })
  $('.convert').click(function () {
    var charCodes     = [],
    dividing      = [],
    allBinaryCode = [],
    decimal       = $('.decimalToBinary textarea.decimal').val(),
    chars         = decimal.split('');
    for( x=0; x<decimal.length; x++){
      charCodes[x] = decimal.charCodeAt(x)
    }
    for (y=0; y<charCodes.length; y++){
      var	equal  = [],
      binary = [];
      decimal = charCodes[y];
      for(i=0; i<=999999999; i++){
        dividing[i] = decimal;
        equal[i] = dividing[i] / 2;
        decimal = Math.floor(equal[i]);
        binary[i] = dividing[i] % 2;
        if(equal[equal.length-1] < 1){
          break;
        }else{}
      }
      binary.reverse();
      allBinaryCode[y] = binary.join('').toString();
    }
    $('.decimalToBinary textarea.disabled').val(allBinaryCode.join(' ').toString());
  });
  $('.unconvert').click(function(){
    var allBinary = $('.binaryToDecimal textarea.binary').val().split(' '),
    unicodes = [];
    for(i=0; i<allBinary.length; i++){
      var	oneBinaryLength = allBinary[i].length,
      equal = [],
      two   = [],
      char  = '',
      text  = [];
      for(x=0; x<=oneBinaryLength -1; x++){
        two[x] = Math.pow(2,x);
        var binary = allBinary[i].split('');
      }
      two.reverse();
      for(y=0; y < two.length; y++){
        equal[y] = two[y] * eval(binary[y]);
      }
      unicodes[i] = eval(equal.join('+'));
      char        = String.fromCharCode(unicodes[i]);
      text[i]     = char;
      $('.binaryToDecimal textarea.disabled').val($('.binaryToDecimal textarea.disabled').val() + char)
    }
  });
});
</script>
<style>
*{
  margin:  0;
  padding: 0;
}
body{
  background: #f0f0f0;
}
textarea{
  width: 100%;
  margin: 10px auto;
  display: block;
  height: 200px;
  padding: 10px;
  box-sizing: border-box;
  border: none;
}
textarea:focus{
  outline: 2px solid crimson;
}
.binaryToDecimal, .unconvert{
  display: none;
}
.decimalToBinaryClose{
  display: none;
}
.binaryToDecimalOpen{
  display: block;
}
.inline-block{
  display: inline-block;
}
.convert, .unconvert{
  padding: 10px;
  background: Crimson;
  color: #fff;
  border: 1px solid crimson;
  cursor: pointer;
  font-family: sans-serif;
  font-weight: bold;
  border-radius:3px;
  float:right;
}
.sub{
  padding:10px;
  background:#fff;
  color:#000;
  border:1px solid crimson;
  outline:none;
  border-radius:3px;
  cursor:pointer;
  transition:0.4s;
  -o-transition:0.4s;
  -moz-transition:0.4s;
  -webkit-transition:0.4s;
}
.sub:hover{
  background:#f7acba;
}
.container{
  width:100%;
  max-width:1000px;
  margin:10px auto;
  padding:2px;
  box-sizing:border-box;
}
.tools{
  display:block;
}
</style>
</html>
