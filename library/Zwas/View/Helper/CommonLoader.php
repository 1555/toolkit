<?php

abstract class Zwas_View_Helper_CommonLoader {
	
	public function setView($view) {
		$this->view = $view;
	}

	/**
	 * Clean trailing and preceding slashes from a controller or action and upper-case the first letter
	 * @param string $element
	 * @return string
	 */
	protected function normalizeElement($element) {
		return ucfirst(trim($element, '/'));
	}
}