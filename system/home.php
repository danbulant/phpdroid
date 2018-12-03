<?
$json = file_get_contents("../pages/apps.json");
$list = json_decode($json, true);
?>
<!DOCTYPE html>
<html lang="cs" dir="ltr">
<head>
  <meta charset="utf-8">
  <title></title>
</head>
<body class="unselectable">
  
  
  <div class="grid-container main">
    <? foreach ($list["apps"] as $key => $app) {
      if($app["favorite"]){
        continue;
      }
      ?>
      <div>
        <a href="<?=$app["url"]; ?>">
          <figure>
            <img src="<?=$app["icon"]; ?>">
            <figcaption><?=$app["name"];?></figcaption>
          </figure>
        </a>
      </div>
      <?
    }
    ?>
    <div class="empty">
    </div>
    <div class="empty">
    </div>
    <div class="empty">
    </div>
    <div class="empty">
    </div>
  </div>
  <br>
  <div class="grid-container dock">
    <? foreach ($list["apps"] as $key => $app) {
      if(!$app["favorite"]) continue;
      ?>
      <div>
        <a href="<?=$app["url"]; ?>">
          <figure>
            <img src="<?=$app["icon"]; ?>">
          </figure>
        </a>
      </div>
    <? } ?>
  </div>
  
  <style>
  @-webkit-keyframes colorful {
    0%{background-position:0% 50%}
    50%{background-position:100% 50%}
    100%{background-position:0% 50%}
  }
  @-moz-keyframes colorful {
    0%{background-position:0% 50%}
    50%{background-position:100% 50%}
    100%{background-position:0% 50%}
  }
  @keyframes colorful {
    0%{background-position:0% 50%}
    50%{background-position:100% 50%}
    100%{background-position:0% 50%}
  }
  </style>
  <style>
  @import url('https://fonts.googleapis.com/css?family=Roboto+Condensed');
  @import url('https://fonts.googleapis.com/css?family=Raleway');
  body {
    padding: 0;
    margin: 0;
    max-width:100%;
    background: linear-gradient(270deg, #b216c3, #237fea);
    background-size: 400% 400%;
    /* background-image: url("https://images.pexels.com/photos/1624496/pexels-photo-1624496.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940");*/
    -webkit-animation: colorful 30s ease infinite;
    -moz-animation: colorful 30s ease infinite;
    animation: colorful 30s ease infinite;
    background-position:center top;
    background-size: 100%;
    background-repeat: no-repeat;
    font-family: 'Raleway', sans-serif;
  }
  
  .grid-container {
    display: grid;
    grid-template-columns: auto auto auto auto;
    grid-row-gap: 5vw;
    grid-column-gap: 3vw;
    padding: 10px;
  }
  .unselectable {
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }
  html {
    width: 100%;
    height: 100%;
    padding: 0;
  }
  .grid-container > div {
    text-align: center;
    font-size: 20px;
    width:10vw;
    height:10vw;
  }
  .grid-container > div > a >figure {
    width:100%;
    height:100%;
    padding: 0;
    margin: 0;
  }
  .grid-container > div > a > figure > figcaption {
    text-align: center;
    padding-top:0;
    margin-top:0;
    color: white !important;
    font-family: 'Roboto Condensed', sans-serif;
  }
  a {
    color: white;
    text-decoration: none;
  }
  .grid-container > div > a >figure > img {
    width:90%;
    height:90%;
    margin-top: 5%;
    margin-bottom: 5%;
    border-radius: 10px;
  }
  .grid-container > div:hover:not(.empty) {
    background-color: rgba(255,255,255,0.2);
    border-radius:10px;
  }
  
  .dock {
    background-color: rgba(255,255,255,0.2);
    border-radius: 20px;
    width: 90%;
    position: fixed;
    bottom: 0;
    padding-left: 5%;
    padding-right: 5%;
    margin-left: auto;
    margin-right: auto;
    padding-bottom: 5px;
  }
  </style>
</body>
</html>
