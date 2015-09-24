<?php
/**
 * User: ms
 * Date: 23.09.15
 * Time: 20:14
 *
 * API Documentation
 * https://glosbe.com/a-api
 */
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';


$glosbe = new \Translate\GlosbeTranslate("ita", "de");

$glosbe->translate('come');

#var_dump( $glosbe->translationsOnly());


$csv =  dirname(__FILE__) . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'words.csv';
$words = array();
$lines =file_get_contents($csv);
$translations = array();
foreach(explode("\n",$lines) as $line) {
	$words []= explode(';', $line)[0];

}


foreach($words as $word) {
	var_dump($glosbe->translate($word));
}



/*print_r(
json_decode($glosbe->translate('ciao'))

);*/
#print $glosbe->translate('del caffè');