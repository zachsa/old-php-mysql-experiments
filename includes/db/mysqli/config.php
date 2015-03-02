<?php
//database details




$enviroment = 'development';


if ($enviroment == 'development')

{
	define("HOST", "localhost");
	define("USER", "root");
	define("PASSWORD", "password");
	define("DATABASE", "bme");
}

elseif ($enviroment == 'production')

{
	define('HOST', 'localhost');
	define('USER', 'root');
	define('PASSWORD', 'password');
	define('DATABASE', 'bme');
}





?>