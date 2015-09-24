Glosbe-Translate-PHP
====================

PHP Class to translate from any language to any language using the free Glosbe API service

##Basic Usage

###Instantiate 
Run composer install

Instantiate GoogleTranslate object

```php
$glosbe = new \Translate\GlosbeTranslate("ita", "de");
```

or 

```php
$glosbe = new \Translate\GlosbeTranslate();
$glosbe->setLangFrom("eng");
$glosbe->setLangTo("ind");
```
Languages should be provided in ISO 639-2 Code format (http://www.loc.gov/standards/iso639-2/php/code_list.php)

###Traslate
Translate a sentence and get raw answer from Glosbe API

```php 
echo $glosbe->translate('hello');
```

###Processed translations
Process the raw API answer and get only an array of possible translations (authors, meanings and all other data are removed). 
( **Warning:** This method only works if 'format' was set to 'json' (default behaviour) when 'translate' method was invoked. )

```php 
$glosbe->translate('hello');
$resultArray = $glosbe->translations();
var_dump($resultArray);
```

##Options

###Output format
Supported formats: xml, json (default)
```php
$glosbe->setFormat("xml");
echo $glosbe->translate('hello');
```

###Pretty print
Human-readable output (default: false);
```php
$glosbe->setPretty(true);
echo $glosbe->translate('hello');
```

###Translation with examples
Include example sentences in the translation (default: false)
```php
$glosbe->setMemorySearch(true);
echo $glosbe->translate('hello');
```
