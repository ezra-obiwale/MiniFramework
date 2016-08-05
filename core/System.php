<?php

class System {
	
	private static $config = array();
	/** Initializes this class */
	public static function init() {
		self::$config = require ROOT . 'config.php';
		error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT); // hide notices
		ini_set('display_errors', (strtolower(self::$config['server']) == 'development'));
		
		self::defineAutoloads();
	}
	
	/** Defines the constants to directories as specified in the config */
	private static function defineAutoloads() {
		foreach (self::getConfig('autoloadDirectories') as $key => $dir)
			if (is_string($key) && !defined($key))
				define($key, $dir);
	}

    /**
     * Gets (settings from) the config file
     * @param $_ Pass in as many params to indicate the array path to required config.
     * If last parameter is boolean, that will indicate whether to throw exception if required config
     * is not found. Defaults to TRUE.
     * @return mixed
     * @throws Exception
     */
    public static function getConfig() {
        $args = func_get_args();
        if (count($args) === 0) {
            return static::$config;
        }
        $except = true;
        if (gettype($args[count($args) - 1]) === 'boolean') {
            $except = $args[count($args) - 1];
            unset($args[count($args) - 1]);
        }

        $value = null;
        $path = '';
        $error = false;

        foreach ($args as $key => $arg) {
            if ($key === 0) {
                $path = '$config[' . $arg . ']';

                if (!isset(static::$config[$arg])) {
                    $error = true;
                    break;
                }

                $value = & static::$config[$arg];
            }
            else {
                $path .= '[' . $arg . ']';

                if (!isset($value[$arg])) {
                    $error = true;
                    break;
                }

                $value = & $value[$arg];
            }
        }

        if ($error && $except) {
            throw new Exception('Invalid config path "' . $path . '"', true);
        }
        elseif ($error) {
            return null;
        }

        return $value;
    }

	
}