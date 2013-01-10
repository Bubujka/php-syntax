<?php
namespace {
	require 'load.php';
	function say($v){ echo " ".$v."\n"; }
	function one(){ say(1); }
	function two(){ say(2); }

	$mmc = new foo\bar\MagicMethodClass();

	c()->one->two->say("Testing c()");
	c("foo\\bar\\")->three->four->say("Testing c('foo\\bar\\')");
	c("foo\\bar\\MagicStaticClass")->five->six->say("Testing c('foo\\bar\\MagicStaticClass')");
	c($mmc)->seven->eight->say("Testing c(\$mmc)");
	say("-------------------------------------------");
	c()->one->c("foo\\bar\\")->three->c("foo\\bar\\MagicStaticClass")->five->c($mmc)->seven->c()->say("Yeh!");
}
namespace foo\bar{
	function three(){ \say(3); }
	function four(){ \say(4); }
	function say($v){ \say($v); }

	class MagicStaticClass{
		static function five(){ \say(5); }
		static function six(){ \say(6); }
		static function say($v){ \say($v); }
	}

	class MagicMethodClass{
		function seven(){ \say(7); }
		function eight(){ \say(8); }
		function say($v){ \say($v); }
	}
}

