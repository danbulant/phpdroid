<?
session_start();
$count = count($_SESSION["notifications"]);

$_SESSION["notifications"][$count]["app"] = $_GET["application"];
$_SESSION["notifications"][$count]["text"] = $_GET["content"];
$_SESSION["notifications"][$count]["date"] = date("j.n.y G:i");
