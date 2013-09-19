<?php

/**
 * Glosbe Translate PHP class
 *
 * @author Victor Henriquez <vhenriquez@indoblah.com>
 * @link http://www.indoblah.com/
 * @version 1.0.0
 * @access public
 */
class GlosbeTranslate {

    /**
     * Last translation
     * @var string
     */
    protected $lastResult = "";

    /**
     * Language translating from
     * @var string
     */
    protected $langFrom;

    /**
     * Language translating to
     * @var string
     */
    protected $langTo;

    /**
     * Human-readable output
     * @var boolean
     */
    protected $pretty = false;
    
    /**
     * Whether to include examples (make translation memories search),
     * @var type 
     */
    protected $memorySearch = false;
    
    /**
     * Formats availabe: json, xml
     */
    protected $format = "json";
    
    
    /**
     * Glosbe Base URL
     */
    const baseURL = "http://glosbe.com/gapi";

    
    /**
     * Class constructor
     *
     * @param string $from Language translating from (Optional)
     * @param string $to Language translating to (Optional)
     * 
     */
    public function __construct($from = "eng", $to = "ind") {
        $this->setLangFrom($from)->setLangTo($to);
    }

    
    public function getLastResult() {
        return $this->lastResult;
    }

    public function setLastResult($lastResult) {
        $this->lastResult = $lastResult;
        return $this;
    }

    public function getLangFrom() {
        return $this->langFrom;
    }

    public function setLangFrom($langFrom) {
        $this->langFrom = $langFrom;
        return $this;
    }

    public function getLangTo() {
        return $this->langTo;
    }

    public function setLangTo($langTo) {
        $this->langTo = $langTo;
        return $this;
    }

    public function getPretty() {
        return $this->pretty;
    }

    public function setPretty($pretty) {
        $this->pretty = $pretty;
        return $this;
    }

    public function getMemorySearch() {
        return $this->memorySearch;
    }

    public function setMemorySearch($memorySearch) {
        $this->memorySearch = $memorySearch;
        return $this;
    }

    public function getFormat() {
        return $this->format;
    }

    public function setFormat($format) {
        $format = strtolower($format);
        if ($format != "json" && $format != "xml")
            throw new Exception ("Format not supported");
        
        $this->format = $format;
        return $this;
    }

        
    /**
     * Simplified curl method
     * @param string $url URL
     * @return string
     */
    public static final function makeCurl($url) {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($curl);

        return $output;
    }

    /**
     * Translate text
     *
     * @param string $string Text to translate
     * @return string Translated text
     */
    public function translate($string) {
        $url = self::baseURL . "/translate?from={$this->langFrom}&dest={$this->langTo}&phrase={$string}&format={$this->format}";
        if ($this->memorySearch) $url .= "&tm=true";
        if ($this->pretty) $url .= "&pretty=true";
        
        $this->lastResult = $this->makeCurl($url);
        return $this->lastResult;
    }

    public static function convertLang($lang) {
        $langs = array(
            Exercise::LANG_ENGLISH => "eng",
            Exercise::LANG_SPANISH => "spa",
            Exercise::LANG_INDONESIAN => "ind",
        );

        return $langs[$lang];
    }

}
