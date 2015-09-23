<?php
/**
 * User: ms
 * Date: 23.09.15
 * Time: 20:14
 */
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';


$glosbe = new \Translate\GlosbeTranslate("ita", "de");

echo $glosbe->translate('ciao');