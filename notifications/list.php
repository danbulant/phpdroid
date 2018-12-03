<?
session_start();
foreach ($_SESSION["notifications"] as $notification) {
  ?>
  <div class="notify-item">
    <p class="app"><?=$notification["app"];?> <small><?=$notification["date"]; ?></small></p>
    <p class="text"><?=$notification["text"]; ?></p>
  </div>
  <?
}
