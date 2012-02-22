<?php
require_once 'Zend/XmlRpc/Client/FaultException.php';

class Zwas_XmlRpc_Exception extends Zend_XmlRpc_Client_FaultException {

	const MISSING_API_FUNCTION = 999;
}