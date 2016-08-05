<?php

/**
 * Class handling the request
 */
class Request extends ErrorCatcher {
	
	private static $urls;

	/**
	 * Initiate processing of request parameters
	 */
	public static function process() {
		try {
			Response::process(static::parseUrls());
		} catch (Exception $ex) {
			static::displayError($ex);
		}
	}

	/**
	 * Fetches the parsed urls
	 * @return array
	 */
	public static function getUrls() {
		return static::$urls;
	}
	
	/**
	 * Parses the current url for further processing
	 */
	private static function parseUrls() {
        if (static::$urls !== null) return static::$urls;
		if (FALSE === $uri = strstr($_SERVER['REQUEST_URI'],'?',true))
			$uri = $_SERVER['REQUEST_URI'];
		$script = strtolower($_SERVER['SCRIPT_NAME']);
		$uri = str_replace(array($script, dirname($script), strtolower(BASE) . '/'), '', strtolower($uri));
        static::$urls = static::updateArrayKeys(explode('/',
                                str_replace('?' . $_SERVER['QUERY_STRING'], '',
                                        $uri)), true);
		return static::$urls;
	}

    private static function updateArrayKeys(array $array,
            $removeEmptyValues = false) {
        $return = array();
        foreach ($array as $value) {
            if ($removeEmptyValues && $value !== '0' && empty($value)) continue;
            $return[] = urldecode($value);
        }
        return $return;
    }

	/** Fetches the requested module
	 *	@return string
	 */
	public static function getModule() {
		return ucfirst(Util::hyphenToCamel(self::$urls[0] ?
			self::$urls[0] : System::getConfig('defaults','module')));
	}
	
	/** Fetches the requested controller
	 *	@return string
	 */
	public static function getController() {
		return self::$urls[1] ? self::$urls[1] : System::getConfig('defaults','controller');
	}
	
	/** Fetches the requested action
	 *	@return string
	 */
	public static function getAction() {
		return self::$urls[2] ? self::$urls[2] : System::getConfig('defaults','action');
	}
	
	/** Fetches the parameters in the request
	 *	@return array
	 */
	public static function getParams() {
		$urls = self::$urls;
		unset($urls[0]);
		unset($urls[1]);
		unset($urls[2]);
		return $urls;
	}
	
}