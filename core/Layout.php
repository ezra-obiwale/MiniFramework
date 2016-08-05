<?php

class Layout extends ErrorCatcher {
	
	private static $pathArray;
	
	/**
	 * Sets the path to the layout file
	 * Expects 1 to 3 parametres. If 1 parametre, it's set as the file.
	 * If 2 parametres, they are set as the controller and file.
	 * If 3 parametres, they are the module, controller and file.
	 * All parametres must be strings.
	 */
	public static function set($_) {
		switch(func_num_args()) {
			case 1: // just the file
				self::$pathArray[2] = func_get_arg(0);
				break;
			case 2:
				self::$pathArray[1] = func_get_arg(0); // set the controller
				self::$pathArray[2] = func_get_arg(1); // set the file
				break;
			case 3:
				self::$pathArray = func_get_args();
				break;
		}
	}

	/**
	 * Loads a layout with the given variables
	 * @param string $layout
	 * @param array $variables Keys will become the variables in the layout
	 * @return void
	 **/
	public static function loadAction(array $variables = array()) {
		try {
			self::load(self::createPath(), $variables);
		} catch (Exception $ex) {
			static::displayError($ex);
		}
	}
	
	/**
	 * Loads the layout for the module's error with the given variables
	 * @param string $layout
	 * @param array $variables Keys will become the variables in the layout
	 * @return void
	 **/
	public static function loadError(array $variables = array()) {
		try {
			self::load(self::createErrorPath(), $variables);
		} catch (Exception $ex) {
			static::displayError($ex,true);
		}
	}

	/**
	 * Loads the given layout with the given variables
	 * @param string $layout Full path to the layout file
	 * @param array $variables The variables to pass into the file
	 */
	public static function load($layout, array $variables = array()) {
		static::check($layout);
		foreach ($variables as $key => $value) {
			$$key = $value;
		}
		require_once $layout;
	}
	
	/**
	 * Creates the path to the layout from the path array
	 * @return string
	 */
	public static function createErrorPath() {
		return self::getModulePath() . 'Layout' . DIRECTORY_SEPARATOR . 'errors.phtml';
	}
	
	/**
	 * Creates the path to the layout from the path array
	 * @return string
	 */
	public static function createPath() {
		return self::getControllerPath() . self::$pathArray[2] . '.phtml';
	}
	
	/**
	 * Checks if the given layout is valid and exists
	 * @param string $layout
	 * @throws Exception
	 * @return void
	 **/
	private static function check($layout) {
		if (empty($layout) || !is_string($layout)) throw new Exception('Invalid layout');
		else if (!is_readable($layout)) throw new Exception('Layout not found [' . str_replace(MODULE, '', $layout) . ']');
	}
	
	/**
	 * Fetches the path to the set controller layout
	 * @return string
	 */
	private static function getControllerPath() {
		return self::getModulePath() . 'Layout' . DIRECTORY_SEPARATOR . self::$pathArray[1] . DIRECTORY_SEPARATOR;
	}
	
	/**
	 * Fetches the path to the set module layout
	 * @return string
	 */
	public static function getModulePath() {
		return MODULE . self::$pathArray[0] . DIRECTORY_SEPARATOR;
	}

}