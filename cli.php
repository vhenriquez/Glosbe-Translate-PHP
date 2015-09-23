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

$glosbe->translate('ciao');

var_dump( $glosbe->translationsOnly());
/*print_r(
json_decode($glosbe->translate('ciao'))

);*/
#print $glosbe->translate('del caffè');