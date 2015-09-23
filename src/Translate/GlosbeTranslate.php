<?php
namespace Translate;
/**
 * Class GlosbeTranslate
 *
 * @author Victor Henriquez <vhenriquez@indoblah.com>
 * @link http://www.indoblah.com/
 * @version 1.0.0
 * @access public
 * @package Translate
 */
class GlosbeTranslate {


	const FORMAT_JSON = 'json';

	const FORMAT_XML = 'xml';
	/**
	 * Last translation
	 * @var string
	 */
	protected $lastResult = '';

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
	 * Whether to include examples (make translation memories search),
	 * @var type
	 */
	protected $memorySearch = false;

	/**
	 * Formats availabe: json, xml
	 */
	protected $format = self::FORMAT_JSON;


	/**
	 * Glosbe Base URL
	 */
	const baseURL = 'https://glosbe.com/gapi';


	/**
	 * Class constructor
	 *
	 * @param string $from Language translating from (Optional)
	 * @param string $to Language translating to (Optional)
	 *
	 */
	public function __construct($from = 'eng', $to = 'ind') {

		$this->setLangFrom($from)->setLangTo($to);
	}


	/**
	 * @return string
	 */
	public function getLastResult() {
		return $this->lastResult;
	}

	/**
	 * @param $lastResult
	 * @return $this
	 */
	public function setLastResult($lastResult) {
		$this->lastResult = $lastResult;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getLangFrom() {
		return $this->langFrom;
	}

	/**
	 * @param $langFrom
	 * @return $this
	 */
	public function setLangFrom($langFrom) {
		$this->langFrom = $langFrom;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getLangTo() {
		return $this->langTo;
	}

	/**
	 * @param $langTo
	 * @return $this
	 */
	public function setLangTo($langTo) {
		$this->langTo = $langTo;
		return $this;
	}

	/**
	 * @return type
	 */
	public function getMemorySearch() {
		return $this->memorySearch;
	}

	/**
	 * @param $memorySearch
	 * @return $this
	 */
	public function setMemorySearch($memorySearch) {
		$this->memorySearch = $memorySearch;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getFormat() {
		return $this->format;
	}

	/**
	 * @param $format
	 * @return $this
	 * @throws Exception
	 */
	public function setFormat($format) {
		$format = strtolower($format);
		if ($format != self::FORMAT_JSON && $format != self::FORMAT_XML)
			throw new Exception ('Format not supported');

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
		$url = sprintf('%s/translate?from=%s&dest=%s&phrase=%s&format=%s&tm=true&pretty=true',
			self::baseURL,
			$this->getLangFrom(),
			$this->getLangTo(),
			urlencode(trim($string)),
			$this->getFormat()

		);

		$this->lastResult = $this->makeCurl($url);
		return $this->lastResult;
	}

	/**
	 * Process the raw API answer and extract the translations
	 *
	 * @return array
	 */
	public function translationsOnly() {
		$data = json_decode($this->lastResult);
		if (!$data) throw new Exception('This method only supports API answers in json. Set \'json\' format and call \'translate\' method again, before calling \'translationsOnly\'');
		$results = array();
		if (isset($data->tuc)) {
			foreach ($data->tuc as $trans) {
				if (isset($trans->phrase))
					$results[] = $trans->phrase->text;
			}
		}
		return $results;
	}
}
