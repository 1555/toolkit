<?php

interface Zwas_Executer_Interface {
	
	public function execute($command);
	/**
	 * Return the output as string
	 *
	 * @return string
	 */
	public function getOutput();
	public function getError();

}