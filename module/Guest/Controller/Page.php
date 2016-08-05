<?php

namespace Guest\Controller;

class Page {
	
	public function home() {
		\Response::setVariables(array(
			'today' => date('l \t\h\e dS F, Y'),
			'time' => date('h:i a'),
		));
	}
	
	public function say($what) {
		\Response::setVariables(array(
			'say' => $what,
		));
	}
}