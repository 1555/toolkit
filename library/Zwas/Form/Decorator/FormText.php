<?php 
require_once 'Zend/Form/Decorator/Abstract.php';

class Zwas_Form_Decorator_FormText extends Zend_Form_Decorator_Abstract {
	
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
    	
        // normalize the disabled attribute (e.g. when setAttrib('disabled', true))
        if (isset($attributes['disabled'])) {
            $formElement->setAttrib('disabled', 'disabled');
        }
        
        $errors = $formElement->getMessages();
        $errorsXhtml = '';
        if (count($errors)) {
        	$errorsXhtml = $view->formErrors($errors, array('class' => 'zend-input-error'));
        }
        
        $classes = 'zend-input zend-input-text';
        if (isset($attributes['class'])) {
        	if (is_array($attributes['class'])) {
        		$attributes['class'] = implode(' ', $attributes['class']);
        	}
        	$classes.= ' ' . $attributes['class'];
        }

        $inputXhtml = $view->formText(
        	$formElement->getFullyQualifiedName(), 
        	$formElement->getValue(), 
        	$formElement->getAttribs(), 
        	$formElement->options
        );

    	$xhtml = <<<XHTML
        <div class="{$classes}">
        	<div class="zend-input-left"><label class="zend-input-label">{$formElement->getLabel()}</label></div>
        	<div class="zend-input-right">
				{$inputXhtml}
       			{$errorsXhtml}
        	</div>
        </div>
XHTML;
        
        return $xhtml; 
    }
}