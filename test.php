<?
$app = json_decode(file_get_contents("test.json"), true);
foreach ($app as $x) {
  echo $x["path"]."\n";
}
