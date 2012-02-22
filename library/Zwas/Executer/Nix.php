<?php

class Zwas_Executer_Nix implements Zwas_Executer_Interface {
	
	private $output = null;
	
	/**
	 * Execute a command in the shell, Redirects STDERR to STDOUT
	 * This is a wrapper to PHP exec() function
	 * 
	 * @param string $script
	 * @return boolean
	 */
	public function execute($command) {
		$result = null;
		$output = array();
		
		// Force redirecting the STDERR to STDOUT, maybe in the future this redirection will be optional
		$command .= ' 2>&1';
		exec($command, $output, $result);
		
		// Concat the output array into a string
		if (is_array($output)) {
			$this->output = implode(PHP_EOL, $output);
		}
		
		return (0 === $result);
	}
	
	/**
	 * Return the output as string
	 *
	 * @return string
	 */
	public function getOutput() {
		return $this->output;
	}
	
	/**
	 * Returns the error
	 * The STDERR is redirected to STDOUT, hence, it actually the calls getOutput()
	 *
	 * @return string
	 */
	public function getError() {
		return $this->getOutput();
	}
}