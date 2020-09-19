<?php

    /*
     * App Core Class
     * Creates URL & loads core controller
     * URL FORMAT - /controller/method/params
     * 
     */
    
    Class Core
    {
        protected $_currentController = 'Pages';
        protected $_currentMethod = 'index';
        protected $_params = [];

        public function __construct()
        {
            $url = $this->getUrl();

            // Look in controllers for first value
            if(file_exists('../app/controllers/' . ucwords($url[0]) . '.class.php'))
            {
                // If exists, set as controller
                $this->_currentController = ucwords($url[0]);
                // Unset 0 index
                unset($url[0]);
            }

            // Require the controller
            require_once '../app/controllers/' . $this->_currentController . '.class.php';

            // INstatiate controller class
            $this->_currentController = new $this->_currentController;

            // Check for method
            if(isset($url[1]))
            {
                // Check if method exists in controller
                if(method_exists($this->_currentController, $url[1]))
                {
                    $this->_currentMethod = $url[1];
                    unset($url[1]);
                }
            }

            // get Params
            $this->_params = $url ? array_values($url) : [];

            // Call a callback with arrays of params
            call_user_func_array([$this->_currentController, $this->_currentMethod], $this->_params);
        }

        public function getUrl()
        {
            if(isset($_GET['url']))
            {
                $url = rtrim($_GET['url'], '/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/', $url);
                
                return $url;
            }
        }

    }

?>