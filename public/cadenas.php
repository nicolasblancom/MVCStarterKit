<?php

class Cadenas {

	public static function crearSlug($cadena){
		// replace non letter or digits by -
	  $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

	  // trim
	  $text = trim($text, '-');

	  // transliterate
	  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

	  // lowercase
	  $text = strtolower($text);

	  // remove unwanted characters
	  $text = preg_replace('~[^-\w]+~', '', $text);

	  if (empty($text))
	  {
	    return 'n-a';
	  }

	  return $text;
		}
}

echo Cadenas::crearSlug("hola que tal por españa");

$p = array(
	"uno" => "",
	"dos" => "",
	"tres" => "",
	);
$x = array(
	"uno" => 1,
	"dos" => "dosvalor",
	"lala" => "lala valor"
	);
$replace = array_replace($p, $x);
var_dump($replace);