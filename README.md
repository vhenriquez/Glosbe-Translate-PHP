Glosbe-Translate-PHP
====================

PHP Class to translate from any language to any language using the free Glosbe API service

##Basic Usage

#Instantiate 
Instantiate GoogleTranslate object

```php
$glosbe = new GlosbeTranslate("eng", "ind"); 
```

or 

```php
$glosbe = new GlosbeTranslate(); 
$glosbe->setLangFrom("eng");
$glosbe->setLangTo("ind");
```
Languages should be provided in ISO 639-2 Code format (http://www.loc.gov/standards/iso639-2/php/code_list.php)

#Traslate
Translate a sentence and get raw answer from Glosbe API

```php 
echo $glosbe->translate('hello');
```




