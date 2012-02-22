<?php 
require_once 'Zend/Form/Decorator/Abstract.php';

class Zwas_Form_Decorator_FormCheckbox extends Zend_Form_Decorator_Abstract {
	
	/**
     * Render a fieldset
     *
     * @param  string $content
     * @return string
     */
    public function render($content) {
    	$formElement = $this->getElement();
    	
    	$view = $formElement->getView();
    	
    	$attributes = $formElement->getAttribs();
		
        $errors = $formElement->getMessages();
        $errorsXhtml = '';
        if (count($errors)) {
        	$errorsXhtml = $view->formErrors($errors, array('class' => 'zend-input-error'));
        }
        
        $classes = 'zend-input zend-input-checkbox';
        if (isset($attributes['class'])) {
        	if (is_array($attributes['class'])) {
        		$attributes['class'] = implode(' ', $attributes['class']);
        	}
        	$classes.= ' ' . $attributes['class'];
        }
                
        $elementId = $view->escape($formElement->getId());

        $inputXhtml = $view->formCheckbox(
        	$formElement->getFullyQualifiedName(), 
        	$formElement->getValue(), 
        	$formElement->getAttribs(), 
        	$formElement->options
        );
        
    	$xhtml = <<<XHTML
        <div class="{$classes}">
        	<div class="zend-input-left">
        		{$inputXhtml}
        	</div>
        	<div class="zend-input-right">
        		<label class="zend-input-label" for="{$elementId}">{$formElement->getLabel()}</label>
       			{$errorsXhtml}
        	</div>
        </div>
XHTML;
        
        return $xhtml; 
    }
}