<?php
namespace bu\chaining;

function is_namespace($what){
	if(rtrim($what, '\\') != $what)
		return true;
}

function is_class($what){
	if(rtrim($what, '\\') == $what)
		return true;
}

class Proxy{
	function c($what = null){
		return c($what);
	}
}

class NSProxy extends Proxy{
	var $ns = null;

	function __construct($ns){
		$this->ns = $ns;
		return $this;
	}

	function __call($name, $args){
		call_user_func_array($this->ns.$name, $args);
		return $this;
	}

	function __get($name){
		call_user_func($this->ns.$name);
		return $this;
	}
}

class ObjectProxy extends Proxy{
	var $obj = null;

	function __construct($what){
		$this->obj = $what;
		return $this;
	}

	function __call($name, $args){
		call_user_func_array(array($this->obj, $name), $args);
		return $this;
	}

	function __get($name){
		call_user_func(array($this->obj, $name));
		return $this;
	}
}

class ClassProxy extends Proxy{
	var $obj = null;

	function __construct($what){
		$this->obj = $what;
		return $this;
	}

	function __call($name, $args){
		call_user_func_array(array($this->obj, $name), $args);
		return $this;
	}

	function __get($name){
		call_user_func(array($this->obj, $name));
		return $this;
	}
}

function c($what = null){
	if(is_null($what))
		return new NSProxy('\\');
	if(is_object($what))
		return new ObjectProxy($what);
	if(is_namespace($what))
		return new NSProxy($what);
	if(is_class($what))
		return new ClassProxy($what);
	throw new Exception("Unknown chaing argument");
}
