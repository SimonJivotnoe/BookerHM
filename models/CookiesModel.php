<?php

class CookiesModel
{
	public function __construct()
	{
	
	}
	public function add($key, $value)
	{	

		if (isset($_COOKIE[$key]))
		{
			return false;
		}
		else
		{
			setcookie($key, $value);

			return true;
		}
	}
	
	public function read($key)
	{
		if (isset($_COOKIE[$key]))
		{
			return true;
		}
		else
		{

			return false;
		}
	}
	public function remove($key)
	{	
		if (isset($_COOKIE[$key]))
		{
			setcookie($key);
			return true;
		}
		else
		{
			return false;
		}
	}
}
