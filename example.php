<?php
require "Fluent.php";

$ev = \Fluent\Logger\ConsoleLogger::open("debug.test",fopen("php://stdout","w"));
//$ev = \Fluent\Logger\FluentLogger::open("debug.test","localhost","24224");
//$ev = \Fluent\Logger\HttpLogger::open("debug.test","localhost","8888");

/* simple request */
$ev->post(array("hello"=>"moe"));
// 2011-10-01 03:33:34 +0900 debug.test: {"hello":"moe"}


/* merge events */
$e_buy  = $ev->create_event("buy","item");
$e_user = $ev->create_event("user","name");

$e_user->name("chobie")->post();
//2011-10-01 03:33:34 +0900 debug.test.user: {"action":"user","name":"chobie"}

$e_buy->with($e_user)->item("yakiniku")->post();
//2011-10-01 03:33:34 +0900 debug.test.buy: {"action":"buy","item":"yakiniku","name":"chobie"}
