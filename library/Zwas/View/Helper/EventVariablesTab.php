<?php

class Zwas_View_Helper_EventVariablesTab {
	
	protected $variables = array();
	
	/**
	 * @param string $title
	 * @param string $content
	 * @return string
	 */
	protected function getDojoTab($id, $title, $content) {
		return '<div dojoType="zend.layout.ContentPane" title="' . $title . '" class="mui-context-tab" id="event-tab-' . $id . '">' . $content . '</div>';	
	}
	
	/**
	 * @param string $key
	 * @param string $name
	 * @param bool $showIfEmpty
	 * @return string
	 */
	protected function getVariableLine($key, $name, $showIfEmpty = false) {
		$globalVar	= $this->getVariableContent($key);
		$isEmpty	= empty($globalVar);
		
		if ($isEmpty && !$showIfEmpty) {
			$line = '';
		} else {
			$content = ( $isEmpty ) ?  
						" (" . Zwas_Translate::_('empty') . ")" :
						"<ul><li>" . $this->view->variablesTree($globalVar) . "</li></ul>";
			
			$line = "<li dojoType=\"zend.widget.collapseList\"><strong>{$name}</strong>{$content}</li>";
		}
		return $line;
	}
	
	/**
	 * @param int $key
	 * @return array
	 */
	protected function getVariableContent($key) {
		if (array_key_exists($key, $this->variables) && !empty($this->variables[$key])) {
			return $this->variables[$key];
		}
		return array();
	}
	
	/**
	 * @var Zend_View_Abstract
	 */
	protected $view;
	
	public function setView($view) {
		$this->view = $view;
	}
}