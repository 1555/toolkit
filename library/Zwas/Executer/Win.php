<?php

class Zwas_Executer_Win implements Zwas_Executer_Interface {
	
	private $output;
	private $error;
	
	/**
	 * Returns the command output: read from the STDOUT
	 *
	 * @return string
	 */
	public function getOutput() {
		return $this->output;
	}
	
	/**
	 * Returns the command error: read from the STDERR
	 *
	 * @return string
	 */
	public function getError() {
		return $this->error;
	}
	
	/**
	 * Executes a command on windows
	 *
	 * @param string $command
	 * @return boolean
	 */
	public function execute($command) {
		// Clear the previous output
		$this->output = '';
		
		$pipes = array();
		$descriptor = array(1 => array("pipe", "w"),	// stdout
	   						2 => array("pipe", "w"));	// stderr
	
		$proc = proc_open($command,
						  $descriptor,
						  $pipes,
						  null,
						  null,
						  array('bypass_shell' => 1));
		
		if (!is_resource($proc)) {
			throw new Zwas_Exception(Zwas_Translate::_('Failed to execute the function proc_open()'));
		}
		
		$this->output = rtrim(stream_get_contents($pipes[1]), "\n");
		$this->error = rtrim(stream_get_contents($pipes[2]), "\n");
		
		// close stderr pipe
		fclose($pipes[2]);
		// close stdout pipe
		fclose($pipes[1]);
		
		return (0 === proc_close($proc));
	}
}