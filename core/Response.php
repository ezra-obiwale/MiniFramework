<?php

/**
 * Prepares the response to the request
 */
class Response extends ErrorCatcher {
	protected static $variables = array();
	
	/**
	 * Processes the request
	 */
	public static function process() {
		$module = Request::getModule();
		$controller = Request::getController();
		$action = Request::getAction();
		$controllerClass = $module . '\Controller\\' . ucfirst(Util::hyphenToCamel($controller));
		self::checkValidity($controllerClass,$action);
		Layout::set($module, $controller, $action);
		call_user_func_array(array(new $controllerClass,$action), Request::getParams());
	}
	
	/**
	 * Ensures the given class and method exist
	 * @param string $class
	 * @param string $method
	 * @return void
	 */
	private static function checkValidity($class, $method) {
		if (!class_exists($class)) throw new Exception('Invalid access path');
		if (!method_exists($class, $method)) throw new Exception('Invalid access method');
	}
	
	/**
	 * Renders the response
	 **/
	public static function render() {
		try {
			Layout::loadAction(static::$variables);
		} catch (Exception $ex) {
			static::displayError($ex);
		}
	}
	
	/**
	 * Set the variables to be set into the layout
	 * 
	 * @param array $variables Keys will become the variables in the layout
	 **/
	final public static function setVariables(array $variables) {
		static::$variables = $variables;
	}
	
}