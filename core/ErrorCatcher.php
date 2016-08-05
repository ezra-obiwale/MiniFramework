<?php

abstract class ErrorCatcher {
	/**
	 * Displays the error page or dumps it to the screen
	 * @param Exception $ex The error object
	 * @param bool $dump Indicates whether to dump the error on the screen
	 */
	protected static function displayError(Exception $ex, $dump = false) {
		if ($dump) {
			echo '<h1>Page Error</h1>';
			echo '<hr />';
			echo '<blockquote>' . $ex->getMessage() . '</blockquote>';
			echo '<pre style="margin-left:60px">' . $ex->getTraceAsString() . '</pre>';
		} 
		else {
			Layout::loadError(array('error' => $ex));
		}
	}
}