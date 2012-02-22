<?php

class Zwas_Controller_Router_DisabledRewrite extends Zend_Controller_Router_Rewrite {
	
	/**
     * Find a matching route to the current PATH_INFO and inject
     * returning values to the Request object.
     *
     * @throws Zend_Controller_Router_Exception
     * @return Zend_Controller_Request_Abstract Request object
     */
    public function route(Zend_Controller_Request_Abstract $request)
    {
		
        if (!$request instanceof Zend_Controller_Request_Http) {
            require_once 'Zend/Controller/Router/Exception.php';
            throw new Zend_Controller_Router_Exception('Zend_Controller_Router_Rewrite requires a Zend_Controller_Request_Http-based request object');
        }

    	$this->updatePathInfo($request); // PATCH
		
        if ($this->_useDefaultRoutes) {
            $this->addDefaultRoutes();
        }

        $pathInfo = $request->getPathInfo();

        /** Find the matching route */
        foreach (array_reverse($this->_routes) as $name => $route) {
            if ($params = $route->match($pathInfo)) {
                $this->_setRequestParams($request, $params);
                $this->_currentRoute = $name;
                break;
            }
        }

        return $request;

    }
    
	/**
     * Generates a URL path that can be used in URL creation, redirection, etc.
     * 
     * @param  array $userParams Options passed by a user used to override parameters
     * @param  mixed $name The name of a Route to use
     * @param  bool $reset Whether to reset to the route defaults ignoring URL params
     * @param  bool $encode Tells to encode URL parts on output
     * @throws Zend_Controller_Router_Exception
     * @return string Resulting absolute URL path
     */ 
    public function assemble($userParams, $name = null, $reset = false, $encode = true)
    {
        if ($name == null) {
            try {
                $name = $this->getCurrentRouteName();
            } catch (Zend_Controller_Router_Exception $e) {
                $name = 'default';
            }
        }
        
        $params = array_merge($this->_globalParams, $userParams);
        
        $route = $this->getRoute($name);
        $url   = $route->assemble($params, $reset, $encode);

        if (!preg_match('|^[a-z]+://|', $url)) {
            $url = rtrim($this->getFrontController()->getBaseUrl(), '/') . '?/' . $url; // PATCH
        }

        return $url;
    }
    
    
    private function updatePathInfo(Zend_Controller_Request_Abstract $request) {
    	$pathInfo = $request->getPathInfo();
		
		if ($pathInfo == '') {
			$uri = $request->getRequestUri ();
			$start = strpos ( $uri, '?/' );
			$end = strpos ( $uri, '&' );
			
			if ($start !== false) {
				$pathInfo = $uri;
				if (false !== $end) {
					$pathInfo = substr ( $pathInfo, 0, $end );
				}
				$pathInfo = substr ( $pathInfo, $start + 1 );
				$request->setPathInfo ( $pathInfo );
			}
		}
    }
}